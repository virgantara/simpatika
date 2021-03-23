<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produk_ajar".
 *
 * @property integer $ID
 * @property integer $NIY
 * @property string $matkul
 * @property string $program_pendidikan
 * @property string $jenis
 * @property integer $tahun_awal
 * @property string $tahun_akhir
 * @property string $update_at
 */
class ProdukAjar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'produk_ajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'matkul', 'program_pendidikan', 'jenis', 'tahun_awal', 'tahun_akhir'], 'required'],
            [['NIY', 'tahun_awal'], 'integer'],
            [['update_at'], 'safe'],
            [['matkul', 'jenis','ver'], 'string', 'max' => 50],
            [['program_pendidikan'], 'string', 'max' => 30],
            [['namanya'], 'string'],
            [['tahun_akhir'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'Niy',
            'namanya' => 'Nama',
            'matkul' => 'Mata Kuliah',
            'program_pendidikan' => 'Program Pendidikan',
            'jenis' => 'Jenis Produk',
            'tahun_awal' => 'Tahun Pertama Digunakan',
            'tahun_akhir' => 'Tahun Terakhir Digunakan',
            'update_at' => 'Update At',
            'ver' => 'Status Verifikasi',
        ];
    }
    public function getProdukDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getProdukData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
