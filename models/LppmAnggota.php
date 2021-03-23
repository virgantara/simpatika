<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lppm_anggota".
 *
 * @property int $id
 * @property string $nama
 *
 * @property LppmPenelitianAnggota[] $lppmPenelitianAnggotas
 */
class LppmAnggota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lppm_anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
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
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLppmPenelitianAnggotas()
    {
        return $this->hasMany(LppmPenelitianAnggota::className(), ['anggota_id' => 'id']);
    }

    public static function getListJenisAnggota()
    {
       
        $query = LppmAnggota::find();
        $list = $query->all();
        $list=\yii\helpers\ArrayHelper::map($list,'id','nama');

        return $list;
    }
}
