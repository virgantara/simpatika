<?php

namespace app\controllers;

use Yii;
use app\models\Pendidikan;
use app\models\Verify;
use app\models\PendidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PendidikanController implements the CRUD actions for Pendidikan model.
 */
class PendidikanController extends Controller
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
     * Lists all Pendidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new PendidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Pendidikan model.
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
     * Creates a new Pendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pendidikan();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       
        $model->NIY = Yii::$app->user->identity->NIY;
        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 9;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();

                $model->f_ijazah = UploadedFile::getInstance($model,'f_ijazah');
                if($model->f_ijazah){
                    $file = date('YmdHis').$model->f_ijazah->name.'.'.$model->f_ijazah->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/pendidikan'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/pendidikan');


                    if ($model->f_ijazah->saveAs(Yii::getAlias('@frontend').'/web/uploads/pendidikan/'.$file)){
                        $model->f_ijazah = $file;           
                    }
                }

                if($model->save())
                {
                  $transaction->commit();
                  Yii::$app->session->setFlash('success', "Data tersimpan");
                  return $this->redirect(['pendidikan/view', 'id' => $model->ID]);  
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
     * Updates an existing Pendidikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        
        $f_ijazah = $model->f_ijazah;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $very = Verify::findOne(['kategori'=>'9','ID_data'=>$id]);
                if(!empty($very)){
                    $very->ver = 'Belum Diverifikasi';
                    $very->save();
                }else{
                    $tambah = new Verify();
                    $tambah->NIY = Yii::$app->user->identity->NIY;
                    $tambah->kategori = 9;
                    $tambah->ver = 'Belum Diverifikasi';
                    $tambah->ID_data = $model->ID;
                    $tambah->save();
                }
                

                $model->f_ijazah = UploadedFile::getInstance($model,'f_ijazah');
                if($model->f_ijazah){
                    $file = date('YmdHis').$model->f_ijazah->name.'.'.$model->f_ijazah->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/pendidikan'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/pendidikan');

               
                    if ($model->f_ijazah->saveAs(Yii::getAlias('@frontend').'/web/uploads/pendidikan/'.$file)){
                        $model->f_ijazah = $file;           
                    }
                }

                if (empty($model->f_ijazah)){
                     $model->f_ijazah = $f_ijazah;
                }


                if($model->validate())
                    $model->save();

                

                $transaction->commit();
                Yii::$app->session->setFlash('success', "Data tersimpan");
                return $this->redirect(['pendidikan/view', 'id' => $model->ID]);
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
     * Deletes an existing Pendidikan model.
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
     * Finds the Pendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pendidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'9','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
      public function actionDownload($id) 
   { 
    $download = Pendidikan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/pendidikan/'.$download->f_ijazah;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Pendidikan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/pendidikan/'.$download->f_ijazah;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_ijazah,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
