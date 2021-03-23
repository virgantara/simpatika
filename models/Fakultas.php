<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fakultas".
 *
 * @property integer $ID
 * @property string $nama
 */
class Fakultas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fakultas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'nama' => 'Nama',
        ];
    }
    
    public function getProdiFakultas(){
        return $this->hasMany(Prodi::className(),['id_fak'=>'ID']);
    }
//    public function getJumlahStat(){
//        return $this->getProdiFakultas()->count();
//    }
    
}
