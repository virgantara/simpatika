<?php

namespace app\controllers;

use app\models\KomponenKegiatan;
use app\models\Pengajaran;
use app\models\Publikasi;

class BkdController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
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

        $jabfung = $model->pengajaranData->kodeJabfung;
        $kondisi = '';

        if($jabfung == 'AA')
        {
          $kondisi = 'A11';  
        }

        $komponen = KomponenKegiatan::find()->where([
          'kondisi' => $kondisi
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
        $model->is_claimed = $dataPost['is_claimed'];
        if($model->save(false,['is_claimed']))
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

      echo json_encode($results);
      die();
    }

}
