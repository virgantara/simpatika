<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prodi;

/**
 * ProdiSearch represents the model behind the search form of `common\models\Prodi`.
 */
class ProdiSearch extends Prodi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'id_fak','kode_prod'], 'integer'],
            [['nama','aliasi'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Prodi::find();

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

        $query->joinWith('fakultasProdi');
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'kode_prod' => $this->kode_prod,
            'fakultas.ID' => $this->id_fak,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);
        $query->andFilterWhere(['like', 'aliasi', $this->aliasi]);

        return $dataProvider;
    }
}
