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
use app\models\PublikasiAuthor;
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

        $bkd_periode = \app\models\BkdPeriode::find()->where(['buka' => 'Y'])->one();

        $pengajaran = Pengajaran::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            // 'is_claimed' => 1,
            'tahun_akademik' => $bkd_periode->tahun_id
        ])->all();

        // print_r($tahun_akademik);exit;

        $query = Publikasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $query->andWhere(['not',['kegiatan_id' => null]]);

        $sd = $bkd_periode->tanggal_bkd_awal;
        $ed = $bkd_periode->tanggal_bkd_akhir;


        $query->andFilterWhere(['between','tanggal_terbit',$sd, $ed]);
        $query->orderBy(['tanggal_terbit'=>SORT_ASC]);

        $publikasi = $query->all();

        $query = Pengabdian::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        // $sd = $tahun_akademik['kuliah_mulai'];
        // $ed = $tahun_akademik['nilai_selesai'];

        // $query->andFilterWhere(['between','tahun_kegiatan',$sd, $ed]);
        $query->orderBy(['tahun_kegiatan'=>SORT_ASC]);

        $pengabdian = $query->all();

        $query = Organisasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $organisasi = $query->all();

        $query = PengelolaJurnal::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $pengelolaJurnal = $query->all();

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
            'results' => $results,
            'bkd_periode' =>   $bkd_periode,
            'pengajaran' => $pengajaran,
            'user' => $user,
            'publikasi' => $publikasi,
            'pengabdian' => $pengabdian,
            'organisasi' => $organisasi,
            'pengelolaJurnal' => $pengelolaJurnal,
            'bkd_ajar' => $bkd_ajar,
            'bkd_pub' => $bkd_pub,
            'bkd_abdi' => $bkd_abdi,
            'bkd_penunjang' => $bkd_penunjang,
        ]);
        
    }

    public function actionPrint()
    {
        
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

        $bkd_periode = \app\models\BkdPeriode::find()->where(['buka' => 'Y'])->one();

        $pengajaran = Pengajaran::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            // 'is_claimed' => 1,
            'tahun_akademik' => $bkd_periode->tahun_id
        ])->all();

        // print_r($tahun_akademik);exit;

        $query = Publikasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $query->andWhere(['not',['kegiatan_id' => null]]);

        $sd = $bkd_periode->tanggal_bkd_awal;
        $ed = $bkd_periode->tanggal_bkd_akhir;


        $query->andFilterWhere(['between','tanggal_terbit',$sd, $ed]);
        $query->orderBy(['tanggal_terbit'=>SORT_ASC]);

        $publikasi = $query->all();

        $query = Pengabdian::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        // $sd = $tahun_akademik['kuliah_mulai'];
        // $ed = $tahun_akademik['nilai_selesai'];

        // $query->andFilterWhere(['between','tahun_kegiatan',$sd, $ed]);
        $query->orderBy(['tahun_kegiatan'=>SORT_ASC]);

        $pengabdian = $query->all();

        $query = Organisasi::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $organisasi = $query->all();

        $query = PengelolaJurnal::find()->where([
            'NIY' => Yii::$app->user->identity->NIY,
            'is_claimed' => 1,
        ]);

        $pengelolaJurnal = $query->all();

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

        try
        {

            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $fontpath = Yii::getAlias('@webroot').'/klorofil/assets/fonts/pala.ttf';
            
            $fontreg = \TCPDF_FONTS::addTTFfont($fontpath, 'TrueTypeUnicode', '', 86);
            $pdf->SetFont($fontreg, '', 12);
            $pdf->AddPage();
            ob_start();
            echo $this->renderPartial('cover', [
                'user' => $user,
                'bkd_periode' =>   $bkd_periode,
            ]);

            $data = ob_get_clean();
            ob_start();
            $imgdata = Yii::getAlias('@webroot').'/klorofil/assets/img/logo-ori.png';
            $pdf->Image($imgdata,$pdf->getPageWidth()/2 - 10,10,20);
            $pdf->Ln(50);
            // $pdf->writeHTMLCell(50, 38, '', $y, $grades, 1, 0, 0, true, 'J', true);
            $pdf->writeHTMLCell($pdf->getPageWidth() - 50,10,25,50,$data, 0, 0, 0, true, 'J', true);
            

            ob_start();
            echo $this->renderPartial('print', [
                 'results' => $results,
                 'user' => $user,
                'bkd_periode' =>   $bkd_periode,
                'pengajaran' => $pengajaran,
                // 'results' => $results,
                'publikasi' => $publikasi,
                'pengabdian' => $pengabdian,
                'organisasi' => $organisasi,
                'pengelolaJurnal' => $pengelolaJurnal,
                'bkd_ajar' => $bkd_ajar,
                'bkd_pub' => $bkd_pub,
                'bkd_abdi' => $bkd_abdi,
                'bkd_penunjang' => $bkd_penunjang,
            ]);

            $data = ob_get_clean();
            ob_start();
            
            
            $pdf->SetFont($fontreg, '', 10);
            $pdf->AddPage();
            // $imgdata = Yii::getAlias('@webroot').'/klorofil/assets/img/logo-ori.png';
            // $pdf->Image($imgdata,10,10,15);
            $pdf->writeHTML($data);

            
            $pdf->Output('lkd_'.$user->dataDiri->nama.'_'.rand(1,100).'.pdf','I');
        }
        catch(\HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
        die();
    }

    public function actionKlaim()
    {
        $list_bkd_periode = BkdPeriode::find()->orderBy(['tahun_id'=>SORT_DESC])->all();
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
            $user = \app\models\User::findOne(Yii::$app->user->identity->ID);
            $publikasiAuthor = PublikasiAuthor::find()->where([
              'author_id' => $user->dataDiri->sister_id,
              'publikasi_id' => $model->sister_id
            ])->one();
            $multiplier = !empty($publikasiAuthor) && $publikasiAuthor->urutan == 1 ? 0.6 : 0.4;
            $bkd->sks = $komponen->angka_kredit * $multiplier;

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
