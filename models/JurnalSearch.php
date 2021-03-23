<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jurnal;
use Yii;

/**
 * JurnalSearch represents the model behind the search form of `common\models\Jurnal`.
 */
class JurnalSearch extends Jurnal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_publikasi_id', 'tahun_terbit', 'is_approved'], 'integer'],
            [['judul', 'nama_jurnal', 'pissn', 'eissn', 'volume', 'nomor', 'halaman', 'berkas', 'sumber_dana', 'created_at', 'updated_at'], 'safe'],
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
        $query = Jurnal::find();

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
            'jenis_publikasi_id' => $this->jenis_publikasi_id,
            'tahun_terbit' => $this->tahun_terbit,
            'is_approved' => $this->is_approved,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'nama_jurnal', $this->nama_jurnal])
            ->andFilterWhere(['like', 'pissn', $this->pissn])
            ->andFilterWhere(['like', 'eissn', $this->eissn])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'nomor', $this->nomor])
            ->andFilterWhere(['like', 'halaman', $this->halaman])
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'sumber_dana', $this->sumber_dana]);

        return $dataProvider;
    }

    public function searchItemku($params)
    {
        $query = Jurnal::find();
        $query->joinWith(['jurnalAuthors as author']);

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

        $query->andWhere(['author.NIY'=>Yii::$app->user->identity->NIY]);
        

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jenis_publikasi_id' => $this->jenis_publikasi_id,
            'tahun_terbit' => $this->tahun_terbit,
            'is_approved' => $this->is_approved,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'nama_jurnal', $this->nama_jurnal])
            ->andFilterWhere(['like', 'pissn', $this->pissn])
            ->andFilterWhere(['like', 'eissn', $this->eissn])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'nomor', $this->nomor])
            ->andFilterWhere(['like', 'halaman', $this->halaman])
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'sumber_dana', $this->sumber_dana]);

        return $dataProvider;
    }
}
