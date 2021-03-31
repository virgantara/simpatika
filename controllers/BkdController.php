<?php

namespace app\controllers;

use Yii;
use app\models\TugasDosenBkd;
use app\models\TugasDosen;
use app\models\KomponenKegiatan;
use app\models\Pengajaran;
use app\models\Publikasi;
use yii\httpclient\Client;

class BkdController extends AppController
{
    public function actionIndex()
    {
        if(!parent::handleEmptyUser())
        {
            return $this->redirect(Yii::$app->params['sso_login']);
        }

        $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
        $api_baseurl = Yii::$app->params['api_baseurl'];
        $client = new Client(['baseUrl' => $api_baseurl]);
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

        // print_r($results);exit;
        $pengajaran = Pengajaran::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            // 'is_claimed' => 1,
            'tahun_akademik' => $tahun_akademik['tahun_id']
        ])->all();

        // print_r($tahun_akademik);exit;

        $query = Publikasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $query->andWhere(['not',['kegiatan_id' => null]]);

        $sd = $tahun_akademik['kuliah_mulai'];
        $ed = $tahun_akademik['nilai_selesai'];

        $query->andFilterWhere(['between','tanggal_terbit',$sd, $ed]);
        $query->orderBy(['tanggal_terbit'=>SORT_ASC]);

        $publikasi = $query->all();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'AJAR'
        ]);

        $bkd_ajar = $query->one();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'RISET'
        ]);

        $bkd_pub = $query->one();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'ABDIMAS'
        ]);

        $bkd_abdi = $query->one();

        $query = TugasDosenBkd::find();
        $query->joinWith(['unsur as u']);
        $query->where([
          'tugas_dosen_id'=>$user->dataDiri->tugas_dosen_id,
          'u.kode' => 'PENUNJANG'
        ]);

        $bkd_penunjang = $query->one();


        return $this->render('index',[
            'pengajaran' => $pengajaran,
            'publikasi' => $publikasi,
            'tahun_akademik' =>   $tahun_akademik,
            'bkd_ajar' => $bkd_ajar,
            'bkd_pub' => $bkd_pub,
            'bkd_abdi' => $bkd_abdi,
            'bkd_penunjang' => $bkd_penunjang
        ]);
        
    }

    public function actionKlaim()
    {
        return $this->render('klaim');
    }

    public function actionAjaxClaim()
    {
      $dataPost = $_POST['dataPost'];
      $model = Pengajaran::findOne($dataPost['id']);
      
      if(!empty($model))
      {

        $komponen = KomponenKegiatan::find()->where([
          'kondisi' => 'A'
        ])->one();
        
        if(empty($komponen))
        {
          $results = [
            'code' => 500,
            'message' => 'Oops, KomponenKegiatan is empty'
          ];
        }

        else
        {
          $model->komponen_id = $komponen->id;
          $model->sks_bkd = $komponen->angka_kredit;
          $model->is_claimed = $dataPost['is_claimed'];
          if($model->save(false,['is_claimed','komponen_id','sks_bkd']))
          {
          	$results = [
  	        	'code' => 200,
  	        	'message' => 'Data updated'
  	        ];
          }

          else
          {
            $results = [
              'code' => 500,
              'message' => 'Oops, something wrong'
            ];
          }
        }
        
      }

      echo json_encode($results);
      die();
    }

    public function actionAjaxClaimPublikasi()
    {
      $dataPost = $_POST['dataPost'];
      $model = Publikasi::findOne($dataPost['id']);
      
      if(!empty($model))
      {
        $komponen = $model->kegiatan;
        
        if(empty($komponen))
        {
          $results = [
            'code' => 500,
            'message' => 'Oops, KomponenKegiatan is empty'
          ];
        }

        else
        {
          $model->kegiatan_id = $komponen->id;
          $model->sks_bkd = $komponen->angka_kredit;
          $model->is_claimed = $dataPost['is_claimed'];
          if($model->save(false,['is_claimed','kegiatan_id','sks_bkd']))
          {
            $results = [
              'code' => 200,
              'message' => 'Data updated'
            ];
          }

          else
          {
            $results = [
              'code' => 500,
              'message' => 'Oops, something wrong'
            ];
          }
        }
      }

      echo json_encode($results);
      die();
    }

}
