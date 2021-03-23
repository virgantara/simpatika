<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LppmPenelitian;

/**
 * LppmPenelitianSearch represents the model behind the search form of `common\models\LppmPenelitian`.
 */
class LppmPenelitianSearch extends LppmPenelitian
{
    public $namaSkema;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lppm_skema_penelitian_id'], 'integer'],
            [['judul', 'NIY', 'created', 'file_proposal', 'berita_acara','namaSkema','ver'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($jenis,$params)
    {
        $query = LppmPenelitian::find();
        $query->where([self::tableName().'.jenis_penelitian'=>$jenis]);
        
        $query->joinWith(['lppmSkemaPenelitian as skema']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $dataProvider->sort->attributes['namaSkema'] = [
            'asc' => ['skema.nama'=>SORT_ASC],
            'desc' => ['skema.nama'=>SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if(Yii::$app->user->identity->status_admin == 'user'){
            $query->andWhere(['NIY'=>Yii::$app->user->identity->NIY]);
        }

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'skema.nama', $this->namaSkema])
            ->andFilterWhere(['like', 'file_proposal', $this->file_proposal])
            ->andFilterWhere(['like', 'berita_acara', $this->berita_acara]);

        return $dataProvider;
    }
}
