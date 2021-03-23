<?php

namespace app\controllers;

use Yii;
use app\models\Assignment;
use app\models\Assign;
use app\models\Verify;
use app\models\AssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
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

    /**
     * Lists all Assignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $assign = \common\models\Assign::find()->all();
        $assign = ArrayHelper::map($assign,'ID','Keterangan');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'assign'=>$assign,
        ]);
        }
    }

    /**
     * Displays a single Assignment model.
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
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignment();
        $tambah = new Verify();
        
        $model->NIY = Yii::$app->user->identity->NIY;
        $tambah->NIY = Yii::$app->user->identity->NIY;
        $tambah->kategori = 1;
        $tambah->ver = 'Belum Diverifikasi';
        $wait = $_GET['id_ass'];
        $dup = Assignment::find()
            ->where(['NIY'=>Yii::$app->user->identity->NIY,'id_assign'=>$wait])
            ->count();
        
        $model->id_assign = $_GET['id_ass']; 
        if ($model->load(Yii::$app->request->post())) {
        $file =UploadedFile::getInstance($model,'file');
        if($dup == 0){
        if(!empty($file)){
        $NameImage = $model->assignmentAssign->Keterangan.'-'.date('Ymd').'.'.$file->extension;
        $model->file = $NameImage;
        if($model->save()){ 
        $file -> saveAs('uploads/'.$model->NIY.'/lainnya/'.$NameImage);
        $tambah->ID_data = $model->ID;
        $tambah->save();
        Yii::$app->getSession()->setFlash('success','Data Uploaded...');
        return $this->redirect('index.php?r=assign/index');
        }
        } 
        Yii::$app->getSession()->setFlash('danger','Please submit your file!!!');
        return $this->redirect('index.php?r=assign/index');
        }
        Yii::$app->getSession()->setFlash('danger','Your data has been uploaded to the server, please open your files menu...');
        return $this->redirect('index.php?r=assign/index');    
        }
        
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Assignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'1','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 1;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
            }
        $sementara = $model->file;
        
        if ($model->load(Yii::$app->request->post())) {
            $file =UploadedFile::getInstance($model,'file');
            if(!empty($file)){
            $NameImage = $model->assignmentAssign->Keterangan.'-'.date('Ymd').'.'.$file->extension;
            $model->file = $NameImage;
            $model->status='Belum Diverifikasi';
            if($model->save()){
                $file -> saveAs('uploads/'.$model->NIY.'/lainnya/'.$NameImage);
                return $this->redirect(['view', 'id' => $model->ID]); 
            }
            }
            $model->file = $sementara;
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);  
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Assignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->findVer($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assignment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'1','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDownload($id) 
   { 
    $download = Assignment::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/lainnya/'.$download->file;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
echo 'file not exists...';    }
   }
    
    public function actionDisplay($id) 
   { 
    $download = Assignment::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/'.$download->NIY.'/lainnya/'.$download->file;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->file,['inline'=>true]);
    }else{
echo 'file not exists...';    }
   }
}
