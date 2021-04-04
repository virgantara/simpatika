<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kepangkatan;

/**
 * KepangkatanSearch represents the model behind the search form of `app\models\Kepangkatan`.
 */
class KepangkatanSearch extends Kepangkatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'masa_kerja_golongan_tahun', 'masa_kerja_golongan_bulan', 'id_pangkat_golongan'], 'integer'],
            [['NIY', 'sister_id', 'kode_golongan', 'nama_golongan', 'no_sk_pangkat', 'terhitung_mulai_tanggal_sk_pangkat', 'tanggal_sk_pengangkatan'], 'safe'],
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
        $query = Kepangkatan::find();

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
            'terhitung_mulai_tanggal_sk_pangkat' => $this->terhitung_mulai_tanggal_sk_pangkat,
            'tanggal_sk_pengangkatan' => $this->tanggal_sk_pengangkatan,
            'masa_kerja_golongan_tahun' => $this->masa_kerja_golongan_tahun,
            'masa_kerja_golongan_bulan' => $this->masa_kerja_golongan_bulan,
            'id_pangkat_golongan' => $this->id_pangkat_golongan,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'kode_golongan', $this->kode_golongan])
            ->andFilterWhere(['like', 'nama_golongan', $this->nama_golongan])
            ->andFilterWhere(['like', 'no_sk_pangkat', $this->no_sk_pangkat]);

        return $dataProvider;
    }
}
