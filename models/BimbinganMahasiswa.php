<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bimbingan_mahasiswa".
 *
 * @property int $id
 * @property string|null $NIY
 * @property string $nama
 */
class BimbinganMahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bimbingan_mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['NIY'], 'string', 'max' => 15],
            [['nama'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'NIY' => 'Niy',
            'nama' => 'Nama',
        ];
    }
}
