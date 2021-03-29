<?php

namespace app\controllers;

use Yii;
use app\models\Pengajaran;
use app\models\Verify;
use app\models\PengajaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\httpclient\Client;

/**
 * PengajaranController implements the CRUD actions for Pengajaran model.
 */
class PengajaranController extends Controller
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

    public function actionAjaxJadwal()
    {
        $api_baseurl = Yii::$app->params['api_baseurl'];
        $client = new Client(['baseUrl' => $api_baseurl]);
        $client_token = Yii::$app->params['client_token'];
        $headers = ['x-access-token'=>$client_token];
        $dataPost = $_POST['dataPost'];
        $results = [];
        // foreach($listTahun as $tahun)
        // {
        $params = [
            'uuid' => Yii::$app->user->identity->uuid,
            'tahun' => $dataPost['tahun']
        ];

        $response = $client->get('/jadwal/dosen/uuid', $params,$headers)->send();
         // print_r($params);exit;
        if ($response->isOk) {
            $results = $response->data['values'];
           
        }

        // }

        echo \yii\helpers\Json::encode($results);
        die();
    }

    /**
     * Lists all Pengajaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new PengajaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengajaran model.
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
     * Creates a new Pengajaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //   $model = new Pengajaran();
    //   $tambah = new Verify();

    //   if ($model->load(Yii::$app->request->post())) {
    //     $model->NIY = Yii::$app->user->identity->NIY;
    //     $tambah->NIY = Yii::$app->user->identity->NIY;
    //     $tambah->kategori = 12;
    //     $tambah->ver = 'Belum Diverifikasi';
    //     $f_penugasan =UploadedFile::getInstance($model,'f_penugasan');
    //     if(!empty($f_penugasan)){
    //       $NameImage = $model->institusi.'-'.$model->jurusan.'-'.$model->tahun_awal.'-'.date('Ymd').'.'.$f_penugasan->extension;
    //       $model->f_penugasan = $NameImage;
    //         $model->ver = 'Sudah Diverifikasi'; // by pass only
    //         if($model->save()){
    //           if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/pengajaran'))
    //             mkdir(Yii::getAlias('@frontend').'/web/uploads/pengajaran');

    //           $f_penugasan -> saveAs(Yii::getAlias('@frontend').'/web/uploads/pengajaran/'.$NameImage);
    //           $tambah->ID_data = $model->ID;
    //           $tambah->save();
    //           return $this->redirect(['view', 'id' => $model->ID]); 
    //         }}
    //         $model->save();
    //         $tambah->ID_data = $model->ID;
    //         $tambah->save();
    //         return $this->redirect(['view', 'id' => $model->ID]);   
    //       } else {
    //         return $this->render('create', [
    //           'model' => $model,
    //         ]);
    //       }
    // }

    /**
     * Updates an existing Pengajaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);
      $f_penugasan = $model->f_penugasan;
      $errors = '';

      $s3config = Yii::$app->params['s3'];

      $s3 = new \Aws\S3\S3Client($s3config);

      if ($model->load(Yii::$app->request->post())) 
      {
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
         

          try 
          {
              
              $model->f_penugasan =UploadedFile::getInstance($model,'f_penugasan');
              
              if($model->f_penugasan)
              {
                $f_penugasan = $model->f_penugasan->tempName;
                $mime_type = $model->f_penugasan->type;
                $file = 'bukti_ajar_'.$model->pengajaranData->nama.'_'.$model->NIY.'.'.$model->f_penugasan->extension;

                $key = 'pengajaran/bukti/'.$file;
                $errors = '';

                 
                $insert = $s3->putObject([
                     'Bucket' => 'dosen',
                     'Key'    => $key,
                     'Body'   => 'This is the Body',
                     'SourceFile' => $f_penugasan,
                     'ContentType' => $mime_type
                ]);

                $plainUrl = $s3->getObjectUrl('dosen', $key);
                $model->f_penugasan = $plainUrl;
              }

              if (empty($model->f_penugasan)){
                  $model->f_penugasan = $f_penugasan;
              }

              if($model->validate())
              {
                $model->save();
                $transaction->commit();
              }

              else{
                $errors .= \app\helpers\MyHelper::logError($model);
                throw new \Exception;
              }
          }

          catch(\Exception $e)
          {
            $transaction->rollBack();
            $errors .= $e->getMessage();
            Yii::$app->getSession()->setFlash('danger',$errors);
          } 
      }    

      return $this->render('update',[
        'model' => $model
      ]);
    }

    /**
     * Deletes an existing Pengajaran model.
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
     * Finds the Pengajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
      if (($model = Pengajaran::findOne($id)) !== null) {
        return $model;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
    
    protected function findVer($id)
    {
      if (($very = Verify::findOne(['kategori'=>'12','ID_data'=>$id])) !== null) {
        return $very;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
    
    // public function actionDownload($id) 
    // { 
    //   $download = Pengajaran::findOne($id); 
    //   $path=Yii::getAlias('@webroot').'/uploads/pengajaran/'.$download->f_penugasan;
    //   if (file_exists($path)) {
    //     echo 'sukese';
    //     return Yii::$app->response->sendFile($path);
    //   }else{
    //     echo 'file not exists...';
    //   }
    // }
    
    // public function actionDisplay($id) 
    // { 
    //   $download = Pengajaran::findOne($id); 
    //   $path=Yii::getAlias('@webroot').'/uploads/pengajaran/'.$download->f_penugasan;
    //   if (file_exists($path)) {
    //     echo 'sukese';
    //     return Yii::$app->response->sendFile($path,$download->f_penugasan,['inline'=>true]);
    //   }else{
    //     echo 'file not exists...';
    //   }
    // }
    
  }
