<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resensi".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun
 * @property string $judul
 * @property string $penerbit
 * @property string $status
 * @property string $f_resensi
 */
class Resensi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'resensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun', 'judul', 'penerbit', 'status'], 'required'],
            [['tahun'], 'integer'],
            [['status','namanya'], 'string'],
            [['NIY'], 'string', 'max' => 15],
            [['judul', 'penerbit','ver'], 'string', 'max' => 100],
            [['f_resensi'], 'string', 'max' => 200],
            [['f_resensi'], 'file', 'extensions' => 'pdf,jpeg,jpg,png','maxSize' => 1024 * 1024 * 1],
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
            'tahun' => 'Tahun',
            'judul' => 'Judul',
            'penerbit' => 'Penerbit',
            'status' => 'Status',
            'f_resensi' => 'Bukti Resensi dkk',
            'ver' => 'Status Verifikasi',
        ];
    }
    public function getResensiDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getResensiData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
