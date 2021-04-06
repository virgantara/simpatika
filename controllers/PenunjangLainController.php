<?php

namespace app\controllers;

use Yii;
use app\models\PenunjangLain;
use app\models\PenunjangLainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\httpclient\Client;

/**
 * PenunjangLainController implements the CRUD actions for PenunjangLain model.
 */
class PenunjangLainController extends AppController
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
        $query = PenunjangLain::find();
        $query->where([
          'NIY' => Yii::$app->user->identity->NIY,
        ]);
        $results = [];
        foreach($query->all() as $item)
        {
            $results[] = [
                'id' =>$item->id,
                'peran' => $item->jenisPanitia->nama,
                'nama_kegiatan' => $item->nama_kegiatan,
                'instansi' => $item->instansi,
                'tanggal_mulai' => $item->tanggal_mulai,
                'tanggal_selesai' => $item->tanggal_selesai,
                'sks_bkd' => $item->sks_bkd,
                'is_claimed' => $item->is_claimed
            ];
        }

        echo \yii\helpers\Json::encode($results);
        die();
    }

    /**
     * Lists all PenunjangLain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenunjangLainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenunjangLain model.
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
     * Creates a new PenunjangLain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PenunjangLain();
        $model->NIY = Yii::$app->user->identity->NIY;
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
        $sisterToken = \app\helpers\MyHelper::getSisterToken();
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 5.0,
            'headers' => $headers,
       
        ]);
        $full_url = $sister_baseurl.'/PenunjangLain/jenis';
        $response = $client->post($full_url, [
            'body' => json_encode([
                'id_token' => $sisterToken,
                'id_dosen' => $user->sister_id,
               
            ]), 
            'headers' => ['Content-type' => 'application/json']

        ]); 
        
        $list_jenis = [];
       
        $response = json_decode($response->getBody());
        if($response->error_code == 0){
            $list_jenis = $response->data;
            foreach($list_jenis as $q => $v)
            {
                $m = \app\models\JenisPanitia::find()->where([
                    'id' => $v->id_jenis_panitia
                ])->one();

                if(empty($m))
                    $m = new \app\models\JenisPanitia;

                $m->id = $v->id_jenis_panitia;
                $m->nama = $v->nama_jenis_kegiatan_kepanitiaan;
                if(!$m->save())
                {
                    print_r($v);exit;
                }
            }
        }


        if ($model->load(Yii::$app->request->post())) {
            $komponen = \app\models\KomponenKegiatan::findOne($model->komponen_kegaitan_id);
            $model->sks_bkd = $komponen->angka_kredit;
            $model->save();
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'list_jenis' => $list_jenis,
        ]);
    }

    /**
     * Updates an existing PenunjangLain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->NIY = Yii::$app->user->identity->NIY;
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }
        $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
        $sisterToken = \app\helpers\MyHelper::getSisterToken();
        $sister_baseurl = Yii::$app->params['sister_baseurl'];
        $headers = ['content-type' => 'application/json'];
        $client = new \GuzzleHttp\Client([
            'timeout'  => 5.0,
            'headers' => $headers,
       
        ]);
        $full_url = $sister_baseurl.'/PenunjangLain/jenis';
        $response = $client->post($full_url, [
            'body' => json_encode([
                'id_token' => $sisterToken,
                'id_dosen' => $user->sister_id,
               
            ]), 
            'headers' => ['Content-type' => 'application/json']

        ]); 
        
        $list_jenis = [];
       
        $response = json_decode($response->getBody());
        if($response->error_code == 0){
            $list_jenis = $response->data;
            foreach($list_jenis as $q => $v)
            {
                $m = \app\models\JenisPanitia::find()->where([
                    'id' => $q
                ])->one();

                if(empty($m))
                    $m = new \app\models\JenisPanitia;

                $m->id = $q;
                $m->nama = $v;
                $m->save();
            }
        }

        
        
        if ($model->load(Yii::$app->request->post())) {
            $komponen = $model->komponenKegiatan;
            $model->sks_bkd = $komponen->angka_kredit;
            $model->save();
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'list_jenis' => $list_jenis,
        ]);
    }

    /**
     * Deletes an existing PenunjangLain model.
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
     * Finds the PenunjangLain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenunjangLain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenunjangLain::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
