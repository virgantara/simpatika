<?php

namespace app\controllers;

use Yii;
use app\models\Jabatan;
use app\models\Verify;
use app\models\JabatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * JabatanController implements the CRUD actions for Jabatan model.
 */
class JabatanController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page');
                },
                'only' => ['create','update','delete','index','list'],
                'rules' => [
                    
                    [
                        'actions' => ['create','update','delete','index'],
                        'allow' => true,
                        'roles' => ['Dosen','Staf'],
                    ],
                    [
                        'actions' => [
                            'create','update','delete','index','list'
                        ],
                        'allow' => true,
                        'roles' => ['Dekan','Kepala','Kaprodi'],
                    ],
                    [
                        'actions' => [
                            'create','update','delete','index','list'
                        ],
                        'allow' => true,
                        'roles' => ['theCreator'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    

    public function actionList()
    {
        
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        
        $query = Jabatan::find();
        $query->where(['NIY'=>Yii::$app->user->identity->NIY]);
        $query->joinWith(['jabatan as j']);
        $query->andWhere(['IN','j.nama',['Rektor','Wakil Rektor','Kepala','Ketua','Dekan','Direktur']]);
        $listUnker = [];

        $results = $query->all();
        foreach($results as $item)
        {
          $listUnker[$item->unker_id] = $item->unker->nama;
        }

        $results = \app\models\MJabatan::find()->where(['NOT IN','nama',['Kepala','Dekan','Ketua','Rektor','Wakil Rektor','Direktur']])->all();
        $listJabatan = [];
        foreach($results as $item)
        {
          $listJabatan[$item->id] = $item->nama;
        }
        return $this->render('list', [
          'listUnker' => $listUnker,
          'listJabatan' => $listJabatan
        ]);
        
    }

    /**
     * Lists all Jabatan models.
     * @return mixed
     */
    public function actionIndex()
    {
       
        $searchModel = new JabatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    /**
     * Displays a single Jabatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jabatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jabatan();
        $tambah = new Verify();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            $model->NIY = Yii::$app->user->identity->NIY;
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 3;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();

                $model->f_penugasan = UploadedFile::getInstance($model,'f_penugasan');
                if($model->f_penugasan){
                    $file = $model->f_penugasan->name.date('YmdHis').'_'.Yii::$app->user->identity->NIY.'.'.$model->f_penugasan->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/jabatan'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/jabatan');

                    if ($model->f_penugasan->saveAs(Yii::getAlias('@frontend').'/web/uploads/jabatan/'.$file)){
                        $model->f_penugasan = $file;           
                    }
                }

                $model->ver = 'Sudah Diverifikasi';
                if($model->save())
                {

                  $transaction->commit();
                  Yii::$app->session->setFlash('success', "Data tersimpan");
                  return $this->redirect(['view', 'id' => $model->ID]);
                }

                
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Jabatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'3','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 3;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
        }
        
        $f_penugasan = $model->f_penugasan;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try 
        {
            $model->ver = 'Sudah Diverifikasi';
            if ($model->load(Yii::$app->request->post())) {

                $model->f_penugasan = UploadedFile::getInstance($model,'f_penugasan');
                if($model->f_penugasan){
                    $file = $model->f_penugasan->name.date('YmdHis').'_'.Yii::$app->user->identity->NIY.'.'.$model->f_penugasan->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/jabatan'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/jabatan');

                    if ($model->f_penugasan->saveAs(Yii::getAlias('@frontend').'/web/uploads/jabatan/'.$file)){
                        $model->f_penugasan = $file;           
                    }
                }

                if (empty($model->f_penugasan)){
                     $model->f_penugasan = $f_penugasan;
                }

                if($model->validate()){
                  $model->save();
                  $transaction->commit();
                  Yii::$app->session->setFlash('success', "Data tersimpan");
                  return $this->redirect(['view', 'id' => $model->ID]);  
                }
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Jabatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        // $this->findVer($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jabatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jabatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jabatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'3','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDownload($id) 
   { 
    $download = Jabatan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/jabatan/'.$download->f_penugasan;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Jabatan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/jabatan/'.$download->f_penugasan;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_penugasan,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
