<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kegiatan".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun_awal
 * @property string $tahun_akhir
 * @property string $nama_kegiatan
 * @property string $peran
 * @property string $tempat
 * @property string $update_at
 */
class Kegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun_awal', 'tahun_akhir', 'nama_kegiatan', 'peran', 'tempat'], 'required'],
            [['tahun_awal'], 'integer'],
            [['update_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['tahun_akhir'], 'string', 'max' => 10],
            [['nama_kegiatan','namanya'], 'string', 'max' => 100],
            [['peran', 'tempat','ver'], 'string', 'max' => 50],
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
            'tahun_awal' => 'Tahun Awal',
            'tahun_akhir' => 'Tahun Akhir',
            'nama_kegiatan' => 'Nama Kegiatan',
            'namanya' => 'Nama',
            'peran' => 'Peran',
            'tempat' => 'Tempat',
            'update_at' => 'Update At',
            'ver' => 'Status Verifikasi',
        ];
    }
    
    public function getKegiatanDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
    public function getKegiatanData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
