<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SisterFiles;

/**
 * PembicaraFilesSearch represents the model behind the search form of `app\models\PembicaraFiles`.
 */
class SisterFilesSearch extends SisterFiles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dokumen', 'nama_dokumen', 'nama_file', 'jenis_file', 'tanggal_upload', 'nama_jenis_dokumen', 'tautan', 'keterangan_dokumen', 'updated_at', 'created_at'], 'safe'],
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
        $query = SisterFiles::find();

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
            'tanggal_upload' => $this->tanggal_upload,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'id_dokumen', $this->id_dokumen])
            ->andFilterWhere(['like', 'nama_dokumen', $this->nama_dokumen])
            ->andFilterWhere(['like', 'nama_file', $this->nama_file])
            ->andFilterWhere(['like', 'jenis_file', $this->jenis_file])
            ->andFilterWhere(['like', 'nama_jenis_dokumen', $this->nama_jenis_dokumen])
            ->andFilterWhere(['like', 'tautan', $this->tautan])
            ->andFilterWhere(['like', 'keterangan_dokumen', $this->keterangan_dokumen]);

        return $dataProvider;
    }
}
