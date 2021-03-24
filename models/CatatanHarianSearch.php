<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatatanHarian;

/**
 * CatatanHarianSearch represents the model behind the search form of `app\models\CatatanHarian`.
 */
class CatatanHarianSearch extends CatatanHarian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unsur_id', 'user_id', 'approved_by'], 'integer'],
            [['deskripsi', 'tanggal', 'is_selesai', 'updated_at', 'created_at'], 'safe'],
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
        $query = CatatanHarian::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['unsur as u']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(Yii::$app->user->identity->access_role =='Dosen' || Yii::$app->user->identity->access_role =='Staf')
        {
            $query->andWhere([
                'u.jenis_pegawai' => Yii::$app->user->identity->access_role, 
                'user_id' => Yii::$app->user->identity->id
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'unsur_id' => $this->unsur_id,
            'user_id' => $this->user_id,
            'tanggal' => $this->tanggal,
            'approved_by' => $this->approved_by,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'is_selesai', $this->is_selesai]);

        return $dataProvider;
    }
}
