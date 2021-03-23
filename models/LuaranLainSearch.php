<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LuaranLain;
use Yii;
/**
 * LuaranLainSearch represents the model behind the search form of `common\models\LuaranLain`.
 */
class LuaranLainSearch extends LuaranLain
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_luaran_id', 'tahun_pelaksanaan'], 'integer'],
            [['judul', 'deskripsi', 'berkas', 'created_at', 'updated_at', 'ver'], 'safe'],
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
        $query = LuaranLain::find();

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
            'jenis_luaran_id' => $this->jenis_luaran_id,
            'tahun_pelaksanaan' => $this->tahun_pelaksanaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'ver', $this->ver]);

        return $dataProvider;
    }

    public function searchItemku($params)
    {
        $query = LuaranLain::find();
        $query->joinWith(['luaranLainAuthors as author']);

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
            'jenis_luaran_id' => $this->jenis_luaran_id,
            'tahun_pelaksanaan' => $this->tahun_pelaksanaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
           
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'sumber_dana', $this->sumber_dana]);

        return $dataProvider;
    }
}
