<?php

namespace app\controllers;

use Yii;
use app\models\Hki;
use app\models\HkiAuthor;
use app\models\HkiSearch;
use app\models\Verify;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
/**
 * HkiController implements the CRUD actions for Hki model.
 */
class HkiController extends Controller
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
     * Lists all Hki models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HkiSearch();
        $dataProvider = $searchModel->searchItemku(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hki model.
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
     * Creates a new Hki model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hki();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 16;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->id;
                $tambah->save();

                $model->berkas = UploadedFile::getInstance($model,'berkas');
                if($model->berkas){
                    $file = $model->berkas->name;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/hki');

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym')))
                        mkdir(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym'));

                    if ($model->berkas->saveAs(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym').'/'.$file)){
                        $model->berkas = date('Ym').'/'.$file;           
                    }
                }

                $model->ver = 'Sudah Diverifikasi';
                $model->save();

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new HkiAuthor;
                        $author->hki_id = $model->id;
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
                return $this->redirect(['hki/view', 'id' => $model->id]);
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
     * Updates an existing Hki model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        
        $berkas = $model->berkas;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $very = Verify::findOne(['kategori'=>'16','ID_data'=>$id]);
                if(!empty($very)){
                    $very->ver = 'Belum Diverifikasi';
                    $very->save();
                }else{
                    $tambah = new Verify();
                    $tambah->NIY = Yii::$app->user->identity->NIY;
                    $tambah->kategori = 16;
                    $tambah->ver = 'Belum Diverifikasi';
                    $tambah->ID_data = $model->id;
                    $tambah->save();
                }
                

                $model->berkas = UploadedFile::getInstance($model,'berkas');
                if($model->berkas){
                    $file = $model->berkas->name;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/hki');

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym')))
                        mkdir(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym'));

                    if ($model->berkas->saveAs(Yii::getAlias('@frontend').'/web/uploads/hki/'.date('Ym').'/'.$file)){
                        $model->berkas = date('Ym').'/'.$file;           
                    }
                }

                if (empty($model->berkas)){
                     $model->berkas = $berkas;
                }

                $model->ver = 'Sudah Diverifikasi';
                if($model->validate())
                    $model->save();

                $listAuthors = $model->hkiAuthors;
                foreach($listAuthors as $d)
                {
                    $d->delete();
                }

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new HkiAuthor;
                        $author->hki_id = $model->id;
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
                return $this->redirect(['hki/view', 'id' => $model->id]);
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
        $download = Hki::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/hki/'.$download->berkas;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }else{
            echo 'file not exists...';    }
    }

    public function actionDisplay($id) 
    { 
        $download = Hki::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/hki/'.$download->berkas;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path,$download->berkas,['inline'=>true]);
        }else{
            echo 'file not exists...';
        }
    }

    /**
     * Deletes an existing Hki model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach($model->hkiAuthors as $author)
            $author->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hki model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hki the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hki::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
