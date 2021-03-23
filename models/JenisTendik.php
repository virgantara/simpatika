<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_tendik".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 */
class JenisTendik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_tendik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 3],
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
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    public static function getList()
    {

        $list=JenisTendik::find()->all();
        $listData=\yii\helpers\ArrayHelper::map($list,'kode','nama');
        return $listData;
    } 
}
