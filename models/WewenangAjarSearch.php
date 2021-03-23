<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WewenangAjar;

/**
 * WewenangAjarSearch represents the model behind the search form of `common\models\WewenangAjar`.
 */
class WewenangAjarSearch extends WewenangAjar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jabatan_id', 'kualifikasi_id', 'prodi_id'], 'integer'],
            [['wewenang'], 'safe'],
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
        $query = WewenangAjar::find();
        // $query->joinWith(['jabatan','kualifikasi']);
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
            'jabatan_id' => $this->jabatan_id,
            'kualifikasi_id' => $this->kualifikasi_id,
            'prodi_id' => $this->prodi_id,
        ]);

        $query->andFilterWhere(['like', 'wewenang', $this->wewenang]);

        return $dataProvider;
    }
}
