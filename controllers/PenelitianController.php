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
class PenelitianController extends AppController
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

    public function actionImport()
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }

        $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
        $sisterToken = \app\helpers\MyHelper::getSisterToken();
        
        // print_r($sisterToken);exit;
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 10.0,
            'headers' => $headers,
            // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
        ]);
        $full_url = $sister_baseurl.'/Penelitian';
        $response = $client->post($full_url, [
            'body' => json_encode([
                'id_token' => $sisterToken,
                'id_dosen' => $user->sister_id,
                'updated_after' => [
                    'tahun' => '2000',
                    'bulan' => '01',
                    'tanggal' => '01'
                ]
            ]), 
            'headers' => ['Content-type' => 'application/json']

        ]); 
        
        $results = [];
       
        $response = json_decode($response->getBody());
        
        if($response->error_code == 0)
        {
            $results = $response->data;
            
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $counter = 0;
            $errors ='';
            try     
            {
                foreach($results as $item)
                {
                    $model = Penelitian::find()->where([
                        'sister_id' => $item->id_penelitian_pengabdian
                    ])->one();

                    if(empty($model))
                        $model = new Penelitian;
                    $model->NIY = Yii::$app->user->identity->NIY;
                    $model->sister_id = $item->id_penelitian_pengabdian;
                    $model->judul_penelitian_pengabdian = $item->judul_penelitian_pengabdian;
                    $model->nama_skim = $item->nama_skim;
                    $model->nama_tahun_ajaran = $item->nama_tahun_ajaran;
                    $model->durasi_kegiatan = $item->durasi_kegiatan;

                    $full_url = $sister_baseurl.'/Penelitian/detail';
                    $resp = $client->post($full_url, [
                        'body' => json_encode([
                            'id_token' => $sisterToken,
                            'id_dosen' => $user->sister_id,
                            'id_penelitian_pengabdian' => $model->sister_id
                        ]), 
                        'headers' => ['Content-type' => 'application/json']

                    ]); 
                    
                    
                    $resp = json_decode($resp->getBody());
                    if($resp->error_code == 0){
                        $res = $resp->data;
                        $model->tahun_usulan = $res->nama_tahun_anggaran;
                        $model->tahun_kegiatan = $res->nama_tahun_anggaran;
                        $model->tahun_dilaksanakan = $res->nama_tahun_anggaran;
                        $model->tahun_pelaksanaan_ke = $res->tahun_pelaksanaan_ke;
                        $model->dana_dikti = $res->dana_dari_dikti;
                        $model->dana_pt = $res->dana_dari_PT;
                        $model->dana_institusi_lain = $res->dana_dari_instansi_lain;
                        // print_r($res);exit;
                    }

                    if($model->save())
                    {
                        $counter++;

                        
                    }

                    else
                    {
                        $errors .= \app\helpers\MyHelper::logError($model);
                        throw new \Exception;
                    }
                }

                $transaction->commit();
                Yii::$app->getSession()->setFlash('success',$counter.' data imported');
                return $this->redirect(['index']);
            }

            catch (\Exception $e) {
                $transaction->rollBack();
                $errors .= $e->getMessage();
                Yii::$app->getSession()->setFlash('danger',$errors);
                return $this->redirect(['index']);
            } 
        }


        else
        {
            Yii::$app->getSession()->setFlash('danger',json_encode($response));
            return $this->redirect(['index']);
        }


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
        $model = $this->findModel($id);
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $searchModel = new \app\models\PenelitianAnggotaSearch();
        $searchModel->penelitian_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
        // $sisterToken = \app\helpers\MyHelper::getSisterToken();
        // // if(!isset($sisterToken)){
        // //     $sisterToken = MyHelper::getSisterToken();
        // // }

        // // 
        // $sister_baseurl = Yii::$app->params['sister_baseurl'];
        // $headers = ['content-type' => 'application/json'];
        // $client = new \GuzzleHttp\Client([
        //     'timeout'  => 5.0,
        //     'headers' => $headers,
        //     // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
        // ]);
        // $full_url = $sister_baseurl.'/Penelitian/detail';
        // $response = $client->post($full_url, [
        //     'body' => json_encode([
        //         'id_token' => $sisterToken,
        //         'id_dosen' => $user->sister_id,
        //         'id_penelitian_pengabdian' => $model->sister_id
        //     ]), 
        //     'headers' => ['Content-type' => 'application/json']

        // ]); 
        
        // $results = [];
       
        // $response = json_decode($response->getBody());
        // if($response->error_code == 0){
        //     $results = $response->data;
        // }

        
        return $this->render('view', [
            'model' => $model,
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
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $model = new Penelitian();
        $model->NIY = Yii::$app->user->identity->NIY;

        if ($model->load(Yii::$app->request->post())) 
        {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $counter = 0;
            $errors ='';
            try     
            {

                if($model->save())
                {   
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success','Data successfully added');
                    return $this->redirect(['index']);
       
                }

                else
                {
                    $errors .= \app\helpers\MyHelper::logError($model);        
                    throw new \Exception;
                }
            }

            catch (\Exception $e) {
                $transaction->rollBack();
                $errors .= $e->getMessage();
                Yii::$app->getSession()->setFlash('danger',$errors);
                // return $this->redirect(['create']);
            } 
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Penelitian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $model = $this->findModel($id);
        $model->NIY = Yii::$app->user->identity->NIY;

        if ($model->load(Yii::$app->request->post())) 
        {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $counter = 0;
            $errors ='';
            try     
            {

                if($model->save())
                {   
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success','Data successfully added');
                    return $this->redirect(['index']);
       
                }

                else
                {
                    $errors .= \app\helpers\MyHelper::logError($model);        
                    throw new \Exception;
                }
            }

            catch (\Exception $e) {
                $transaction->rollBack();
                $errors .= $e->getMessage();
                Yii::$app->getSession()->setFlash('danger',$errors);
                // return $this->redirect(['create']);
            } 
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
