<?php

namespace app\controllers;
use Yii;
use app\models\UnitKerja;
use app\models\Jabatan;

class UnitKerjaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAjaxListPegawai()
    {
    	if(Yii::$app->request->isPost)
        {
        	$dataPost = $_POST['dataPost'];

        	$listJabatan = Jabatan::find()->where([
        		'unker_id' => $dataPost['unker_id']
        	])->all();

        	$results = [];

        	foreach($listJabatan as $jab)
        	{
        		$results[] = [
        			'id' => $jab->nIY->ID,
        			'nama' => $jab->nIY->dataDiri->nama,

        		];
        	}

        	echo json_encode($results);

        	die();

        }
    }
}
