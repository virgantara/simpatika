<?php

namespace app\controllers;

use Yii;
use app\models\Buku;
use app\models\BukuAuthor;
use app\models\Verify;
use app\models\BukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BukuController implements the CRUD actions for Buku model.
 */
class BukuController extends Controller
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
     * Lists all Buku models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new BukuSearch();
        $dataProvider = $searchModel->searchItemku(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Buku model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Buku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Buku();
        $model->NIY = Yii::$app->user->identity->NIY;
        

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 2;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();
                $model->f_karya = UploadedFile::getInstance($model,'f_karya');
                if($model->f_karya){
                    $file = $model->f_karya->name.date('YmdHis').'_'.Yii::$app->user->identity->NIY.'.'.$model->f_karya->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/buku'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/buku');

                    if ($model->f_karya->saveAs(Yii::getAlias('@frontend').'/web/uploads/buku/'.$file)){
                        $model->f_karya = $file;           
                    }
                }
                $model->ver = 'Sudah Diverifikasi';
                if($model->save())
                {

                    if(!empty($_POST['author_id']))
                    {
                        foreach($_POST['author_id'] as $aid)
                        {
                            if(empty($aid)) continue;

                            $author = new BukuAuthor;
                            $author->buku_id = $model->ID;
                            $author->NIY = $aid;
                            if(!$author->save())
                            {
                                foreach($author->getErrors() as $attribute){
                                    foreach($attribute as $error){
                                        $errors .= $error.' ';
                                    }
                                }
                                
                                throw new \Exception;
                            }
                        }

                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Data tersimpan");
                        return $this->redirect(['buku/view', 'id' => $model->ID]);
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
     * Updates an existing Buku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $very = Verify::findOne(['kategori'=>'2','ID_data'=>$id]);
            if(!empty($very)){
            $very->ver = 'Belum Diverifikasi';
            $very->save();
            }else{
              $tambah = new Verify();
              $tambah->NIY = Yii::$app->user->identity->NIY;
              $tambah->kategori = 2;
              $tambah->ver = 'Belum Diverifikasi';
              $tambah->ID_data = $model->ID;
              $tambah->save();
        }
        
        $f_karya = $model->f_karya;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try 
        {
            $model->ver = 'Sudah Diverifikasi';
            if ($model->load(Yii::$app->request->post())) {

                $model->f_karya = UploadedFile::getInstance($model,'f_karya');
                if($model->f_karya){
                    $file = $model->f_karya->name.date('YmdHis').'_'.Yii::$app->user->identity->NIY.'.'.$model->f_karya->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/buku'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/buku');

                    if ($model->f_karya->saveAs(Yii::getAlias('@frontend').'/web/uploads/buku/'.$file)){
                        $model->f_karya = $file;           
                    }
                }

                if (empty($model->f_karya)){
                     $model->f_karya = $f_karya;
                }

                if($model->validate())
                    $model->save();

                $listAuthors = $model->bukuAuthors;
                foreach($listAuthors as $d)
                {
                    $d->delete();
                }

                if(!empty($_POST['author_id']))
                {
                   
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new BukuAuthor;
                        $author->buku_id = $model->ID;
                        $author->NIY = $aid;
                        if(!$author->save())
                        {
                            $errors .= \app\helpers\MyHelper::logError($author);
                            
                            throw new \Exception;
                        }
                    }

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Data tersimpan");
                    return $this->redirect(['buku/view', 'id' => $model->ID]);
                }
                
                else
                {
                    $errors .= 'Author tidak boleh kosong';
                    throw new \Exception;
                }

                
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

    /**
     * Deletes an existing Buku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach($model->bukuAuthors as $author)
            $author->delete();
        
        $this->findVer($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Buku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buku::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'2','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDownload($id) 
    { 
        $download = Buku::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/buku/'.$download->f_karya;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }else{
            echo 'file not exists...';    }
    }

    public function actionDisplay($id) 
    { 
        $download = Buku::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/buku/'.$download->f_karya;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path,$download->f_karya,['inline'=>true]);
        }else{
            echo 'file not exists...';
        }
    }
}
