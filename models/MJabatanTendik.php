<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_jabatan_tendik".
 *
 * @property int $id
 * @property string $nama
 *
 * @property Tendik[] $tendiks
 */
class MJabatanTendik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_jabatan_tendik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTendiks()
    {
        return $this->hasMany(Tendik::className(), ['jabatan_id' => 'id']);
    }

    public static function getList()
    {

        $list=MJabatanTendik::find()->all();
        $listData=\yii\helpers\ArrayHelper::map($list,'id','nama');
        return $listData;
    } 
}
