<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "support".
 *
 * @property int $ID
 * @property string $NIY
 * @property string $pesan
 * @property string $waktu
 * @property string $sender
 */
class Support extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'support';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'sender'], 'required'],
            [['pesan'], 'string'],
            [['waktu'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['sender'], 'string', 'max' => 20],
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
            'pesan' => '',
            'waktu' => 'Waktu',
            'sender' => 'Sender',
        ];
    }
    
    public function getSupportData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
    
    public function getSupportDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
}
