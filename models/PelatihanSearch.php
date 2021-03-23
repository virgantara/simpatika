<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pelatihan;

/**
 * PelatihanSearch represents the model behind the search form of `common\models\Pelatihan`.
 */
class PelatihanSearch extends Pelatihan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['NIY', 'tanggal_awal', 'tanggal_akhir', 'nama_pelatihan', 'penyelenggara', 'ver','namanya'], 'safe'],
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
        $query = Pelatihan::find();

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
        
        $query->joinWith('pelatihanData');
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'nama_pelatihan', $this->nama_pelatihan])
            ->andFilterWhere(['like', 'penyelenggara', $this->penyelenggara])
//            ->andFilterWhere(['like', 'f_sertifikat', $this->f_sertifikat])
            ->andFilterWhere(['like', 'ver', $this->ver]);

        return $dataProvider;
    }
}
