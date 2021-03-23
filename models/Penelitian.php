<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penelitian".
 *
 * @property integer $ID
 * @property string $NIY
 * @property string $judul
 * @property integer $tahun
 * @property string $status
 * @property string $sumberdana
 * @property string $f_penelitian
 */
class Penelitian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'penelitian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'judul', 'tahun', 'status', 'sumberdana','nilai'], 'required'],
            [['tahun'], 'integer'],
            [['nilai'], 'number'],
            [['NIY'], 'string', 'max' => 15],
            [['namanya'],'string'],
            [['judul', 'sumberdana'], 'string', 'max' => 500],
            [['status','ver'], 'string', 'max' => 100],
            [['f_penelitian'], 'string', 'max' => 200],
            [['f_penelitian'], 'file', 'extensions' => 'pdf,png,jpeg,jpg','maxSize' => 1024 * 1024 * 1],
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
            'namanya' => 'Nama',
            'judul' => 'Judul Penelitian',
            'tahun' => 'Tahun',
            'status' => 'Status Keanggotaan',
            'sumberdana' => 'Sumber Dana',
            'f_penelitian' => 'Bukti Penelitian',
            'ver' => 'Status Verifikasi',
        ];
    }
    
    public function getPenelitianDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getPenelitianData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
