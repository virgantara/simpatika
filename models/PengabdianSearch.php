<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengabdian;

/**
 * PengabdianSearch represents the model behind the search form of `app\models\Pengabdian`.
 */
class PengabdianSearch extends Pengabdian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'durasi_kegiatan'], 'integer'],
            [['NIY', 'judul_penelitian_pengabdian', 'nama_tahun_ajaran', 'nama_skim', 'jenis_penelitian_pengabdian', 'sister_id', 'updated_at', 'created_at'], 'safe'],
            [['nilai'], 'number'],
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
        $query = Pengabdian::find();
        $query->joinWith(['pengabdianAnggotas as pa']);
        
        $query->where(['pa.NIY' => Yii::$app->user->identity->NIY]);
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
            'durasi_kegiatan' => $this->durasi_kegiatan,
            'nilai' => $this->nilai,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'judul_penelitian_pengabdian', $this->judul_penelitian_pengabdian])
            ->andFilterWhere(['like', 'nama_tahun_ajaran', $this->nama_tahun_ajaran])
            ->andFilterWhere(['like', 'nama_skim', $this->nama_skim])
            ->andFilterWhere(['like', 'jenis_penelitian_pengabdian', $this->jenis_penelitian_pengabdian])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id]);

        return $dataProvider;
    }
}
