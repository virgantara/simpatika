<?php

namespace app\controllers;

use Yii;

use app\models\User;
use app\models\CatatanHarian;
use app\models\CatatanHarianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UnsurKegiatan;

/**
 * CatatanHarianController implements the CRUD actions for CatatanHarian model.
 */
class CatatanHarianController extends Controller
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

    public function actionAjaxListCatatan()
    {
        if(Yii::$app->request->isPost)
        {
            $dataPost = $_POST['dataPost'];

            $query = CatatanHarian::find();
            $query->where([
                'user_id' => $dataPost['user_id']
            ]);

            $periode = explode(' - ', $dataPost['periode']);
            // print_r($dataPost['periode']);exit;
            $tgl_awal = $periode[0];
            $tgl_akhir = $periode[1];

            $query->andFilterWhere(['between','tanggal',$tgl_awal,$tgl_akhir]);

            $results = [];
            $list = $query->all();
            foreach($list as $item)
            {
                $results[] = [
                    'id' => $item->id,
                    'deskripsi' => $item->deskripsi,
                    'tanggal' => $item->tanggal,
                    'is_selesai' => $item->is_selesai,
                    'poin' => $item->poin,
                    'unsur_id' => $item->unsur_id,
                    'unsur_nama' => $item->unsur->nama

                ];
            }

            echo json_encode($results);

            die();

        }
    }

    public function actionList()
    {
        // $query = CatatanHarian::find();
        $user = User::findOne(Yii::$app->user->identity->id);
        $results = [];
        return $this->render('list', [
            'results' => $results,
            'user' => $user
        ]);
    }

    /**
     * Lists all CatatanHarian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->access_role == 'Dekan' 
            || Yii::$app->user->identity->access_role == 'Kaprodi')
        {
            return $this->redirect(['list']);
        }

        else{
            $searchModel = new CatatanHarianSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single CatatanHarian model.
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
     * Creates a new CatatanHarian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatatanHarian();
        $model->user_id = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            $unsur = UnsurKegiatan::findOne($model->unsur_id);
            $model->poin = $unsur->poin;

            $model->save();
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CatatanHarian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $unsur = UnsurKegiatan::findOne($model->unsur_id);
            $model->poin = $unsur->poin;
            
            $model->save();
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CatatanHarian model.
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

    /**
     * Finds the CatatanHarian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatatanHarian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatatanHarian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
