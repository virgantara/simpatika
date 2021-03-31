<?php

namespace app\controllers;

use Yii;
use app\models\Hki;
use app\models\HkiAuthor;
use app\models\HkiSearch;
use app\models\Verify;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
/**
 * HkiController implements the CRUD actions for Hki model.
 */
class HkiController extends AppController
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
        $full_url = $sister_baseurl.'/Paten';
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
                    $model = Hki::find()->where([
                        'sister_id' => $item->id_riwayat_publikasi_paten
                    ])->one();

                    if(empty($model))
                        $model = new Hki;

                    $model->NIY = Yii::$app->user->identity->NIY;
                    $model->sister_id = $item->id_riwayat_publikasi_paten;
                    $model->judul = $item->judul_publikasi_paten;
                    $model->nama_jenis_publikasi = $item->nama_jenis_publikasi;
                    $model->tanggal_terbit = $item->tanggal_terbit;
                    $model->tahun_pelaksanaan = date('Y',strtotime($item->tanggal_terbit));
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
     * Lists all Hki models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HkiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hki model.
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
     * Creates a new Hki model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hki();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 16;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->id;
                $tambah->save();

                $model->berkas = UploadedFile::getInstance($model,'berkas');
                if($model->berkas){
                    $file = $model->berkas->name;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/hki');

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym')))
                        mkdir(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym'));

                    if ($model->berkas->saveAs(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym').'/'.$file)){
                        $model->berkas = date('Ym').'/'.$file;           
                    }
                }

                $model->ver = 'Sudah Diverifikasi';
                $model->save();

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new HkiAuthor;
                        $author->hki_id = $model->id;
                        $author->NIY = $aid;
                        if(!$author->save())
                        {
                            $errors .= \app\helpers\MyHelper::logError($author);
                            
                            throw new \Exception;
                        }
                    }
                }
                
                else
                {
                    $errors .= 'Author tidak boleh kosong';
                    throw new \Exception;
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', "Data tersimpan");
                return $this->redirect(['hki/view', 'id' => $model->id]);
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
     * Updates an existing Hki model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        
        $berkas = $model->berkas;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $very = Verify::findOne(['kategori'=>'16','ID_data'=>$id]);
                if(!empty($very)){
                    $very->ver = 'Belum Diverifikasi';
                    $very->save();
                }else{
                    $tambah = new Verify();
                    $tambah->NIY = Yii::$app->user->identity->NIY;
                    $tambah->kategori = 16;
                    $tambah->ver = 'Belum Diverifikasi';
                    $tambah->ID_data = $model->id;
                    $tambah->save();
                }
                

                $model->berkas = UploadedFile::getInstance($model,'berkas');
                if($model->berkas){
                    $file = $model->berkas->name;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/hki');

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym')))
                        mkdir(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym'));

                    if ($model->berkas->saveAs(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym').'/'.$file)){
                        $model->berkas = date('Ym').'/'.$file;           
                    }
                }

                if (empty($model->berkas)){
                     $model->berkas = $berkas;
                }

                $model->ver = 'Sudah Diverifikasi';
                if($model->validate())
                    $model->save();

                $listAuthors = $model->hkiAuthors;
                foreach($listAuthors as $d)
                {
                    $d->delete();
                }

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new HkiAuthor;
                        $author->hki_id = $model->id;
                        $author->NIY = $aid;
                        if(!$author->save())
                        {
                            $errors .= \app\helpers\MyHelper::logError($author);
                            
                            throw new \Exception;
                        }
                    }
                }
                
                else
                {
                    $errors .= 'Author tidak boleh kosong';
                    throw new \Exception;
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', "Data tersimpan");
                return $this->redirect(['hki/view', 'id' => $model->id]);
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDownload($id) 
    { 
        $download = Hki::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/hki/'.$download->berkas;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }else{
            echo 'file not exists...';    }
    }

    public function actionDisplay($id) 
    { 
        $download = Hki::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/hki/'.$download->berkas;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path,$download->berkas,['inline'=>true]);
        }else{
            echo 'file not exists...';
        }
    }

    /**
     * Deletes an existing Hki model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach($model->hkiAuthors as $author)
            $author->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hki model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hki the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hki::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
