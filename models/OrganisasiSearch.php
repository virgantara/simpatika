<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organisasi;

/**
 * OrganisasiSearch represents the model behind the search form of `app\models\Organisasi`.
 */
class OrganisasiSearch extends Organisasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'tahun_awal'], 'integer'],
            [['NIY', 'tahun_akhir', 'organisasi', 'jabatan', 'f_sk', 'tanggal_mulai_keanggotaan', 'selesai_keanggotaan', 'sister_id', 'update_at', 'ver'], 'safe'],
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
        $query = Organisasi::find();
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
            'ID' => $this->ID,
            'tahun_awal' => $this->tahun_awal,
            'tanggal_mulai_keanggotaan' => $this->tanggal_mulai_keanggotaan,
            'selesai_keanggotaan' => $this->selesai_keanggotaan,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'tahun_akhir', $this->tahun_akhir])
            ->andFilterWhere(['like', 'organisasi', $this->organisasi])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'f_sk', $this->f_sk])
            ->andFilterWhere(['like', 'sister_id', $this->sister_id])
            ->andFilterWhere(['like', 'ver', $this->ver]);

        return $dataProvider;
    }
}
