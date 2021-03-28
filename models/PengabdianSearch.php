<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengabdian;

/**
 * PengabdianSearch represents the model behind the search form of `common\models\Pengabdian`.
 */
class PengabdianSearch extends Pengabdian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'tahun'], 'integer'],
            [['NIY', 'nama_kegiatan', 'tempat','namanya','ver'], 'safe'],
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
        $query = Pengabdian::find();
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
        
        $query->joinWith('pengabdianData');
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'nama_kegiatan', $this->nama_kegiatan])
            ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'ver', $this->ver])
            ->andFilterWhere(['like', 'tempat', $this->tempat]);

        return $dataProvider;
    }
}
