<?php

namespace app\controllers;

use Yii;
use app\models\Jurnal;
use app\models\JurnalAuthor;
use app\models\JurnalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * JurnalController implements the CRUD actions for Jurnal model.
 */
class JurnalController extends Controller
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

    /**
     * Lists all Jurnal models.
     * @return mixed
     */
    public function actionIndex()
    {
      
        $searchModel = new JurnalSearch();
        $dataProvider = $searchModel->searchItemku(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jurnal model.
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
     * Creates a new Jurnal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jurnal();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        

        try 
        {
            if ($model->load(Yii::$app->request->post())) {

                $model->path_berkas = UploadedFile::getInstance($model,'path_berkas');
                if($model->path_berkas){
                    $file = 'J'.date('YmdHis').Yii::$app->user->identity->NIY.'.'.$model->path_berkas->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/jurnal'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/jurnal');


                    if ($model->path_berkas->saveAs(Yii::getAlias('@frontend').'/web/uploads/jurnal/'.$file)){
                        $model->path_berkas = $file;           
                    }
                }

                $model->is_approved = 1;//by pass

                if($model->save())
                {
                    if(!empty($_POST['author_id']))
                    {
                        foreach($_POST['author_id'] as $aid)
                        {
                            if(empty($aid)) continue;

                            $author = new JurnalAuthor;
                            $author->jurnal_id = $model->id;
                            $author->NIY = $aid;
                            if(!$author->save())
                            {
                                $errors .= \app\helpers\MyHelper::logError($author);
                                
                                throw new \Exception;
                            }
                        }

                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Data tersimpan");
                        return $this->redirect(['jurnal/view', 'id' => $model->id]);
                    }
                    
                    else
                    {
                        $errors .= 'Author tidak boleh kosong';
                        throw new \Exception;
                    }
                }

                

                
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Jurnal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $path_berkas = $model->path_berkas;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        

        try 
        {
            if ($model->load(Yii::$app->request->post())) {

                $model->path_berkas = UploadedFile::getInstance($model,'path_berkas');
                if($model->path_berkas){
                    $file = 'J'.date('YmdHis').Yii::$app->user->identity->NIY.'.'.$model->path_berkas->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/jurnal'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/jurnal');

                    if ($model->path_berkas->saveAs(Yii::getAlias('@frontend').'/web/uploads/jurnal/'.$file)){
                        $model->path_berkas = $file;           
                    }
                }

                if (empty($model->path_berkas)){
                     $model->path_berkas = $path_berkas;
                }

                $model->is_approved = 1; // by pass
                if($model->validate()){
                    $model->save();
                }

                $listAuthors = $model->jurnalAuthors;
                foreach($listAuthors as $d)
                {
                    $d->delete();
                }

                if(!empty($_POST['author_id']))
                {

                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new JurnalAuthor;
                        $author->jurnal_id = $model->id;
                        $author->NIY = $aid;
                        if(!$author->save())
                        {
                            $errors .= \app\helpers\MyHelper::logError($author);
                            
                            throw new \Exception;
                        }
                    }
                }
                
                else
                {
                    $errors .= 'Author tidak boleh kosong';
                    throw new \Exception;
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', "Data tersimpan");
                return $this->redirect(['jurnal/view', 'id' => $model->id]);
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDownload($id) 
    { 
        $download = Jurnal::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/jurnal/'.$download->path_berkas;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }else{
            echo 'file not exists...';    }
    }

    public function actionDisplay($id) 
    { 
        $download = Jurnal::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/jurnal/'.$download->path_berkas;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path,$download->path_berkas,['inline'=>true]);
        }else{
            echo 'file not exists...';
        }
    }

    /**
     * Deletes an existing Jurnal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach($model->jurnalAuthors as $author)
            $author->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jurnal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jurnal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jurnal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
