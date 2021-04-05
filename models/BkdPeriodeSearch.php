<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BkdPeriode;

/**
 * BkdPeriodeSearch represents the model behind the search form of `app\models\BkdPeriode`.
 */
class BkdPeriodeSearch extends BkdPeriode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun_id'], 'integer'],
            [['nama_periode', 'tanggal_bkd_awal', 'tanggal_bkd_akhir', 'buka', 'updated_at', 'created_at'], 'safe'],
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
        $query = BkdPeriode::find();

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
            'tahun_id' => $this->tahun_id,
            'tanggal_bkd_awal' => $this->tanggal_bkd_awal,
            'tanggal_bkd_akhir' => $this->tanggal_bkd_akhir,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'nama_periode', $this->nama_periode])
            ->andFilterWhere(['like', 'buka', $this->buka]);

        return $dataProvider;
    }
}
