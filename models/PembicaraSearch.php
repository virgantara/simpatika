<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pembicara;

/**
 * PembicaraSearch represents the model behind the search form of `app\models\Pembicara`.
 */
class PembicaraSearch extends Pembicara
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_kategori_pembicara'], 'integer'],
            [['id_pembicara', 'nama_kategori_kegiatan', 'judul_makalah', 'nama_pertemuan_ilmiah', 'penyelenggara_kegiatan', 'tanggal_pelaksanaan', 'sister_id', 'no_sk_tugas', 'updated_at', 'created_at', 'NIY'], 'safe'],
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
        $query = Pembicara::find();
        $query->alias('p');
        $query->where(['p.NIY' => Yii::$app->user->identity->NIY]);
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
            'id_kategori_pembicara' => $this->id_kategori_pembicara,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'id_pembicara', $this->id_pembicara])
            ->andFilterWhere(['like', 'nama_kategori_kegiatan', $this->nama_kategori_kegiatan])
            ->andFilterWhere(['like', 'judul_makalah', $this->judul_makalah])
            ->andFilterWhere(['like', 'nama_pertemuan_ilmiah', $this->nama_pertemuan_ilmiah])
            ->andFilterWhere(['like', 'penyelenggara_kegiatan', $this->penyelenggara_kegiatan])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'no_sk_tugas', $this->no_sk_tugas])
            ->andFilterWhere(['like', 'NIY', $this->NIY]);

        return $dataProvider;
    }
}
