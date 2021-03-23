<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unsur_utama".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property int $urutan
 *
 * @property KomponenKegiatan[] $komponenKegiatans
 * @property UnsurPenilaian[] $unsurPenilaians
 */
class UnsurUtama extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unsur_utama';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['urutan'], 'required'],
            [['urutan'], 'integer'],
            [['kode'], 'string', 'max' => 50],
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
            'urutan' => 'Urutan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomponenKegiatans()
    {
        return $this->hasMany(KomponenKegiatan::className(), ['unsur_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnsurPenilaians()
    {
        return $this->hasMany(UnsurPenilaian::className(), ['unsur_id' => 'id']);
    }
}
