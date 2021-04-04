<?php

namespace app\controllers;

use Yii;
use app\models\TugasDosenBkd;

use app\models\TugasDosenBkdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TugasDosenBkdController implements the CRUD actions for TugasDosenBkd model.
 */
class TugasDosenBkdController extends Controller
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
     * Lists all TugasDosenBkd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TugasDosenBkdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $unsurUtama = \app\models\UnsurUtama::find()->orderBy(['urutan'=>SORT_ASC])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'unsurUtama' => $unsurUtama,
        ]);
    }

    

    /**
     * Finds the TugasDosenBkd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TugasDosenBkd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TugasDosenBkd::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
