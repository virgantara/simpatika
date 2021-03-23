<?php

namespace app\controllers;

use Yii;
use app\models\Makalah;
use app\models\MakalahAuthor;
use app\models\Verify;
use app\models\MakalahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * MakalahController implements the CRUD actions for Makalah model.
 */
class MakalahController extends Controller
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
     * Lists all Makalah models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }else{  
        $searchModel = new MakalahSearch();
        $dataProvider = $searchModel->searchItemku(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Makalah model.
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
     * Creates a new Makalah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Makalah();
        $model->NIY = Yii::$app->user->identity->NIY;
       
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {
            if ($model->load(Yii::$app->request->post())) {
                $tambah = new Verify();
                $tambah->NIY = Yii::$app->user->identity->NIY;
                $tambah->kategori = 6;
                $tambah->ver = 'Belum Diverifikasi';
                $tambah->ID_data = $model->ID;
                $tambah->save();

                $model->f_makalah = UploadedFile::getInstance($model,'f_makalah');
                if($model->f_makalah){
                    $file = 'J'.date('YmdHis').Yii::$app->user->identity->NIY.'.'.$model->f_makalah->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/makalah'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/makalah');

                    if ($model->f_makalah->saveAs(Yii::getAlias('@frontend').'/web/uploads/makalah/'.$file)){
                        $model->f_makalah = $file;           
                    }
                }

                if($model->save())
                {
                    if(!empty($_POST['author_id']))
                    {
                        foreach($_POST['author_id'] as $aid)
                        {
                            if(empty($aid)) continue;

                            $author = new MakalahAuthor;
                            $author->makalah_id = $model->ID;
                            $author->NIY = $aid;
                            if(!$author->save())
                            {
                                $errors .= \app\helpers\MyHelper::logError($author);
                                
                                throw new \Exception;
                            }
                        }

                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Data tersimpan");
                        return $this->redirect(['makalah/view', 'id' => $model->ID]);
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
     * Updates an existing Makalah model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $f_makalah = $model->f_makalah;
        $very = Verify::findOne(['kategori'=>'6','ID_data'=>$id]);
        if(!empty($very)){
          $very->ver = 'Belum Diverifikasi';
          $very->save();
        }else{
          $tambah = new Verify();
          $tambah->NIY = Yii::$app->user->identity->NIY;
          $tambah->kategori = 6;
          $tambah->ver = 'Belum Diverifikasi';
          $tambah->ID_data = $model->ID;
          $tambah->save();
        }
        // $model->NIY = Yii::$app->user->identity->NIY;
       
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
       

        try 
        {

          // print_r(Yii::$app->request->post());exit;

            if ($model->load(Yii::$app->request->post())) {
               
                $model->f_makalah = UploadedFile::getInstance($model,'f_makalah');
                if($model->f_makalah){
                    $file = 'J'.date('YmdHis').Yii::$app->user->identity->NIY.'.'.$model->f_makalah->extension;

                    if(!file_exists(Yii::getAlias('@frontend').'/web/uploads/makalah'))
                      mkdir(Yii::getAlias('@frontend').'/web/uploads/makalah');
                
                    if ($model->f_makalah->saveAs(Yii::getAlias('@frontend').'/web/uploads/makalah/'.$file)){
                        $model->f_makalah = $file;           
                    }
                }

                if (empty($model->f_makalah)){
                     $model->f_makalah = $f_makalah;
                }

                if($model->validate())
                    $model->save();

                $listAuthors = $model->makalahAuthors;
                foreach($listAuthors as $d)
                {
                    $d->delete();
                }

                if(!empty($_POST['author_id']))
                {
                    foreach($_POST['author_id'] as $aid)
                    {
                        if(empty($aid)) continue;

                        $author = new MakalahAuthor;
                        $author->makalah_id = $model->ID;
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
                return $this->redirect(['makalah/view', 'id' => $model->ID]);
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
     * Deletes an existing Makalah model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->findVer($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Makalah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Makalah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Makalah::findOne($id)) !== null) {
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
    $download = Makalah::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/makalah/'.$download->f_makalah;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path);
    }else{
        echo 'file not exists...';
    }
    }
    
        public function actionDisplay($id) 
    { 
    $download = Makalah::findOne($id); 
    $path=Yii::getAlias('@webroot').'/uploads/makalah/'.$download->f_makalah;
    if (file_exists($path)) {
        return Yii::$app->response->sendFile($path,$download->f_makalah,['inline'=>true]);
    }else{
        echo 'file not exists...';
    }
    }
}
