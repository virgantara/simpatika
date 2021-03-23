<?php

namespace app\controllers;

use Yii;
use app\helpers\MyHelper;
use app\models\Konferensi;
use app\models\KonferensiAuthor;
use app\models\Verify;
use app\models\KonferensiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * KonferensiController implements the CRUD actions for Konferensi model.
 */
class KonferensiController extends Controller
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
     * Lists all Konferensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new KonferensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Konferensi model.
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
     * Creates a new Konferensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Konferensi();
        $model->NIY = Yii::$app->user->identity->NIY;
       
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 5;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();

                $model->f_konferensi = UploadedFile::getInstance($model,'f_konferensi');
                if($model->f_konferensi){
                    $file = $model->f_konferensi->name;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/konferensi'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/konferensi');

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/konferensi/'.$model->ID))
                        mkdir(Yii::getAlias('@frontend').'/web/uploads/konferensi/'.$model->ID);

                    if ($model->f_konferensi->saveAs(Yii::getAlias('@frontend').'/web/uploads/konferensi/'.$model->ID.'/'.$file)){
                        $model->f_konferensi = $file;           
                    }
                }

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new KonferensiAuthor;
                        $author->konferensi_id = $model->ID;
                        $author->NIY = $aid;
                        if(!$author->save())
                        {
                            $errors .= MyHelper::logError($author);
                            
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
                return $this->redirect(['konferensi/view', 'id' => $model->ID]);
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
     * Updates an existing Konferensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $f_konferensi = $model->f_konferensi;
        $very = Verify::findOne(['kategori'=>'5','ID_data'=>$id]);
        if(!empty($very)){
          $very->ver = 'Belum Diverifikasi';
          $very->save();
        }else{
          $tambah = new Verify();
          $tambah->NIY = Yii::$app->user->identity->NIY;
          $tambah->kategori = 5;
          $tambah->ver = 'Belum Diverifikasi';
          $tambah->ID_data = $model->ID;
          $tambah->save();
        }
        // $model->NIY = Yii::$app->user->identity->NIY;
       
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       
        $errors = '';
        try 
        {

          // print_r(Yii::$app->request->post());exit;

            if ($model->load(Yii::$app->request->post())) {
               
                $model->f_konferensi = UploadedFile::getInstance($model,'f_konferensi');
                if($model->f_konferensi){
                    $file = $model->f_konferensi->name;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/konferensi'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/konferensi');

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/konferensi/'.$model->ID))
                        mkdir(Yii::getAlias('@frontend').'/web/uploads/konferensi/'.$model->ID);

                    if ($model->f_konferensi->saveAs(Yii::getAlias('@frontend').'/web/uploads/konferensi/'.$model->ID.'/'.$file)){
                        $model->f_konferensi = $file;           
                    }
                }

                if (empty($model->f_konferensi)){
                     $model->f_konferensi = $f_konferensi;
                }

                if($model->validate())
                    $model->save();
                

                $listAuthors = $model->konferensiAuthors;
                foreach($listAuthors as $d)
                {
                    $d->delete();
                }

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new KonferensiAuthor;
                        $author->konferensi_id = $model->ID;
                        $author->NIY = $aid;
                        if(!$author->save())
                        {
                            $errors .= MyHelper::logError($author);
                            
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
                return $this->redirect(['konferensi/view', 'id' => $model->ID]);
            }

        } catch (\Exception $e) {
            $errors .= $e->getMessage();
            $model->addError('ID',$errors);
            $transaction->rollBack();
        } catch (\Throwable $e) {
            $errors .= $e->getMessage();
            $model->addError('ID',$errors);
            $transaction->rollBack();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Konferensi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach($model->konferensiAuthors as $author)
            $author->delete();

        $model->delete();

        $this->findVer($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Konferensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Konferensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Konferensi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findVer($id)
    {
        if (($very = Verify::findOne(['kategori'=>'6','ID_data'=>$id])) !== null) {
            return $very;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionDownload($id) 
    { 
    $download = Konferensi::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/konferensi/'.$id.'/'.$download->f_konferensi;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
    }
    
        public function actionDisplay($id) 
    { 
    $download = Konferensi::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/konferensi/'.$id.'/'.$download->f_konferensi;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_konferensi,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
    }
}
