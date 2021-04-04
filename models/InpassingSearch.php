<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inpassing;

/**
 * InpassingSearch represents the model behind the search form of `app\models\Inpassing`.
 */
class InpassingSearch extends Inpassing
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sister_id', 'nama_golongan', 'nomor_sk_inpassing', 'tanggal_sk', 'sk_inpassing_terhitung_mulai_tanggal', 'NIY'], 'safe'],
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
        $query = Inpassing::find();

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
            'tanggal_sk' => $this->tanggal_sk,
            'sk_inpassing_terhitung_mulai_tanggal' => $this->sk_inpassing_terhitung_mulai_tanggal,
        ]);

        $query->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'nama_golongan', $this->nama_golongan])
            ->andFilterWhere(['like', 'nomor_sk_inpassing', $this->nomor_sk_inpassing])
            ->andFilterWhere(['like', 'NIY', $this->NIY]);

        return $dataProvider;
    }
}
