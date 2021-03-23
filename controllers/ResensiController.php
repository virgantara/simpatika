<?php

namespace app\controllers;

use Yii;
use app\models\Resensi;
use app\models\Verify;
use app\models\ResensiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ResensiController implements the CRUD actions for Resensi model.
 */
class ResensiController extends Controller
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
     * Lists all Resensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new ResensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Resensi model.
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
     * Creates a new Resensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resensi();
        $tambah = new Verify();

         if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $tambah->NIY = Yii::$app->user->identity->NIY;
            $tambah->kategori = 15;
            $tambah->ver = 'Belum Diverifikasi';
            $f_resensi =UploadedFile::getInstance($model,'f_resensi');
            if(!empty($f_resensi)){
            $NameImage = $model->judul.'-'.$model->tahun.'-'.$model->penerbit.'-'.date('Ymd').'.'.$f_resensi->extension;
            $model->f_resensi = $NameImage;
            if($model->save()){
                $f_resensi -> saveAs('uploads/'.$model->NIY.'/resensi/'.$NameImage);
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
     * Updates an existing Resensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'15','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 15;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
            }
        $sementara = $model->f_resensi;
        if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $model->ver='Belum Diverifikasi';
            $f_resensi =UploadedFile::getInstance($model,'f_resensi');
            if(!empty($f_resensi)){
            $NameImage = $model->judul.'-'.$model->tahun.'-'.$model->penerbit.'-'.date('Ymd').'.'.$f_resensi->extension;
            $model->f_resensi = $NameImage;
            if($model->save()){
                $f_resensi -> saveAs('uploads/'.$model->NIY.'/resensi/'.$NameImage);
                return $this->redirect(['view', 'id' => $model->ID]); 
            }}
            $model->f_resensi = $sementara;
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);   
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Resensi model.
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
     * Finds the Resensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resensi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'15','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionDownload($id) 
   { 
    $download = Resensi::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/resensi/'.$download->f_resensi;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Resensi::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/resensi/'.$download->f_resensi;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_resensi,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
