<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dosen;

/**
 * DosenSearch represents the model behind the search form about `common\models\Dosen`.
 */
class DosenSearch extends Dosen
{

    public $nidnDosen;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'ID', 'created_at', 'updated_at','total_penelitian'], 'integer'],
            [['NIY', 'status_admin', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'id_prod','gendernya','namanya','nidnDosen'], 'safe'],
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
        $query = Dosen::find();

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

        $dataProvider->sort->attributes['nidnDosen'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
            'asc' => ['data_diri.NIDN' => SORT_ASC],
            'desc' => ['data_diri.NIDN' => SORT_DESC],
        ];

        $query->joinWith('prodiDosen');
        $query->joinWith('dosenData');
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
//            'jumlahPenghargaan' => $this->namanya,
            'prodi.ID' => $this->id_prod,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'jumlahPenelitian' => $this->total_penelitian,
        ]);

        $query
            ->andFilterWhere(['and',['like', 'user.NIY', $this->NIY],['not like','user.NIY', 'AdminSuper']])
//            ->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'status_admin', $this->status_admin])
            ->andFilterWhere(['like', 'data_diri.NIDN', $this->nidnDosen])
            ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'data_diri.gender', $this->gendernya])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
