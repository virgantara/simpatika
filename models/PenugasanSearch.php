<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penugasan;

/**
 * PenugasanSearch represents the model behind the search form of `app\models\Penugasan`.
 */
class PenugasanSearch extends Penugasan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sister_id', 'NIY', 'status_pegawai', 'nama_ikatan_kerja', 'nama_jenjang_pendidikan', 'unit_kerja', 'perguruan_tinggi', 'terhitung_mulai_tanggal_surat_tugas'], 'safe'],
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
        $query = Penugasan::find();

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
            'terhitung_mulai_tanggal_surat_tugas' => $this->terhitung_mulai_tanggal_surat_tugas,
        ]);

        $query->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'status_pegawai', $this->status_pegawai])
            ->andFilterWhere(['like', 'nama_ikatan_kerja', $this->nama_ikatan_kerja])
            ->andFilterWhere(['like', 'nama_jenjang_pendidikan', $this->nama_jenjang_pendidikan])
            ->andFilterWhere(['like', 'unit_kerja', $this->unit_kerja])
            ->andFilterWhere(['like', 'perguruan_tinggi', $this->perguruan_tinggi]);

        return $dataProvider;
    }
}
