<?php

namespace app\controllers;

use Yii;
use app\helpers\MyHelper;
use app\models\User;
use app\models\Publikasi;
use app\models\JenisPublikasi;
use app\models\KategoriKegiatan;
use app\models\PublikasiAuthor;
use app\models\PublikasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PublikasiController implements the CRUD actions for Publikasi model.
 */
class PublikasiController extends AppController
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
        $query = Publikasi::find();
        $query->where([
          'NIY' => Yii::$app->user->identity->NIY,
        ]);

        $query->andWhere(['not',['kegiatan_id' => null]]);

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
        $full_url = $sister_baseurl.'/Publikasi';
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
        if($response->error_code == 0){
            $results = $response->data;
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
           
            $errors ='';
            try     
            {
                $counter = 0;
                foreach($results as $item)
                {

                    $jenisPublikasi = JenisPublikasi::find()->where(['nama'=> $item->nama_jenis_publikasi])->one();

                    if(empty($jenisPublikasi)){
                        $errors .= 'Jenis Publikasi '.$item->nama_jenis_publikasi.' belum ada di database';
                        throw new \Exception;
                    }
                        
                    

                    $model = Publikasi::find()->where([
                        'sister_id' => $item->id_riwayat_publikasi_paten
                    ])->one();

                    if(empty($model))
                        $model = new Publikasi;


                    $model->NIY = Yii::$app->user->identity->NIY;
                    $model->sister_id = $item->id_riwayat_publikasi_paten;
                    $model->judul_publikasi_paten = $item->judul_publikasi_paten;
                    $model->nama_jenis_publikasi = $item->nama_jenis_publikasi;
                    $model->jenis_publikasi_id = $jenisPublikasi->id;
                    
                    $model->tanggal_terbit = $item->tanggal_terbit;
                    $full_url = $sister_baseurl.'/Publikasi/detail';
                    $response = $client->post($full_url, [
                        'body' => json_encode([
                            'id_token' => $sisterToken,
                            'id_dosen' => $user->sister_id,
                            'id_riwayat_publikasi_paten' => $item->id_riwayat_publikasi_paten
                        ]), 
                        'headers' => ['Content-type' => 'application/json']

                    ]); 
                    
                    $results = [];
                   
                    $response = json_decode($response->getBody());
                    if($response->error_code == 0){
                        $detail = $response->data;
                        $model->tautan_laman_jurnal = $detail->tautan_laman_jurnal;
                        $model->tautan = $detail->tautan;
                        $model->volume = $detail->volume;
                        $model->nomor = $detail->nomor_hasil_publikasi;
                        $model->halaman = $detail->halaman;
                        $model->penerbit = $detail->nama_penerbit;
                        $model->doi = $detail->DOI_publikasi;
                        $model->issn = $detail->ISSN_publikasi;    
                        $model->nama_kategori_kegiatan = $detail->nama_kategori_kegiatan;
                        $kategoriKegiatan = KategoriKegiatan::find()->where(['nama'=> $detail->nama_kategori_kegiatan])->one();



                        if(empty($kategoriKegiatan)){
                            $errors .= 'KategoriKegiatan '.$item->nama_kategori_kegiatan.' belum ada di database';
                            throw new \Exception;
                        }

                        $model->kategori_kegiatan_id = $kategoriKegiatan->id;

                        foreach($detail->data_penulis as $author)
                        {
                            // print_r($author);exit;
                            $pa = PublikasiAuthor::find()->where([
                                'author_id' => $author->id_dosen,
                                'publikasi_id' => $item->id_riwayat_publikasi_paten
                            ])->one();

                            if(empty($pa))
                                $pa = new PublikasiAuthor;


                            $pa->author_id = $author->id_dosen;
                            $pa->author_nama = $author->nama;
                            $pa->publikasi_id = $item->id_riwayat_publikasi_paten;
                            $pa->urutan = $author->no_urut;
                            $pa->afiliasi = $author->afiliasi_penulis;
                            $pa->peran_nama = $author->peran_dalam_kegiatan;
                            $pa->corresponding_author = $author->apakah_corresponding_author;
                            $pa->jenis_peranan = $author->jenis_peranan;
                            if(!$pa->save())
                            {
                                $errors .= \app\helpers\MyHelper::logError($pa);
                                throw new \Exception;
                            }
                        }

                        if(!empty($detail->files))
                        {
                            foreach($detail->files as $file)
                            {
                                $pf = \app\models\SisterFiles::findOne($file->id_dokumen);
                                if(empty($pf))
                                    $pf = new \app\models\SisterFiles;

                                $pf->id_dokumen = $file->id_dokumen;
                                $pf->parent_id = $item->id_riwayat_publikasi_paten;
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
     * Lists all Publikasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublikasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publikasi model.
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

        $user = User::findOne(Yii::$app->user->identity->ID);
        $sisterToken = MyHelper::getSisterToken();
        // if(!isset($sisterToken)){
        //     $sisterToken = MyHelper::getSisterToken();
        // }

        // 
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 5.0,
            'headers' => $headers,
            // 'base_uri' => 'http://sister.unida.gontor.ac.id/api.php/0.1'
        ]);
        $full_url = $sister_baseurl.'/Publikasi/detail';
        $response = $client->post($full_url, [
            'body' => json_encode([
                'id_token' => $sisterToken,
                'id_dosen' => $user->sister_id,
                'id_riwayat_publikasi_paten' => $model->sister_id
            ]), 
            'headers' => ['Content-type' => 'application/json']

        ]); 
        
        $results = [];
       
        $response = json_decode($response->getBody());
        if($response->error_code == 0){
            $results = $response->data;
        }
        // echo '<pre>';
        // print_r($results);
        // echo '</pre>';
        // exit;

        return $this->render('view', [
            'model' => $model,
            'results' => $results
        ]);
    }

    /**
     * Creates a new Publikasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publikasi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Publikasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }

        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Publikasi model.
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
     * Finds the Publikasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publikasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publikasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
