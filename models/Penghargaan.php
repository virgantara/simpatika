<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penghargaan".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun
 * @property string $bentuk
 * @property string $pemberi
 * @property string $f_penghargaan
 */
class Penghargaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'penghargaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun', 'bentuk', 'pemberi'], 'required'],
            [['tahun'], 'integer'],
            [['NIY'], 'string', 'max' => 15],
            [['bentuk','namanya'], 'string', 'max' => 100],
            [['pemberi','ver'], 'string', 'max' => 50],
            [['f_penghargaan'], 'string', 'max' => 200],
            [['f_penghargaan'], 'file', 'extensions' => 'jpg,jpeg,png,pdf'],
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
            'tahun' => 'Tahun',
            'namanya' => 'Nama',
            'bentuk' => 'Bentuk Penghargaan',
            'pemberi' => 'Pemberi',
            'f_penghargaan' => 'Sertifikasi Penghargaan',
            'ver' => 'Status Verifikasi',
        ];
    }
    
    public function getPenghargaanDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
    public function getPenghargaanData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
