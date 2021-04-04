<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\helpers\MyHelper;
use app\models\Pengabdian;
use app\models\Verify;
use app\models\PengabdianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PengabdianController implements the CRUD actions for Pengabdian model.
 */
class PengabdianController extends AppController
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

    public function actionAjaxList()
    {
        $api_baseurl = Yii::$app->params['api_baseurl'];
        $client = new \yii\httpclient\Client(['baseUrl' => $api_baseurl]);
        $client_token = Yii::$app->params['client_token'];
        $headers = ['x-access-token'=>$client_token];

        $results = [];
        // foreach($listTahun as $tahun)
        // {
        $params = [
            
        ];

        $response = $client->get('/tahun/aktif', $params,$headers)->send();
         
        $tahun_akademik = '';

        if ($response->isOk) {
            $results = $response->data['values'];
            if(!empty($results[0]))
            {
                $tahun_akademik = $results[0];
            }
        }

        $dataPost = $_POST['dataPost'];
        $query = Pengabdian::find();
        $query->where([
          'NIY' => Yii::$app->user->identity->NIY,
          // 'tahun_kegiatan' => substr($dataPost['tahun'], 0,4)
        ]);

        $sd = $tahun_akademik['kuliah_mulai'];
        $ed = $tahun_akademik['nilai_selesai'];

        $query->andFilterWhere(['between','tgl_sk_tugas',$sd, $ed]);

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

        $user = User::findOne(Yii::$app->user->identity->ID);
        $sisterToken = MyHelper::getSisterToken();
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
        $full_url = $sister_baseurl.'/Pengabdian';
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
                   
                    $model = Pengabdian::find()->where([
                        'sister_id' => $item->id_penelitian_pengabdian
                    ])->one();

                    if(empty($model))
                        $model = new Pengabdian;

                    $model->NIY = Yii::$app->user->identity->NIY;
                    $model->sister_id = $item->id_penelitian_pengabdian;
                    $model->judul_penelitian_pengabdian = $item->judul_penelitian_pengabdian;
                    $model->nama_skim = $item->nama_skim;
                    $model->nama_tahun_ajaran = $item->nama_tahun_ajaran;
                    $model->durasi_kegiatan = $item->durasi_kegiatan;
                    $model->jenis_penelitian_pengabdian = $item->jenis_penelitian_pengabdian;
                    $full_url = $sister_baseurl.'/Pengabdian/detail';
                    $resp = $client->post($full_url, [
                        'body' => json_encode([
                            'id_token' => $sisterToken,
                            'id_dosen' => $user->sister_id,
                            'id_penelitian_pengabdian' => $model->sister_id
                        ]), 
                        'headers' => ['Content-type' => 'application/json']

                    ]); 
                    
                    $res = [];
                   
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
     * Lists all Pengabdian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new PengabdianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Pengabdian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new \app\models\PengabdianAnggotaSearch();
        $searchModel->pengabdian_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Pengabdian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $model = new Pengabdian();
        $model->NIY = Yii::$app->user->identity->NIY;
        $model->jenis_penelitian_pengabdian = 'M';

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
                    // $user = User::findOne(Yii::$app->user->identity->ID);
                    // $sisterToken = MyHelper::getSisterToken();
                    // $sister_baseurl = Yii::$app->params['sister_baseurl'];
                    // $sister_lembaga_iptek = Yii::$app->params['sister_lembaga_iptek'];
                    // $headers = ['content-type' => 'application/json'];
                    // $client = new \GuzzleHttp\Client([
                    //     'timeout'  => 5.0,
                    //     'headers' => $headers,
                    //     // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
                    // ]);
                    // $full_url = $sister_baseurl.'/Pengabdian/tambah';
                    // $data = [
                    //     'id_kategori_kegiatan' => $model->kategori_kegiatan_id,
                    //     'judul_penelitian_pengabdian' => $model->judul_penelitian_pengabdian,
                    //     'id_lembaga_iptek' => $sister_lembaga_iptek,
                    //     'id_kelompok_bidang' => $model->kelompok_bidang_id,
                    //     'id_jenis_skim' => $model->skim_kegiatan_id,
                    //     'tempat_kegiatan' => $model->tempat_kegiatan,
                    //     'tahun_usulan' => $model->tahun_usulan,
                    //     'tahun_kegiatan' => $model->tahun_kegiatan,
                    //     'tahun_dilaksanakan' => $model->tahun_dilaksanakan,
                    //     'durasi_kegiatan' => $model->durasi_kegiatan,
                    //     'tahun_pelaksanaan_ke' => $model->tahun_pelaksanaan_ke,
                    //     'dana_dari_dikti' => $model->dana_dikti,
                    //     'dana_dari_instansi_lain' => $model->dana_institusi_lain,
                    //     'dana_dari_PT' => $model->dana_pt,
                    //     'no_sk_penugasan' => $model->no_sk_tugas,
                    //     'tanggal_sk_penugasan' => [
                    //         'tanggal_sk_penugasan_tanggal' => date('d',strtotime($model->tgl_sk_tugas)),
                    //         'tanggal_sk_penugasan_tahun' => date('Y',strtotime($model->tgl_sk_tugas)),
                    //         'tanggal_sk_penugasan_bulan' => date('m',strtotime($model->tgl_sk_tugas)),
                    //     ],
                        
                        
                    //     // 'tgl_sk_tugas' => date('d/m/Y',strtotime($model->tgl_sk_tugas)),
                    // ];
                    // // echo '<pre>';
                    // // print_r($sisterToken);
                    // // echo '<br>';
                    // // print_r($user->sister_id);
                    // // echo '<br>';
                    // // print_r($data);
                    // // echo '</pre>';
                    // // exit;
                    // $response = $client->post($full_url, [
                    //     'body' => json_encode([
                    //         'id_token' => $sisterToken,
                    //         'id_dosen' => $user->sister_id,
                    //         'data' => $data
                    //     ]), 
                    //     'headers' => ['Content-type' => 'application/json']

                    // ]); 
                    
                    // $results = [];
                   
                    // $response = json_decode($response->getBody());
                    
                    // if($response->error_code == 0)
                    // {
                    //     $results = $response->data;
                    //     $model->sister_id = $results;
                    //     $model->save();
                    //     $transaction->commit();
                    //     Yii::$app->getSession()->setFlash('success','Data successfully added');
                    //     return $this->redirect(['index']);
                    // }

                    // else{
                    //     // print_r($response);exit;
                    //     $errors .= 'SIST_ERR: '.json_encode($response);
                    //     throw new \Exception;
                    // }
                    
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
     * Updates an existing Pengabdian model.
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
        $model->jenis_penelitian_pengabdian = 'M';

        if ($model->load(Yii::$app->request->post())) 
        {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $counter = 0;
            $errors ='';
            try     
            {
                $komponen = \app\models\KomponenKegiatan::findOne($model->komponen_kegiatan_id);
                if(!empty($komponen))
                {
                    $model->nilai = $komponen->angka_kredit;
                }
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
            } 
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Pengabdian model.
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
     * Finds the Pengabdian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengabdian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengabdian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'11','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
