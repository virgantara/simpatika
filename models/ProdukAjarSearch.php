<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProdukAjar;

/**
 * ProdukAjarSearch represents the model behind the search form of `common\models\ProdukAjar`.
 */
class ProdukAjarSearch extends ProdukAjar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NIY', 'tahun_awal'], 'integer'],
            [['matkul', 'program_pendidikan', 'jenis', 'tahun_akhir', 'update_at', 'ver','namanya'], 'safe'],
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
        $query = ProdukAjar::find();
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

        $dataProvider->sort->attributes['namanya'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['data_diri.nama' => SORT_ASC],
        'desc' => ['data_diri.nama' => SORT_DESC],
        ];
        
        $query->joinWith('produkData');
        
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'NIY' => $this->NIY,
            'tahun_awal' => $this->tahun_awal,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'matkul', $this->matkul])
            ->andFilterWhere(['like', 'program_pendidikan', $this->program_pendidikan])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'tahun_akhir', $this->tahun_akhir])
            ->andFilterWhere(['like', 'ver', $this->ver]);

        return $dataProvider;
    }
}
