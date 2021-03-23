<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang_kepakaran".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property string $kode_dikti
 * @property int $level
 * @property string $parent
 *
 * @property BidangKepakaran $parent0
 * @property BidangKepakaran[] $bidangKepakarans
 * @property DataDiri[] $dataDiris
 */
class BidangKepakaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bidang_kepakaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['level'], 'integer'],
            [['kode', 'nama', 'kode_dikti', 'parent'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => BidangKepakaran::className(), 'targetAttribute' => ['parent' => 'kode']],
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
            'kode_dikti' => 'Kode Dikti',
            'level' => 'Level',
            'parent' => 'Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(BidangKepakaran::className(), ['kode' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangKepakarans()
    {
        return $this->hasMany(BidangKepakaran::className(), ['parent' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataDiris()
    {
        return $this->hasMany(DataDiri::className(), ['kepakaran_id' => 'id']);
    }
}
