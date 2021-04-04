<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TugasDosenBkd;

/**
 * TugasDosenBkdSearch represents the model behind the search form of `app\models\TugasDosenBkd`.
 */
class TugasDosenBkdSearch extends TugasDosenBkd
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unsur_id'], 'integer'],
            [['tugas_dosen_id'], 'safe'],
            [['nilai_minimal'], 'number'],
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
        $query = TugasDosenBkd::find();

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
            'unsur_id' => $this->unsur_id,
            'nilai_minimal' => $this->nilai_minimal,
        ]);

        $query->andFilterWhere(['like', 'tugas_dosen_id', $this->tugas_dosen_id]);

        return $dataProvider;
    }
}
