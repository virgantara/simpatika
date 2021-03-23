<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelatihan".
 *
 * @property integer $ID
 * @property string $NIY
 * @property string $tanggal_awal
 * @property string $tanggal_akhir
 * @property string $nama_pelatihan
 * @property string $penyelenggara
 * @property string $f_sertifikat
 */
class Pelatihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'pelatihan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tanggal_awal', 'nama_pelatihan', 'penyelenggara'], 'required'],
            [['tanggal_awal', 'tanggal_akhir'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['nama_pelatihan','namanya'], 'string', 'max' => 500],
            [['penyelenggara','ver'], 'string', 'max' => 50],
            [['f_sertifikat'], 'string', 'max' => 200],
            [['f_sertifikat'], 'file', 'extensions' => 'jpg,pdf,png,jpeg','maxSize' => 1024 * 1024 * 1],
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
            'tanggal_awal' => 'Tanggal Mulai Pelatihan',
            'tanggal_akhir' => 'Tanggal Berakhir Pelatihan',
            'nama_pelatihan' => 'Nama Pelatihan',
            'penyelenggara' => 'Penyelenggara',
            'f_sertifikat' => 'Sertifikat',
            'ver' => 'Status Verifikasi',
        ];
    }
    public function getPelatihanDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getPelatihanData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
