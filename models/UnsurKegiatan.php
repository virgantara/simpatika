<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unsur_kegiatan".
 *
 * @property int $id
 * @property int $induk_id
 * @property string $nama
 * @property float $poin
 * @property string|null $jenis_pegawai 1=dosen,2=staf
 *
 * @property CatatanHarian[] $catatanHarians
 * @property IndukKegiatan $induk
 */
class UnsurKegiatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unsur_kegiatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['induk_id', 'nama', 'poin'], 'required'],
            [['induk_id'], 'integer'],
            [['poin'], 'number'],
            [['nama'], 'string', 'max' => 255],
            [['jenis_pegawai'], 'string', 'max' => 25],
            [['induk_id'], 'exist', 'skipOnError' => true, 'targetClass' => IndukKegiatan::className(), 'targetAttribute' => ['induk_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'induk_id' => 'Induk ID',
            'nama' => 'Nama',
            'poin' => 'Poin',
            'jenis_pegawai' => 'Jenis Pegawai',
        ];
    }

    /**
     * Gets query for [[CatatanHarians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanHarians()
    {
        return $this->hasMany(CatatanHarian::className(), ['unsur_id' => 'id']);
    }

    /**
     * Gets query for [[Induk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInduk()
    {
        return $this->hasOne(IndukKegiatan::className(), ['id' => 'induk_id']);
    }
}
