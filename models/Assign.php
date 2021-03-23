<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assign".
 *
 * @property int $ID
 * @property string $Keterangan
 * @property string $status
 */
class Assign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Keterangan', 'status'], 'required'],
            [['status'], 'string'],
//            [['Keterangan'], 'unique'],
            [['Keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Keterangan' => 'Keterangan',
            'status' => 'Status',
        ];
    }
    
    public function getAssignAssignment(){
        return $this->hasMany(Assignment::className(),['id_assign'=>'ID']);
    }
}
