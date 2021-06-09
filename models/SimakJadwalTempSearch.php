<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SimakJadwalTemp;

/**
 * SimakJadwalTempSearch represents the model behind the search form of `app\models\SimakJadwalTemp`.
 */
class SimakJadwalTempSearch extends SimakJadwalTemp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jam_ke', 'kuota_kelas', 'bentrok'], 'integer'],
            [['hari', 'jam', 'jam_mulai', 'jam_selesai', 'kode_mk', 'nama_mk', 'kode_dosen', 'nama_dosen', 'kode_pengampu_nidn', 'nama_dosen_bernidn', 'semester', 'kelas', 'fakultas', 'nama_fakultas', 'prodi', 'nama_prodi', 'kd_ruangan', 'tahun_akademik', 'kampus', 'presensi', 'materi', 'bobot_formatif', 'bobot_uts', 'bobot_uas', 'bobot_harian1', 'bobot_harian', 'bentrok_with', 'created', 'modified'], 'safe'],
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
        $query = SimakJadwalTemp::find();

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
            'jam_ke' => $this->jam_ke,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'kuota_kelas' => $this->kuota_kelas,
            'bentrok' => $this->bentrok,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'hari', $this->hari])
            ->andFilterWhere(['like', 'jam', $this->jam])
            ->andFilterWhere(['like', 'kode_mk', $this->kode_mk])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'kode_dosen', $this->kode_dosen])
            ->andFilterWhere(['like', 'nama_dosen', $this->nama_dosen])
            ->andFilterWhere(['like', 'kode_pengampu_nidn', $this->kode_pengampu_nidn])
            ->andFilterWhere(['like', 'nama_dosen_bernidn', $this->nama_dosen_bernidn])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'kelas', $this->kelas])
            ->andFilterWhere(['like', 'fakultas', $this->fakultas])
            ->andFilterWhere(['like', 'nama_fakultas', $this->nama_fakultas])
            ->andFilterWhere(['like', 'prodi', $this->prodi])
            ->andFilterWhere(['like', 'nama_prodi', $this->nama_prodi])
            ->andFilterWhere(['like', 'kd_ruangan', $this->kd_ruangan])
            ->andFilterWhere(['like', 'tahun_akademik', $this->tahun_akademik])
            ->andFilterWhere(['like', 'kampus', $this->kampus])
            ->andFilterWhere(['like', 'presensi', $this->presensi])
            ->andFilterWhere(['like', 'materi', $this->materi])
            ->andFilterWhere(['like', 'bobot_formatif', $this->bobot_formatif])
            ->andFilterWhere(['like', 'bobot_uts', $this->bobot_uts])
            ->andFilterWhere(['like', 'bobot_uas', $this->bobot_uas])
            ->andFilterWhere(['like', 'bobot_harian1', $this->bobot_harian1])
            ->andFilterWhere(['like', 'bobot_harian', $this->bobot_harian])
            ->andFilterWhere(['like', 'bentrok_with', $this->bentrok_with]);

        return $dataProvider;
    }
}
