<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penelitian;

/**
 * PenelitianSearch represents the model behind the search form of `common\models\Penelitian`.
 */
class PenelitianSearch extends Penelitian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'tahun'], 'integer'],
            [['NIY', 'judul', 'status', 'sumberdana','namanya','ver'], 'safe'],
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
        $query = Penelitian::find();

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

        $dataProvider->sort->attributes['namanya'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['data_diri.nama' => SORT_ASC],
        'desc' => ['data_diri.nama' => SORT_DESC],
        ];
        
        $query->joinWith('penelitianData');
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'ver', $this->ver])
            ->andFilterWhere(['like', 'sumberdana', $this->sumberdana]);
//            ->andFilterWhere(['like', 'f_penelitian', $this->f_penelitian]);

        return $dataProvider;
    }
}
