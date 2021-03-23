<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengabdianAnggota;

/**
 * PengabdianAnggotaSearch represents the model behind the search form of `common\models\PengabdianAnggota`.
 */
class PengabdianAnggotaSearch extends PengabdianAnggota
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pengabdian_id'], 'integer'],
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
        $query = PengabdianAnggota::find();

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
            'pengabdian_id' => $this->pengabdian_id,
            'created' => $this->created,
            'beban_kerja' => $this->beban_kerja,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'status_anggota', $this->status_anggota]);

        return $dataProvider;
    }
}
