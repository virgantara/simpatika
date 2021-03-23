<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verify".
 *
 * @property int $ID
 * @property string $NIY
 * @property int $kategori
 * @property int $ID_data
 * @property string $ver
 */
class Verify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'verify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'kategori', 'ID_data'], 'required'],
            [['ID', 'kategori', 'ID_data'], 'integer'],
            [['ver','namanya'], 'string'],
            [['NIY'], 'string', 'max' => 15],
            [['ID'], 'unique'],
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
            'namanya' => 'Nama',
            'kategori' => 'Kategori',
            'ID_data' => 'Id Data',
            'ver' => 'Status Verifikasi',
        ];
    }
    
    public function getVerifyKategori(){
        return $this->hasOne(Kategori::className(),['ID'=>'kategori']);
    }
    
    public function getVerifyData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
