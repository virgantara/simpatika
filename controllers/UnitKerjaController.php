<?php

namespace app\controllers;
use Yii;

use app\models\Tendik;
use app\models\UnitKerja;
use app\models\Jabatan;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UnitKerjaController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page');
                },
                'only' => ['create','update','delete','index','list'],
                'rules' => [
                    
                    [
                        'actions' => ['create','update','delete','index'],
                        'allow' => true,
                        'roles' => ['Dosen','Staf'],
                    ],
                    [
                        'actions' => [
                            'create','update','delete','index','list','ajax-list-pegawai','ajax-list-anggota'
                        ],
                        'allow' => true,
                        'roles' => ['Dekan','Kepala','Kaprodi'],
                    ],
                    [
                        'actions' => [
                            'create','update','delete','index','list'
                        ],
                        'allow' => true,
                        'roles' => ['theCreator'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionAjaxAddAnggota()
    {
        if(Yii::$app->request->isPost)
        {
            $dataPost = $_POST['dataPost'];

            $model = Jabatan::find()->where([
                'unker_id' => $dataPost['unker_id'],
                'NIY' => $dataPost['user_id']
            ])->one();

            if(empty($model))
            {
                $model = new Jabatan;
                $model->unker_id = $dataPost['unker_id'];
                $model->NIY = $dataPost['user_id'];
            }

            $model->jabatan_id = $dataPost['jabatan_id'];
            $model->tanggal_awal = $dataPost['tmt'];


            $results = [];

            if($model->save())
            {
                $results = [
                    'code' => 200,
                    'message' => 'data added'
                ];
            }

            else{
                $errors = \app\helpers\MyHelper::logError($model);
                $results = [
                    'code' => 500,
                    'message' => $errors
                ];
            }
            echo json_encode($results);

            die();

        }
    }

    public function actionAjaxListAnggota()
    {
        if(Yii::$app->request->isPost)
        {
            $dataPost = $_POST['dataPost'];

            $query = Jabatan::find()->where([
                'unker_id' => $dataPost['unker_id']
            ]);

            // $query->joinWith([]);

            $query->andWhere(['<>','NIY',Yii::$app->user->identity->NIY]);

            $listJabatan = $query->all();
            $results = [];

            foreach($listJabatan as $jab)
            {
                $nama = !empty($jab->nIY->dataDiri) ? $jab->nIY->dataDiri->nama : '';
                if(empty($nama)){
                    $tendik = Tendik::find()->where(['NIY'=>$jab->NIY])->one();
                    if(!empty($tendik)){
                        $nama = $tendik->nama;
                    }
                }
                $results[] = [
                    'id' => $jab->nIY->ID,
                    'nama' => $nama,
                    'niy' => $jab->NIY,
                    'file_penugasan' => $jab->f_penugasan,
                    'tmt' => $jab->tanggal_awal,
                    'jabatan' => $jab->jabatan->nama

                ];
            }

            echo json_encode($results);

            die();

        }
    }

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
                    'niy' => $jab->NIY,
                    'file_penugasan' => $jab->f_penugasan,
                    'tmt' => $jab->tanggal_awal,
                    'jabatan' => $jab->jabatan->nama

        		];
        	}

        	echo json_encode($results);

        	die();

        }
    }
}
