<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenelitianAnggota;

/**
 * PenelitianAnggotaSearch represents the model behind the search form of `common\models\PenelitianAnggota`.
 */
class PenelitianAnggotaSearch extends PenelitianAnggota
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'penelitian_id'], 'integer'],
            [['NIY', 'status_anggota', 'created'], 'safe'],
            [['beban_kerja'], 'number'],
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
    public function search($params)
    {
        $query = PenelitianAnggota::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'beban_kerja' => $this->beban_kerja,
            'penelitian_id' => $this->penelitian_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'status_anggota', $this->status_anggota]);

        return $dataProvider;
    }
}
