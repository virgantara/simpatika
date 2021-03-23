<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'created_at', 'updated_at'], 'integer'],
            [[ 'status','NIY', 'status_admin', 'auth_key', 'password_hash', 'password_reset_token', 'email','id_prod','nama','uuid'], 'safe'],
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
        $query = User::find();

        $query->joinWith(['dataDiri as dd','prodiUser']);

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

        $dataProvider->sort->attributes['nama'] = [
            'asc' => ['dd.nama'=>SORT_ASC],
            'desc' => ['dd.nama'=>SORT_DESC]
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'prodi.ID' => $this->id_prod,
            'created_at' => $this->created_at,
           'uuid' => $this->uuid,
            'updated_at' => $this->updated_at,
        ]);

        if(Yii::$app->user->identity->status_admin == 'admin'){
            $query->andWhere(['id_prod' => Yii::$app->user->identity->id_prod]);
        }

        $query->andFilterWhere(['like', 'dd.NIY', $this->NIY])
            ->andFilterWhere(['like', 'dd.nama', $this->nama])
            ->andFilterWhere(['like', 'status_admin', $this->status_admin])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
