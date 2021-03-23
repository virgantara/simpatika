<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisasi".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun_awal
 * @property string $tahun_akhir
 * @property string $organisasi
 * @property string $jabatan
 * @property string $f_sk
 * @property string $update_at
 */
class Organisasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'organisasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun_awal', 'tahun_akhir', 'organisasi', 'jabatan'], 'required'],
            [['tahun_awal'], 'integer'],
            [['update_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['tahun_akhir'], 'string', 'max' => 10],
            [['organisasi', 'f_sk','namanya'], 'string', 'max' => 200],
            [['jabatan','ver'], 'string', 'max' => 50],
            [['f_sk'], 'file', 'extensions' => 'pdf,jpg,png,jpeg','maxSize' => 1024 * 1024 * 1],
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
            'tahun_awal' => 'Tahun Awal',
            'tahun_akhir' => 'Tahun Akhir',
            'organisasi' => 'Organisasi',
            'jabatan' => 'Jabatan',
            'f_sk' => 'Surat Keterangan Organisasi',
            'update_at' => 'Update At',
            'ver' => 'Status Verifikasi',
        ];
    }
    public function getOrganisasiDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getOrganisasiData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
