<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengabdian".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun
 * @property string $nama_kegiatan
 * @property string $tempat
 */
class Pengabdian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'pengabdian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun', 'nama_kegiatan', 'tempat','nilai'], 'required'],
            [['tahun','bulan'], 'integer'],
            [['nilai'], 'number'],
            [['NIY'], 'string', 'max' => 15],
            [['nama_kegiatan'], 'string', 'max' => 500],
            [['namanya','ver'], 'string', 'max' => 100],
            [['tempat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'NIY',
            'nilai' => 'Besar Dana',
            'bulan' => 'Bulan',
            'tahun' => 'Tahun',
            'nama_kegiatan' => 'Nama Kegiatan',
            'tempat' => 'Tempat',
            'ver' => 'Status Verifikasi',
            'namanya' => 'Nama',
        ];
    }
    
    public function getPengabdianDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
    public function getPengabdianData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
