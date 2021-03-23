<?php

namespace app\controllers;

use Yii;
use app\models\Penelitian;
use app\models\Verify;
use app\models\PenelitianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * PenelitianController implements the CRUD actions for Penelitian model.
 */
class PenelitianController extends Controller
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
     * Lists all Penelitian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new PenelitianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Penelitian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $searchModel = new \app\models\PenelitianAnggotaSearch();
        $searchModel->penelitian_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Penelitian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penelitian();
        $tambah = new Verify();

         if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $tambah->NIY = Yii::$app->user->identity->NIY;
            $tambah->kategori = 10;
            $tambah->ver = 'Belum Diverifikasi';
            $f_penelitian =UploadedFile::getInstance($model,'f_penelitian');
            if(!empty($f_penelitian)){
            $NameImage = $model->judul.'-'.$model->tahun.'-'.$model->status.'-'.date('Ymd').'.'.$f_penelitian->extension;
            $model->f_penelitian = $NameImage;
            if($model->save()){
                $f_penelitian -> saveAs('uploads/'.$model->NIY.'/penelitian/'.$NameImage);
                $tambah->ID_data = $model->ID;
                $tambah->save();
                return $this->redirect(['view', 'id' => $model->ID]); 
            }}
            $model->save();
            $tambah->ID_data = $model->ID;
            $tambah->save();
            return $this->redirect(['view', 'id' => $model->ID]);   
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Penelitian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'10','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 10;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
        }
        $sementara = $model->f_penelitian;
        if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $model->ver='Belum Diverifikasi';
            
            $f_penelitian =UploadedFile::getInstance($model,'f_penelitian');
            if(!empty($f_penelitian)){
            $NameImage = $model->judul.'-'.$model->tahun.'-'.$model->status.'-'.date('Ymd').'.'.$f_penelitian->extension;
            $model->f_penelitian = $NameImage;
            if($model->save()){
                $f_penelitian -> saveAs('uploads/'.$model->NIY.'/penelitian/'.$NameImage);
                return $this->redirect(['view', 'id' => $model->ID]); 
            }}
            $model->f_penelitian = $sementara;
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);   
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Penelitian model.
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
     * Finds the Penelitian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penelitian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penelitian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'10','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDownload($id) 
   { 
    $download = Penelitian::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/penelitian/'.$download->f_penelitian;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Penelitian::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/penelitian/'.$download->f_penelitian;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_penelitian,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
