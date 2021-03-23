<?php

namespace app\controllers;

use Yii;
use app\models\Pelatihan;
use app\models\Verify;
use app\models\PelatihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PelatihanController implements the CRUD actions for Pelatihan model.
 */
class PelatihanController extends Controller
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
     * Lists all Pelatihan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new PelatihanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Pelatihan model.
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
     * Creates a new Pelatihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pelatihan();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       
        $model->NIY = Yii::$app->user->identity->NIY;
        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 8;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();

                $model->f_sertifikat = UploadedFile::getInstance($model,'f_sertifikat');
                if($model->f_sertifikat){
                    $file = date('YmdHis').$model->f_sertifikat->name.'.'.$model->f_sertifikat->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/pelatihan'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/pelatihan');


                    if ($model->f_sertifikat->saveAs(Yii::getAlias('@frontend').'/web/uploads/pelatihan/'.$file)){
                        $model->f_sertifikat = $file;           
                    }
                }

                if($model->save())
                {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Data tersimpan");
                    return $this->redirect(['pelatihan/view', 'id' => $model->ID]);  
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
     * Updates an existing Pelatihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'8','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 8;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
            }
        $sementara = $model->f_sertifikat;
        if ($model->load(Yii::$app->request->post())) {
            $model->NIY = Yii::$app->user->identity->NIY;
            $model->ver='Belum Diverifikasi';
            $f_sertifikat =UploadedFile::getInstance($model,'f_sertifikat');
            if(!empty($f_sertifikat)){
            $NameImage = $model->nama_pelatihan.'-'.$model->tanggal_awal.'-'.$model->penyelenggara.'-'.date('Ymd').'.'.$f_sertifikat->extension;
            $model->f_sertifikat = $NameImage;
            if($model->save()){
                $f_sertifikat -> saveAs('uploads/'.$model->NIY.'/pelatihan/'.$NameImage);
                return $this->redirect(['view', 'id' => $model->ID]); 
            }}
            $model->f_sertifikat = $sementara;
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);  
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pelatihan model.
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
     * Finds the Pelatihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelatihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pelatihan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'8','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

       public function actionDownload($id) 
   { 
    $download = Pelatihan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/pelatihan/'.$download->f_sertifikat;
    if (file_exists($path)) {
        echo 'sukese';
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
   }
    
       public function actionDisplay($id) 
   { 
    $download = Pelatihan::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/pelatihan/'.$download->f_sertifikat;
    if (file_exists($path)) {
        echo 'sukese';
        return Yii::$app->response->sendFile($path,$download->f_sertifikat,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
   }
}
