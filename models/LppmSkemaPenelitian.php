<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lppm_skema_penelitian".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 *
 * @property LppmPenelitian[] $lppmPenelitians
 */
class LppmSkemaPenelitian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lppm_skema_penelitian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 100],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'jenis_penelitian' => 'Jenis Penelitian'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLppmPenelitians()
    {
        return $this->hasMany(LppmPenelitian::className(), ['lppm_skema_penelitian_id' => 'id']);
    }

    public static function getListSkema($jenis='riset')
    {
       
        $list=LppmSkemaPenelitian::find()->where(['jenis_penelitian'=>$jenis])->all();
        $list=\yii\helpers\ArrayHelper::map($list,'id',function($data){
            return $data->nama.' ('.$data->kode.')';
        });

        return $list;
    }
}
