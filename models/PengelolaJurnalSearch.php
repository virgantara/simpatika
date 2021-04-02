<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengelolaJurnal;

/**
 * PengelolaJurnalSearch represents the model behind the search form of `app\models\PengelolaJurnal`.
 */
class PengelolaJurnalSearch extends PengelolaJurnal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'komponen_kegiatan_id'], 'integer'],
            [['peran_dalam_kegiatan', 'no_sk_tugas', 'apakah_masih_aktif', 'tgl_sk_tugas', 'tgl_sk_tugas_selesai', 'nama_media_publikasi', 'kategori_kegiatan_id', 'NIY', 'sister_id', 'is_claimed', 'updated_at', 'created_at'], 'safe'],
            [['sks_bkd'], 'number'],
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
        $query = PengelolaJurnal::find();

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
            'tgl_sk_tugas' => $this->tgl_sk_tugas,
            'tgl_sk_tugas_selesai' => $this->tgl_sk_tugas_selesai,
            'komponen_kegiatan_id' => $this->komponen_kegiatan_id,
            'sks_bkd' => $this->sks_bkd,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'peran_dalam_kegiatan', $this->peran_dalam_kegiatan])
            ->andFilterWhere(['like', 'no_sk_tugas', $this->no_sk_tugas])
            ->andFilterWhere(['like', 'apakah_masih_aktif', $this->apakah_masih_aktif])
            ->andFilterWhere(['like', 'nama_media_publikasi', $this->nama_media_publikasi])
            ->andFilterWhere(['like', 'kategori_kegiatan_id', $this->kategori_kegiatan_id])
            ->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'is_claimed', $this->is_claimed]);

        return $dataProvider;
    }
}
