<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publikasi;

/**
 * PublikasiSearch represents the model behind the search form of `app\models\Publikasi`.
 */
class PublikasiSearch extends Publikasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kegiatan_id'], 'integer'],
            [['judul_publikasi_paten', 'nama_jenis_publikasi', 'tanggal_terbit', 'sister_id', 'updated_at', 'created_at'], 'safe'],
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
        $query = Publikasi::find();

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
            'kegiatan_id' => $this->kegiatan_id,
            'tanggal_terbit' => $this->tanggal_terbit,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'judul_publikasi_paten', $this->judul_publikasi_paten])
            ->andFilterWhere(['like', 'nama_jenis_publikasi', $this->nama_jenis_publikasi])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id]);

        return $dataProvider;
    }
}
