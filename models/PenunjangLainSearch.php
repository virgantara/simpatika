<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenunjangLain;

/**
 * PenunjangLainSearch represents the model behind the search form of `app\models\PenunjangLain`.
 */
class PenunjangLainSearch extends PenunjangLain
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_panitia_id'], 'integer'],
            [['kategori_kegiatan_id', 'komponen_kegiatan_id', 'tingkat_id', 'nama_kegiatan', 'instansi', 'no_sk_tugas', 'tanggal_mulai', 'tanggal_selesai'], 'safe'],
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
        $query = PenunjangLain::find();
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
            'jenis_panitia_id' => $this->jenis_panitia_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
        ]);

        $query->andFilterWhere(['like', 'kategori_kegiatan_id', $this->kategori_kegiatan_id])
            ->andFilterWhere(['like', 'komponen_kegiatan_id', $this->komponen_kegiatan_id])
            ->andFilterWhere(['like', 'tingkat_id', $this->tingkat_id])
            ->andFilterWhere(['like', 'nama_kegiatan', $this->nama_kegiatan])
            ->andFilterWhere(['like', 'instansi', $this->instansi])
            ->andFilterWhere(['like', 'no_sk_tugas', $this->no_sk_tugas]);

        return $dataProvider;
    }
}
