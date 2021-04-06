<?php

namespace app\controllers;

use Yii;
use app\models\PengelolaJurnal;
use app\models\PengelolaJurnalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PengelolaJurnalController implements the CRUD actions for PengelolaJurnal model.
 */
class PengelolaJurnalController extends AppController
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

    public function actionAjaxList()
    {
        $dataPost = $_POST['dataPost'];
        $query = PengelolaJurnal::find();
        $query->where([
          'NIY' => Yii::$app->user->identity->NIY,
        ]);


        $results = $query->asArray()->all();
        echo \yii\helpers\Json::encode($results);
        die();
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
            $sisterToken = MyHelper::getSisterToken();
        }

        // print_r($sisterToken);exit;
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 5.0,
            'headers' => $headers,
            // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
        ]);
        $full_url = $sister_baseurl.'/PengelolaJurnal';
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
            // echo '<pre>';
            // print_r($results);
            // echo '</pre>';
            // exit;
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $counter = 0;
            $errors ='';
            try     
            {
                foreach($results as $item)
                {
                   
                    $model = PengelolaJurnal::find()->where([
                        'sister_id' => $item->id_riwayat_pengelola_jurnal
                    ])->one();

                    if(empty($model))
                        $model = new PengelolaJurnal;

                    $model->NIY = Yii::$app->user->identity->NIY;
                    $model->sister_id = $item->id_riwayat_pengelola_jurnal;
                    $model->peran_dalam_kegiatan = $item->peran_dalam_kegiatan;
                    $model->no_sk_tugas = $item->no_sk_tugas;
                    $model->apakah_masih_aktif = $item->apakah_masih_aktif;
                    $model->tgl_sk_tugas = $item->sk_penugasan_terhitung_mulai_tanggal;
                    $model->tgl_sk_tugas_selesai = $item->tanggal_berakhir_sk;
                    $model->nama_media_publikasi = $item->nama_media_publikasi;
                    
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
     * Lists all PengelolaJurnal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengelolaJurnalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengelolaJurnal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PengelolaJurnal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $model = new PengelolaJurnal();
        $model->NIY = Yii::$app->user->identity->NIY;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PengelolaJurnal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->validate())
            {
                $komponen = \app\models\KomponenKegiatan::findOne($model->komponen_kegiatan_id);
                $model->sks_bkd = $komponen->angka_kredit;
                $model->save();
            }
            
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PengelolaJurnal model.
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
     * Finds the PengelolaJurnal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengelolaJurnal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengelolaJurnal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
