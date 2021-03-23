<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendidikan".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun_lulus
 * @property string $jenjang
 * @property string $perguruan_tinggi
 * @property string $jurusan
 * @property string $f_ijazah
 */
class Pendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'pendidikan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun_lulus', 'jenjang', 'perguruan_tinggi', 'jurusan'], 'required'],
            [['tahun_lulus'], 'integer'],
            [['NIY'], 'string', 'max' => 15],
            [['jenjang'], 'string', 'max' => 25],
            [['perguruan_tinggi','namanya'], 'string', 'max' => 100],
            [['jurusan','ver'], 'string', 'max' => 50],
            [['f_ijazah'], 'string', 'max' => 200],
            [['f_ijazah'], 'file', 'extensions' => 'jpg,pdf,png,jpeg','maxSize' => 1024 * 1024 * 1],
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
            'tahun_lulus' => 'Tahun Kelulusan',
            'jenjang' => 'Jenjang',
            'perguruan_tinggi' => 'Perguruan Tinggi',
            'jurusan' => 'Jurusan',
            'f_ijazah' => 'Ijazah',
            'ver' => 'Status Verifikasi',
        ];
    }
    public function getPendidikanDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getPendidikanData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
    
}
