<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penelitian;

/**
 * PenelitianSearch represents the model behind the search form of `app\models\Penelitian`.
 */
class PenelitianSearch extends Penelitian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'tahun_kegiatan', 'durasi_kegiatan', 'tahun_usulan', 'tahun_dilaksanakan', 'tahun_pelaksanaan_ke', 'komponen_kegiatan_id'], 'integer'],
            [['NIY', 'judul_penelitian_pengabdian', 'status', 'dana_dikti', 'sister_id', 'nama_skim', 'tempat_kegiatan', 'no_sk_tugas', 'tgl_sk_tugas', 'kategori_kegiatan_id', 'skim_kegiatan_id', 'kelompok_bidang_id', 'updated_at', 'created_at'], 'safe'],
            [['dana_institusi_lain', 'nilai', 'dana_pt'], 'number'],
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
        $query = Penelitian::find();
        $query->joinWith(['penelitianAnggotas as pa']);
        
        $query->where(['pa.NIY' => Yii::$app->user->identity->NIY]);
        // $query->alias('p');
        // $query->where(['p.NIY' => Yii::$app->user->identity->NIY]);
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
            'ID' => $this->ID,
            'tahun_kegiatan' => $this->tahun_kegiatan,
            'dana_institusi_lain' => $this->dana_institusi_lain,
            'nilai' => $this->nilai,
            'durasi_kegiatan' => $this->durasi_kegiatan,
            'dana_pt' => $this->dana_pt,
            'tahun_usulan' => $this->tahun_usulan,
            'tahun_dilaksanakan' => $this->tahun_dilaksanakan,
            'tahun_pelaksanaan_ke' => $this->tahun_pelaksanaan_ke,
            'tgl_sk_tugas' => $this->tgl_sk_tugas,
            'komponen_kegiatan_id' => $this->komponen_kegiatan_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'judul_penelitian_pengabdian', $this->judul_penelitian_pengabdian])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'dana_dikti', $this->dana_dikti])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'nama_skim', $this->nama_skim])
            ->andFilterWhere(['like', 'tempat_kegiatan', $this->tempat_kegiatan])
            ->andFilterWhere(['like', 'no_sk_tugas', $this->no_sk_tugas])
            ->andFilterWhere(['like', 'kategori_kegiatan_id', $this->kategori_kegiatan_id])
            ->andFilterWhere(['like', 'skim_kegiatan_id', $this->skim_kegiatan_id])
            ->andFilterWhere(['like', 'kelompok_bidang_id', $this->kelompok_bidang_id]);

        return $dataProvider;
    }
}
