<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assignment".
 *
 * @property int $ID
 * @property string $NIY
 * @property int $id_assign
 * @property string $keterangan
 * @property string $status
 * @property string $file
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'id_assign'], 'required'],
            [['id_assign'], 'integer'],
//            [['id_assign'], 'unique'],
            [['keterangan', 'status','namanya'], 'string'],
            [['NIY'], 'string', 'max' => 10],
            [['file'], 'string', 'max' => 250],
            [['file'], 'file', 'extensions' => 'jpeg,jpg,png,pdf','maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'namanya' => 'Nama',
            'NIY' => 'Niy',
            'id_assign' => 'Id Assign',
            'keterangan' => 'Keterangan Data',
            'status' => 'Status',
            'file' => 'File',
        ];
    }
    
    public function getAssignmentData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
    
    public function getAssignmentAssign(){
        return $this->hasOne(Assign::className(),['ID'=>'id_assign']);
    }
}
