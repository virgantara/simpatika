<?php

namespace app\controllers;

use Yii;
use app\models\LppmPenelitian;
use app\models\LppmPenelitianSearch;
use app\models\LppmPenelitianAnggotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * LppmPenelitianController implements the CRUD actions for LppmPenelitian model.
 */
class LppmPenelitianController extends Controller
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

    public function actionPreview($id, $jenis, $kategori){
        $model = $this->findModel($id);

        if($kategori == 'pr')
        {
            $completePath = Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/proposal/'.$model->file_proposal;

            // print_r($completePath);exit;   
            if(file_exists($completePath))
            {
                return Yii::$app->response->sendFile($completePath, $model->file_proposal, ['inline'=>true]);    
            }

            else{
                throw new \Exception("File : ".$model->file_proposal. " doesn't exist");
                
            }
        }

        else if($kategori == 'ba')
        {
            $completePath = Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/berita_acara/'.$model->berita_acara;


            if(file_exists($completePath))
            {
                return Yii::$app->response->sendFile($completePath, $model->berita_acara, ['inline'=>true]);    
            }

            else{
                throw new \Exception("File : ".$model->berita_acara. " doesn't exist");
                
            }
        }
     

    }

    /**
     * Lists all LppmPenelitian models.
     * @return mixed
     */
    public function actionIndex($jenis)
    {
        $searchModel = new LppmPenelitianSearch();
        $dataProvider = $searchModel->search($jenis,Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LppmPenelitian model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $searchModel = new LppmPenelitianAnggotaSearch();
        $searchModel->lppm_penelitian_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new LppmPenelitian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jenis)
    {
        $model = new LppmPenelitian();
        $model->NIY = Yii::$app->user->identity->NIY;
        $model->jenis_penelitian = $jenis;

        if ($model->load(Yii::$app->request->post())) {
            
            $model->file_proposal = UploadedFile::getInstance($model,'file_proposal');
            if($model->file_proposal){
                $file = $model->file_proposal->name;
                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm'))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm');

                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis);

                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y')))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y'));
                
                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/proposal'))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/proposal');
                
                if ($model->file_proposal->saveAs(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/proposal/'.$file)){
                    $model->file_proposal = $file;           
                }
            }

            $model->berita_acara = UploadedFile::getInstance($model,'berita_acara');
            if($model->berita_acara){
                $file = $model->berita_acara->name;
                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm'))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm');

                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis);

                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y')))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y'));
                
                if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/berita_acara'))
                    mkdir(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/berita_acara');
                
               
                if ($model->berita_acara->saveAs(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/berita_acara/'.$file)){
                    $model->berita_acara = $file;           
                }
            }
            
            if($model->validate()){
                $model->save();
            
                return $this->redirect(['index','jenis'=>$model->jenis_penelitian]);
            }
            else{

                 return $this->render('create', [
                    'model' => $model,
                    'jenis' => $jenis
                ]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'jenis' => $jenis
            ]);
        }
    }

    /**
     * Updates an existing LppmPenelitian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file_proposal = $model->file_proposal;
        $berita_acara = $model->berita_acara;

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->file_proposal = UploadedFile::getInstance($model,'file_proposal');
            if($model->file_proposal){
                $file = $model->file_proposal->name;
                if ($model->file_proposal->saveAs(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$model->jenis_penelitian.'/'.date('Y').'/proposal/'.$file)){
                    $model->file_proposal = $file;           
                }
            }

            if (empty($model->file_proposal)){
                 $model->file_proposal = $file_proposal;
            }

            $model->berita_acara = UploadedFile::getInstance($model,'berita_acara');
            if($model->berita_acara){
                $file = $model->berita_acara->name;
                if ($model->berita_acara->saveAs(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$model->jenis_penelitian.'/'.date('Y').'/berita_acara/'.$file)){
                    $model->berita_acara = $file;           
                }
            }

            if (empty($model->berita_acara)){
                 $model->berita_acara = $berita_acara;
            }

            if($model->validate()){
                $model->save();
            
                return $this->redirect(['index','jenis'=>$model->jenis_penelitian]);
            }
            else{
                print_r($model->errors);exit;
                 return $this->render('update', [
                    'model' => $model
                ]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'jenis' => $model->jenis_penelitian
        ]);
    }

    /**
     * Deletes an existing LppmPenelitian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $model = $this->findModel($id);
        $jenis = $model->jenis_penelitian;
        try 
        {
           
            @unlink(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/proposal/'.$model->file_proposal);
            @unlink(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$jenis.'/'.date('Y').'/berita_acara/'.$model->berita_acara);
           
            $model->delete();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->redirect(['index','jenis'=>$jenis]);
        } catch (\Throwable $e) {
            $transaction->rollBack();
            return $this->redirect(['index','jenis'=>$jenis]);
        }
        return $this->redirect(['index','jenis'=>$jenis]);
    }

     public function actionDeleteUpload() {
            
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $keys = Yii::$app->request->post('key');
        $key = explode(' ', $keys);
        
        $model = LppmPenelitian::find()->where([
                    'id' => $key[1],
                    //'create_id' => Yii::$app->user->id
                ])->one();
 
        if ($key[0] == 'file_proposal') {
            @unlink(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.$model->jenis_penelitian.'/'.date('Y').'/proposal/'.$model->file_proposal);
            $model->file_proposal = NULL;
            $model->save(false);
        }

        // if ($key[0] == 'berita_acara') {
        //     @unlink(Yii::getAlias('@frontend').'/web/uploads/'.$model->NIY.'/lppm/'.date('Y').'/berita_acara/'.$model->berita_acara);
        //     $model->berita_acara = NULL;
        //     $model->save(false);
        // }
 
        return [];
    }

    /**
     * Finds the LppmPenelitian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LppmPenelitian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LppmPenelitian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
