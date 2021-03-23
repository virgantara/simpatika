<?php

namespace app\controllers;

use Yii;
use app\models\Dosen;
use app\models\Prodi;
use app\models\DataDiri;
use app\models\DosenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

/**
 * DosenController implements the CRUD actions for Dosen model.
 */
class DosenController extends Controller
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

    public function actionDisplay($id) 
    { 
        $dd = DataDiri::findOne(['NIY'=>$id]); 
        if(empty($dd)){
            echo 'Oops, Person not found';
            return;
        }
        $path=Yii::getAlias('@webroot').'/uploads/foto_profil/'.$dd->NIY.'/'.$dd->f_foto;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path,$dd->f_foto,['inline'=>true]);
        }else{
            $path=Yii::getAlias('@webroot').'/uploads/blank_foto.png';
            return Yii::$app->response->sendFile($path,'blank_foto.png',['inline'=>true]);

        }
    }

    public function actionAjaxCariDosen() {

        $q = $_GET['term'];
        
        $query = DataDiri::find();
        $query->where(['LIKE','nama',$q]);
        $query->orWhere(['LIKE','NIDN',$q]);
        $query->limit(10);
        $result = $query->all();
        $out = [];

    
        if(count($result) > 0)
        {
            foreach ($result as $d) {
                $out[] = [
                    'id' => $d->NIY,
                    'label'=> $d->NIDN.' - '.$d->nama,

                ];
            }
        }

        else
        {
            $out[] = [
                'id' => 0,
                'label'=> 'Data dosen tidak ditemukan',

            ];
        }
        
        

        echo \yii\helpers\Json::encode($out);


    }

    /**
     * Lists all Dosen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $prodi = \common\models\Prodi::find()->all();
        $prodi = ArrayHelper::map($prodi,'ID','nama');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'prodi' =>$prodi,
        ]);
    }

    /**
     * Displays a single Dosen model.
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
    
    public function actionDetail($id)
    {
        return $this->renderAjax('detail', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dosen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dosen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dosen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dosen model.
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

     public function actionFaculty()
    {
        $kategori = $_GET['kategori'];
         
        if($kategori == '1'){
            $model = Dosen::find()
            ->where(['or','id_prod=3','id_prod=4','id_prod=5'])
            ->orderBy('id_prod')
            ->all();
            $faculty = 'Ushuluddin';
        }else if($kategori == '2'){
            $faculty = 'Islamic Education';
            $model = Dosen::find()
            ->where(['or','id_prod=6','id_prod=7'])
            ->orderBy('id_prod')
            ->all();
        }else if($kategori == '3'){
            $faculty = "Shari'ah";
            $model = Dosen::find()
            ->where(['or','id_prod=8','id_prod=9'])
            ->orderBy('id_prod')
            ->all();
        }else if($kategori == '4'){
            $faculty = 'Economics and Management';
            $model = Dosen::find()
            ->where(['or','id_prod=10','id_prod=11'])
            ->orderBy('id_prod')
            ->all();
        }else if($kategori == '5'){
            $faculty = 'Humanities';
            $model = Dosen::find()
            ->where(['or','id_prod=12','id_prod=13'])
            ->orderBy('id_prod')
            ->all();
        }else if($kategori == '6'){
            $faculty = 'Science and Technology';
            $model = Dosen::find()
            ->where(['or','id_prod=14','id_prod=15','id_prod=16'])
            ->orderBy('id_prod')
            ->all();
        }else if($kategori == '7'){
            $faculty = 'Health Science';
            $model = Dosen::find()
            ->where(['or','id_prod=17','id_prod=18','id_prod=19'])
            ->orderBy('id_prod')
            ->all();
        }
        
        return $this->render('Faculty',[
            'faculty' => $faculty,
            'model'=>$model, 
        ]);
         
    }

    
    /**
     * Finds the Dosen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dosen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dosen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
