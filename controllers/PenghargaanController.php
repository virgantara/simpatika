<?php

namespace app\controllers;

use Yii;
use app\models\Penghargaan;
use app\models\Verify;
use app\models\PenghargaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * PenghargaanController implements the CRUD actions for Penghargaan model.
 */
class PenghargaanController extends Controller
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
     * Lists all Penghargaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new PenghargaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Penghargaan model.
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
     * Creates a new Penghargaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penghargaan();
        $tambah = new Verify();

         if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $tambah->NIY = Yii::$app->user->identity->NIY;
            $tambah->kategori = 13;
            $tambah->ver = 'Belum Diverifikasi';
            $f_penghargaan =UploadedFile::getInstance($model,'f_penghargaan');
            if(!empty($f_penghargaan)){
            $NameImage = $model->bentuk.'-'.$model->tahun.'-'.$model->pemberi.'-'.date('Ymd').'.'.$f_penghargaan->extension;
            $model->f_penghargaan = $NameImage;
            if($model->save()){
                $f_penghargaan -> saveAs('uploads/'.$model->NIY.'/penghargaan/'.$NameImage);
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
     * Updates an existing Penghargaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'13','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 13;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
            }
        $sementara = $model->f_penghargaan;
        if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $model->ver='Belum Diverifikasi';
            $f_penghargaan =UploadedFile::getInstance($model,'f_penghargaan');
            if(!empty($f_penghargaan)){
            $NameImage = $model->bentuk.'-'.$model->tahun.'-'.$model->pemberi.'-'.date('Ymd').'.'.$f_penghargaan->extension;
            $model->f_penghargaan = $NameImage;
            if($model->save()){
                $f_penghargaan -> saveAs('uploads/'.$model->NIY.'/penghargaan/'.$NameImage);
                return $this->redirect(['view', 'id' => $model->ID]); 
            }}
            $model->f_penghargaan = $sementara;
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);   
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Penghargaan model.
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
     * Finds the Penghargaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penghargaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penghargaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'13','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDownload($id) 
   { 
    $download = Penghargaan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/penghargaan/'.$download->f_penghargaan;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Penghargaan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/penghargaan/'.$download->f_penghargaan;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_penghargaan,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
