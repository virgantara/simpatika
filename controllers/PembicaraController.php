<?php

namespace app\controllers;

use Yii;
use app\models\SisterFiles;
use app\models\SisterFilesSearch;
use app\models\Pembicara;
use app\models\PembicaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PembicaraController implements the CRUD actions for Pembicara model.
 */
class PembicaraController extends AppController
{
    /**
     * {@inheritdoc}
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
        if(!isset($sisterToken)){
            $sisterToken = \app\helpers\MyHelper::getSisterToken();
        }

        // print_r($sisterToken);exit;
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 5.0,
            'headers' => $headers,
            // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
        ]);
        $full_url = $sister_baseurl.'/Pembicara';
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
                    // print_r($item);exit;
                    $model = Pembicara::find()->where([
                        'sister_id' => $item->id_riwayat_pembicara_orasi
                    ])->one();

                    if(empty($model))
                        $model = new Pembicara;

                    $model->NIY = Yii::$app->user->identity->NIY;
                    $model->sister_id = $item->id_riwayat_pembicara_orasi;
                    $model->nama_kategori_kegiatan = $item->nama_kategori_kegiatan;
                    $model->judul_makalah = $item->judul_buku_makalah;
                    $model->nama_pertemuan_ilmiah = $item->nama_pertemuan_ilmiah;
                    $model->penyelenggara_kegiatan = $item->penyelenggara_kegiatan;
                    $model->tanggal_pelaksanaan = $item->tanggal_pelaksanaan;
                    if($model->save())
                    {
                        $counter++;

                        $full_url = $sister_baseurl.'/Pembicara/detail';
                        $response = $client->post($full_url, [
                            'body' => json_encode([
                                'id_token' => $sisterToken,
                                'id_dosen' => $user->sister_id,
                                'id_riwayat_pembicara_orasi' => $item->id_riwayat_pembicara_orasi
                            ]), 
                            'headers' => ['Content-type' => 'application/json']

                        ]); 
                        
                        
                        $response = json_decode($response->getBody());
                        if($response->error_code == 0){
                            $results = $response->data;
                            if(!empty($results->files))
                            {
                                foreach($results->files as $file)
                                {
                                    $pf = SisterFiles::findOne($file->id_dokumen);
                                    if(empty($pf))
                                        $pf = new SisterFiles;

                                    $pf->id_dokumen = $file->id_dokumen;
                                    $pf->parent_id = $item->id_riwayat_pembicara_orasi;
                                    $pf->nama_dokumen = $file->nama_dokumen;
                                    $pf->nama_file = $file->nama_file;
                                    $pf->jenis_file = $file->jenis_file;
                                    $pf->tanggal_upload = $file->tanggal_upload;
                                    $pf->nama_jenis_dokumen = $file->nama_jenis_dokumen;
                                    $pf->tautan = $file->tautan;
                                    $pf->keterangan_dokumen = $file->keterangan_dokumen;

                                    if(!$pf->save())
                                    {
                                        $errors .= 'PF: '.\app\helpers\MyHelper::logError($pf);
                                        throw new \Exception;
                                    }
                                }
                            }
                        }

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
     * Lists all Pembicara models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembicaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pembicara model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }

        $searchModel = new SisterFilesSearch();
        $searchModel->parent_id = $model->sister_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Pembicara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pembicara();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pembicara model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pembicara model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pembicara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pembicara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembicara::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
