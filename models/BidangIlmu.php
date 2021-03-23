<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang_ilmu".
 *
 * @property string $kode
 * @property string $nama
 * @property int $level
 * @property string $kode_id
 *
 * @property BidangIlmu $kode0
 * @property BidangIlmu[] $bidangIlmus
 * @property DataDiri[] $dataDiris
 */
class BidangIlmu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bidang_ilmu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama', 'level'], 'required'],
            [['level'], 'integer'],
            [['kode', 'kode_id'], 'string', 'max' => 5],
            [['nama'], 'string', 'max' => 255],
            [['kode'], 'unique'],
            [['kode_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidangIlmu::className(), 'targetAttribute' => ['kode_id' => 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
            'level' => 'Level',
            'kode_id' => 'Kode ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKode0()
    {
        return $this->hasOne(BidangIlmu::className(), ['kode' => 'kode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangIlmus()
    {
        return $this->hasMany(BidangIlmu::className(), ['kode_id' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataDiris()
    {
        return $this->hasMany(DataDiri::className(), ['bidang_ilmu_id' => 'kode']);
    }
}
