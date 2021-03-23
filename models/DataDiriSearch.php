<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataDiri;

/**
 * DataDiriSearch represents the model behind the search form about `common\models\DataDiri`.
 */
class DataDiriSearch extends DataDiri
{

    public $namaPangkat;
    public $namaJabfung;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['NIY', 'nama', 'gender', 'tempat_lahir', 'tanggal_lahir', 'status_kawin', 'agama', 'pangkat', 'jabatan_fungsional', 'perguruan_tinggi', 'alamat_kampus', 'telp_kampus', 'fax_kampus', 'alamat_rumah', 'telp_hp', 'f_foto','id_prod','namaPangkat','namaJabfung','NIDN'], 'safe'],
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

     public function searchList($jenjang, $pangkat, $status)
    {
        $query = DataDiri::find();
        $query->joinWith(['pangkat0 as p','jabatanFungsional as jf','nIY as u']);
        $query->orderBy([self::tableName().'.nama'=>'ASC']);
        $query->where([
            'jenjang_kode'=>$jenjang,
            'jabatan_fungsional' => $pangkat,
            'status_dosen' => $status,
            'u.status' => 'aktif'
        ]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['namaPangkat'] = [
            'asc' => ['p.nama'=>SORT_ASC],
            'desc' => ['p.nama'=>SORT_DESC]
        ];

        $dataProvider->sort->attributes['namaJabfung'] = [
            'asc' => ['jf.nama'=>SORT_ASC],
            'desc' => ['jf.nama'=>SORT_DESC]
        ];

        


        return $dataProvider;
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
        $query = DataDiri::find();
        $query->joinWith(['pangkat0 as p','jabatanFungsional as jf','nIY.prodiUser as pd']);


        // $query->orderBy([self::tableName().'.nama'=>'ASC']);



        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, 
            ],
        ]);

        $dataProvider->sort->attributes['namaPangkat'] = [
            'asc' => ['p.nama'=>SORT_ASC],
            'desc' => ['p.nama'=>SORT_DESC]
        ];

        $dataProvider->sort->attributes['namaJabfung'] = [
            'asc' => ['jf.nama'=>SORT_ASC],
            'desc' => ['jf.nama'=>SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'ID' => $this->ID,
        //     'tanggal_lahir' => $this->tanggal_lahir,
        // ]);

        if(Yii::$app->user->identity->status_admin == 'admin'){
            $query->andWhere(['pd.ID' => Yii::$app->user->identity->id_prod]);
        }

        $query->andFilterWhere(['like', self::tableName().'.NIY', $this->NIY])
            ->andFilterWhere(['like', self::tableName().'.nama', $this->nama])
            ->andFilterWhere(['like', 'NIDN', $this->NIDN])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'status_kawin', $this->status_kawin])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'namaPangkat', $this->namaPangkat])
            ->andFilterWhere(['like', 'namaJabfung', $this->namaJabfung])
            ->andFilterWhere(['like', 'perguruan_tinggi', $this->perguruan_tinggi])
            ->andFilterWhere(['like', 'alamat_kampus', $this->alamat_kampus])
            ->andFilterWhere(['like', 'telp_kampus', $this->telp_kampus])
            ->andFilterWhere(['like', 'fax_kampus', $this->fax_kampus])
            ->andFilterWhere(['like', 'alamat_rumah', $this->alamat_rumah])
            ->andFilterWhere(['like', 'telp_hp', $this->telp_hp])
            ->andFilterWhere(['like', 'f_foto', $this->f_foto]);

        return $dataProvider;
    }
}
