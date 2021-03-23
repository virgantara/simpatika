<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hki;
use Yii;
/**
 * HkiSearch represents the model behind the search form of `common\models\Hki`.
 */
class HkiSearch extends Hki
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_hki_id', 'tahun_pelaksanaan'], 'integer'],
            [['no_pendaftaran', 'judul', 'status_hki', 'sumber_dana', 'berkas', 'created_at', 'updated_at'], 'safe'],
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
        $query = Hki::find();

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
            'jenis_hki_id' => $this->jenis_hki_id,
            'tahun_pelaksanaan' => $this->tahun_pelaksanaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no_pendaftaran', $this->no_pendaftaran])
            ->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'status_hki', $this->status_hki])
            ->andFilterWhere(['like', 'sumber_dana', $this->sumber_dana])
            ->andFilterWhere(['like', 'berkas', $this->berkas]);

        return $dataProvider;
    }

    public function searchItemku($params)
    {
        $query = Hki::find();
        $query->joinWith(['hkiAuthors as author']);

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
        

        $query->andFilterWhere([
            'id' => $this->id,
            'jenis_hki_id' => $this->jenis_hki_id,
            'tahun_pelaksanaan' => $this->tahun_pelaksanaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no_pendaftaran', $this->no_pendaftaran])
            ->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'status_hki', $this->status_hki])
            ->andFilterWhere(['like', 'sumber_dana', $this->sumber_dana])
            ->andFilterWhere(['like', 'berkas', $this->berkas]);

        return $dataProvider;
    }
}
