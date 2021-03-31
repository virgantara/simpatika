<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tugas_dosen".
 *
 * @property string $id
 * @property string $nama
 *
 * @property DataDiri[] $dataDiris
 */
class TugasDosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tugas_dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 100],
            [['id'], 'unique'],
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
     * Gets query for [[DataDiris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataDiris()
    {
        return $this->hasMany(DataDiri::className(), ['tugas_dosen_id' => 'id']);
    }
}
