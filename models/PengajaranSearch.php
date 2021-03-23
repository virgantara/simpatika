<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajaran;

/**
 * PengajaranSearch represents the model behind the search form of `common\models\Pengajaran`.
 */
class PengajaranSearch extends Pengajaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['NIY', 'matkul','sks','kelas','kode_mk','tahun_akademik', 'program_pendidikan', 'jurusan', 'institusi', 'program', 'ver','namanya'], 'safe'],
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
        $query = Pengajaran::find();
        $query->alias('p');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['p.NIY' => Yii::$app->user->identity->NIY]);

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
        
        $query->joinWith('pengajaranData');
        // grid filtering conditions
        $query->andFilterWhere([
            'sks' => $this->sks,
            'tahun_akademik' => $this->tahun_akademik,
            
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', 'data_diri.nama', $this->namanya])
            ->andFilterWhere(['like', 'matkul', $this->matkul])
            ->andFilterWhere(['like', 'kelas', $this->kelas])
            ->andFilterWhere(['like', 'jurusan', $this->jurusan])
            ->andFilterWhere(['like', 'institusi', $this->institusi])
            ->andFilterWhere(['like', 'program', $this->program])
//            ->andFilterWhere(['like', 'f_penugasan', $this->f_penugasan])
            ->andFilterWhere(['like', 'ver', $this->ver]);

        return $dataProvider;
    }
}
