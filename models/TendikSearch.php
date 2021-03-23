<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tendik;

/**
 * TendikSearch represents the model behind the search form of `common\models\Tendik`.
 */
class TendikSearch extends Tendik
{
    public $namaJenjang;
    public $namaJenis;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'jabatan_id'], 'integer'],
            [['NIY', 'nama', 'gender', 'tempat_lahir', 'tanggal_lahir', 'status_kawin', 'agama', 'jenjang_kode', 'perguruan_tinggi', 'alamat_kampus', 'telp_kampus', 'fax_kampus', 'alamat_rumah', 'telp_hp','namaJenjang','namaJenis'], 'safe'],
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

    public function searchList($jenjang, $jenis)
    {
        $query = Tendik::find();
        $query->joinWith(['jenjangKode as p','jenisTendik as jf']);
        $query->orderBy([self::tableName().'.nama'=>'ASC']);
        $query->where([
            'jenjang_kode'=>$jenjang,
            'jenis_tendik_id' => $jenis,
        ]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['namaJenjang'] = [
            'asc' => ['p.nama'=>SORT_ASC],
            'desc' => ['p.nama'=>SORT_DESC]
        ];

        $dataProvider->sort->attributes['namaJenis'] = [
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
        $query = Tendik::find();
        $query->joinWith(['jenjangKode as p','jenisTendik as jf']);
        // add conditions that should always apply here

         $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['namaJenjang'] = [
            'asc' => ['p.nama'=>SORT_ASC],
            'desc' => ['p.nama'=>SORT_DESC]
        ];

        $dataProvider->sort->attributes['namaJenis'] = [
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
        $query->andFilterWhere([
           
            'tanggal_lahir' => $this->tanggal_lahir,
           
            'unit_id' => $this->unit_id,
            'jabatan_id' => $this->jabatan_id,
        ]);

        $query->andFilterWhere(['like', 'NIY', $this->NIY])
            ->andFilterWhere(['like', self::tableName().'.nama', $this->nama])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'status_kawin', $this->status_kawin])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'jenjang_kode', $this->jenjang_kode])
            ->andFilterWhere(['like', 'perguruan_tinggi', $this->perguruan_tinggi])
            ->andFilterWhere(['like', 'alamat_kampus', $this->alamat_kampus])
            ->andFilterWhere(['like', 'telp_kampus', $this->telp_kampus])
            ->andFilterWhere(['like', 'fax_kampus', $this->fax_kampus])
            ->andFilterWhere(['like', 'alamat_rumah', $this->alamat_rumah])
            ->andFilterWhere(['like', 'telp_hp', $this->telp_hp]);

        return $dataProvider;
    }
}
