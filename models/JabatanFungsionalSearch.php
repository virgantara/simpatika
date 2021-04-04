<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JabatanFungsional;

/**
 * JabatanFungsionalSearch represents the model behind the search form of `app\models\JabatanFungsional`.
 */
class JabatanFungsionalSearch extends JabatanFungsional
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_jabfung'], 'integer'],
            [['sister_id', 'NIY', 'sk_jabatan_fungsional', 'jabatan_fungsional', 'terhitung_mulai_tanggal_jabatan_fungsional', 'kelebihan_pengajaran', 'kelebihan_penelitian', 'kelebihan_pengabdian_masyarakat', 'kelebihan_kegiatan_penunjang'], 'safe'],
            [['angka_kredit'], 'number'],
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
        $query = JabatanFungsional::find();

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
            'terhitung_mulai_tanggal_jabatan_fungsional' => $this->terhitung_mulai_tanggal_jabatan_fungsional,
            'angka_kredit' => $this->angka_kredit,
            'id_jabfung' => $this->id_jabfung,
        ]);

        $query->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'sk_jabatan_fungsional', $this->sk_jabatan_fungsional])
            ->andFilterWhere(['like', 'jabatan_fungsional', $this->jabatan_fungsional])
            ->andFilterWhere(['like', 'kelebihan_pengajaran', $this->kelebihan_pengajaran])
            ->andFilterWhere(['like', 'kelebihan_penelitian', $this->kelebihan_penelitian])
            ->andFilterWhere(['like', 'kelebihan_pengabdian_masyarakat', $this->kelebihan_pengabdian_masyarakat])
            ->andFilterWhere(['like', 'kelebihan_kegiatan_penunjang', $this->kelebihan_kegiatan_penunjang]);

        return $dataProvider;
    }
}
