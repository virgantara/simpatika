<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jabatan;

/**
 * JabatanSearch represents the model behind the search form of `common\models\Jabatan`.
 */
class JabatanSearch extends Jabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'tanggal_awal'], 'integer'],
            [['NIY', 'jabatan_id', 'unker_id', 'tanggal_akhir', 'update_at', 'ver','namanya'], 'safe'],
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
        $query = Jabatan::find();

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

        // $dataProvider->sort->attributes['namanya'] = [
        // // The tables are the ones our relation are configured to
        // // in my case they are prefixed with "tbl_"
        // 'asc' => ['data_diri.nama' => SORT_ASC],
        // 'desc' => ['data_diri.nama' => SORT_DESC],
        // ];
        
        // $query->joinWith('jabatan.Data');
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'tanggal_awal' => $this->tanggal_awal,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            // ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'jabatan_id', $this->jabatan_id])
            ->andFilterWhere(['like', 'unker_id', $this->unker_id])
            ->andFilterWhere(['like', 'tanggal_akhir', $this->tanggal_akhir])
//            ->andFilterWhere(['like', 'f_penugasan', $this->f_penugasan])
            ->andFilterWhere(['like', 'ver', $this->ver]);

        return $dataProvider;
    }
}
