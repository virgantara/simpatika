<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property integer $ID
 * @property string $nama
 * @property integer $id_fak
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'id_fak','kode_prod','aliasi'], 'required'],
            [['id_fak','kode_prod'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['aliasi'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'nama' => 'Program Studi',
            'id_fak' => 'Fakultas',
            'kode_prod' => 'Kode Prodi',
            'aliasi' => 'Singkatan',
        ];
    }
    
    public function getUserProdi(){
        return $this->hasMany(User::className(),['id_prod'=>'ID']);
    }
    
    public function getDosenProdi(){
        return $this->hasMany(Dosen::className(),['id_prod'=>'ID']);
    }

    public function getFakultasProdi(){
        return $this->hasOne(Fakultas::className(),['ID'=>'id_fak']);
    }
    
    public function getJumlahDosen()
    {
    return $this->getDosenProdi()->count();
    }
    
//    public function getTotalPenelitian()
//    {
//    return $total = $total + $this->getDosenProdi()->getJumlahPenelitian();
//    }
}
