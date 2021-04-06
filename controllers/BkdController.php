<?php

namespace app\controllers;

use Yii;
use app\models\BkdPeriode;
use app\models\BkdDosen;
use app\models\TugasDosenBkd;
use app\models\TugasDosen;
use app\models\KomponenKegiatan;
use app\models\Pengajaran;
use app\models\Organisasi;
use app\models\PengelolaJurnal;
use app\models\Publikasi;
use app\models\Pengabdian;
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
        
        $bkd_periode = BkdPeriode::find()->where(['buka' => 'Y'])->one();

        $unsur_utama = \app\models\UnsurUtama::find()->orderBy(['urutan'=>SORT_ASC])->all();
        $results = [];

        foreach($unsur_utama as $item)
        {
          $tmp = [];
          foreach($item->komponenKegiatans as $komponen)
          {
            $list_bkd = BkdDosen::find()->where([
              'tahun_id' => $bkd_periode->tahun_id,
              'dosen_id' => $user->ID,
              'komponen_id' => $komponen->id
            ])->all();
            foreach($list_bkd as $bkd)
            {
              $tmp[] = $bkd;
            }
            
          }

          $results[$item->id] = [
            'unsur' => $item->nama,
            'items' => $tmp
          ];
        }



        return $this->render('index',[
            'results' => $results,
            'bkd_periode' =>   $bkd_periode,
           
        ]);
        
    }

    public function actionKlaim()
    {
        $list_bkd_periode = BkdPeriode::find()->all();
        return $this->render('klaim',[
          'list_bkd_periode' => $list_bkd_periode
        ]);
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
          $bkd = BkdDosen::find()->where([
            'tahun_id' => $dataPost['tahun_id'],
            'dosen_id' => Yii::$app->user->identity->ID,
            'komponen_id' => $komponen->id,
            'kondisi' => $model->jadwal_id
          ])->one();

          if($model->is_claimed == '1')
          {
            if(empty($bkd))
            {
              $bkd = new BkdDosen;
            }

            $bkd->tahun_id = $dataPost['tahun_id'];
            $bkd->dosen_id = Yii::$app->user->identity->ID;
            $bkd->komponen_id = $komponen->id;
            $bkd->deskripsi = 'Mengadakan perkuliahan '.$model->matkul.' kode mk '.$model->kode_mk.' kelas '.$model->kelas.' '.$model->sks.' sks';
            $bkd->kondisi = (string)$model->jadwal_id;
            $bkd->sks = $komponen->angka_kredit * $dataPost['sks'];

            if(!$bkd->save())
            {
              $results = [
                'code' => 500,
                'message' => \app\helpers\MyHelper::logError($bkd)
              ];

              // print_r($results);exit;
            }
          }

          else if($model->is_claimed == '0')
          {
            if(!empty($bkd))
              $bkd->delete();
          }

          

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
          $bkd = BkdDosen::find()->where([
            'tahun_id' => $dataPost['tahun_id'],
            'dosen_id' => Yii::$app->user->identity->ID,
            'komponen_id' => $komponen->id,
            'kondisi' => (string)$model->id
          ])->one();

          if($model->is_claimed == '1')
          {
            if(empty($bkd))
            {
              $bkd = new BkdDosen;
            }

            $bkd->tahun_id = $dataPost['tahun_id'];
            $bkd->dosen_id = Yii::$app->user->identity->ID;
            $bkd->komponen_id = $komponen->id;
            $bkd->deskripsi = 'Melakukan publikasi '.$model->nama_kategori_kegiatan.' judul '.$model->judul_publikasi_paten;
            $bkd->kondisi = (string)$model->id;
            $bkd->sks = $komponen->angka_kredit;

            if(!$bkd->save())
            {
              $results = [
                'code' => 500,
                'message' => \app\helpers\MyHelper::logError($bkd)
              ];

              print_r($results);exit;
            }
          }

          else if($model->is_claimed == '0')
          {
            if(!empty($bkd))
              $bkd->delete();
          }
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

    public function actionAjaxClaimPengabdian()
    {
      $dataPost = $_POST['dataPost'];
      $model = Pengabdian::findOne($dataPost['id']);
      $resutls = [];
      if(!empty($model))
      {
        $komponen = $model->komponenKegiatan;
        
        if(empty($komponen))
        {
          $results = [
            'code' => 500,
            'message' => 'Oops, KomponenKegiatan is empty'
          ];
        }

        else
        {
          $model->komponen_kegiatan_id = $komponen->id;
          $model->nilai = $komponen->angka_kredit;
          $model->is_claimed = $dataPost['is_claimed'];
          if($model->save(false,['is_claimed','komponen_kegiatan_id','sks_bkd']))
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

    public function actionAjaxClaimOrganisasi()
    {
      $resutls = [];
      $dataPost = $_POST['dataPost'];
      $model = Organisasi::findOne($dataPost['id']);
      
      if(!empty($model))
      {
        $komponen = $model->komponenKegiatan;
        
        if(empty($komponen))
        {
          $results = [
            'code' => 500,
            'message' => 'Oops, KomponenKegiatan is empty'
          ];
        }

        else
        {
          $model->komponen_kegiatan_id = $komponen->id;
          $model->sks_bkd = $komponen->angka_kredit;
          $model->is_claimed = $dataPost['is_claimed'];
          $bkd = BkdDosen::find()->where([
            'tahun_id' => $dataPost['tahun_id'],
            'dosen_id' => Yii::$app->user->identity->ID,
            'komponen_id' => $komponen->id,
            'kondisi' => (string)$model->ID
          ])->one();
          if($model->is_claimed == '1')
          {
            if(empty($bkd))
            {
              $bkd = new BkdDosen;
            }

            $bkd->tahun_id = $dataPost['tahun_id'];
            $bkd->dosen_id = Yii::$app->user->identity->ID;
            $bkd->komponen_id = $komponen->id;
            $bkd->deskripsi = 'Menjadi '.$model->jabatan.' pada '.$model->organisasi;
            $bkd->kondisi = (string)$model->ID;
            $bkd->sks = $komponen->angka_kredit;

            if(!$bkd->save())
            {
              $results = [
                'code' => 500,
                'message' => \app\helpers\MyHelper::logError($bkd)
              ];

              // print_r($results);exit;
            }
          }

          else if($model->is_claimed == '0')
          {
            if(!empty($bkd))
              $bkd->delete();
          }
          if($model->save(false,['is_claimed','komponen_kegiatan_id','sks_bkd']))
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

    public function actionAjaxClaimPengelolaJurnal()
    {
      $dataPost = $_POST['dataPost'];
      $model = PengelolaJurnal::findOne($dataPost['id']);
      $resutls = [];
      if(!empty($model))
      {
        $komponen = $model->komponenKegiatan;
        
        if(empty($komponen))
        {
          $results = [
            'code' => 500,
            'message' => 'Oops, KomponenKegiatan is empty'
          ];
        }

        else
        {
          $model->komponen_kegiatan_id = $komponen->id;
          $model->sks_bkd = $komponen->angka_kredit;
          $model->is_claimed = $dataPost['is_claimed'];
          $bkd = BkdDosen::find()->where([
            'tahun_id' => $dataPost['tahun_id'],
            'dosen_id' => Yii::$app->user->identity->ID,
            'komponen_id' => $komponen->id,
            'kondisi' => (string)$model->ID
          ])->one();
          if($model->is_claimed == '1')
          {
            if(empty($bkd))
            {
              $bkd = new BkdDosen;
            }

            $bkd->tahun_id = $dataPost['tahun_id'];
            $bkd->dosen_id = Yii::$app->user->identity->ID;
            $bkd->komponen_id = $komponen->id;
            $bkd->deskripsi = 'Menjadi '.$model->peran_dalam_kegiatan.' di jurnal '.$model->nama_media_publikasi;
            $bkd->kondisi = (string)$model->id;
            $bkd->sks = $komponen->angka_kredit;

            if(!$bkd->save())
            {
              $results = [
                'code' => 500,
                'message' => \app\helpers\MyHelper::logError($bkd)
              ];

              print_r($results);exit;
            }
          }

          else if($model->is_claimed == '0')
          {
            if(!empty($bkd))
              $bkd->delete();
          }
          if($model->save(false,['is_claimed','komponen_kegiatan_id','sks_bkd']))
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

    public function actionAjaxClaimPenunjangLain()
    {
      $dataPost = $_POST['dataPost'];
      $model = \app\models\PenunjangLain::findOne($dataPost['id']);
      $resutls = [];
      if(!empty($model))
      {
        $komponen = $model->komponenKegiatan;
        
        if(empty($komponen))
        {
          $results = [
            'code' => 500,
            'message' => 'Oops, KomponenKegiatan is empty'
          ];
        }

        else
        {
          $model->komponen_kegiatan_id = $komponen->id;
          $model->sks_bkd = $komponen->angka_kredit;
          $model->is_claimed = $dataPost['is_claimed'];
          $bkd = BkdDosen::find()->where([
            'tahun_id' => $dataPost['tahun_id'],
            'dosen_id' => Yii::$app->user->identity->ID,
            'komponen_id' => $komponen->id,
            'kondisi' => (string)$model->id
          ])->one();
          if($model->is_claimed == '1')
          {
            if(empty($bkd))
            {
              $bkd = new BkdDosen;
            }

            $bkd->tahun_id = $dataPost['tahun_id'];
            $bkd->dosen_id = Yii::$app->user->identity->ID;
            $bkd->komponen_id = $komponen->id;
            $bkd->deskripsi = 'Menjadi '.$model->jenisPanitia->nama.' pada kegiatan '.$model->nama_kegiatan;
            $bkd->kondisi = (string)$model->id;
            $bkd->sks = $komponen->angka_kredit;

            if(!$bkd->save())
            {
              $results = [
                'code' => 500,
                'message' => \app\helpers\MyHelper::logError($bkd)
              ];

              print_r($results);exit;
            }
          }

          else if($model->is_claimed == '0')
          {
            if(!empty($bkd))
              $bkd->delete();
          }
          if($model->save(false,['is_claimed','komponen_kegiatan_id','sks_bkd']))
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
