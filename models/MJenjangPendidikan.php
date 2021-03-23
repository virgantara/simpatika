<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "m_jenjang_pendidikan".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 *
 * @property Pendidikan[] $pendidikans
 */
class MJenjangPendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_jenjang_pendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 5],
            [['nama'], 'string', 'max' => 20],
            [['kode'], 'unique'],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendidikans()
    {
        return $this->hasMany(Pendidikan::className(), ['jenjang' => 'kode']);
    }

    public static function getList()
    {

        $list=MJenjangPendidikan::find()->all();
        $listData=ArrayHelper::map($list,'kode','nama');
        return $listData;
    } 
}
