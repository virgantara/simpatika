<?php

namespace app\controllers;

use Yii;
use app\models\Organisasi;
use app\models\Verify;
use app\models\OrganisasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OrganisasiController implements the CRUD actions for Organisasi model.
 */
class OrganisasiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Organisasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new OrganisasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Organisasi model.
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
     * Creates a new Organisasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organisasi();
        $tambah = new Verify();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            $model->NIY = Yii::$app->user->identity->NIY;
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 7;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();

                $model->f_sk = UploadedFile::getInstance($model,'f_sk');
                if($model->f_sk){
                    $file = $model->f_sk->name.date('YmdHis').'_'.Yii::$app->user->identity->NIY.'.'.$model->f_sk->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/organisasi'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/organisasi');

                    if ($model->f_sk->saveAs(Yii::getAlias('@frontend').'/web/uploads/organisasi/'.$file)){
                        $model->f_sk = $file;           
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
     * Updates an existing Organisasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'7','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 7;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
        }
        
        $f_sk = $model->f_sk;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try 
        {
            $model->ver = 'Sudah Diverifikasi';
            if ($model->load(Yii::$app->request->post())) {

                $model->f_sk = UploadedFile::getInstance($model,'f_sk');
                if($model->f_sk){
                    $file = $model->f_sk->name.date('YmdHis').'_'.Yii::$app->user->identity->NIY.'.'.$model->f_sk->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/organisasi'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/organisasi');

                    if ($model->f_sk->saveAs(Yii::getAlias('@frontend').'/web/uploads/organisasi/'.$file)){
                        $model->f_sk = $file;           
                    }
                }

                if (empty($model->f_sk)){
                     $model->f_sk = $f_sk;
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
     * Deletes an existing Organisasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->findVer($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Organisasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organisasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organisasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'7','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionDownload($id) 
   { 
    $download = Organisasi::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/organisasi/'.$download->f_sk;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Organisasi::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/organisasi/'.$download->f_sk;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_sk,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
