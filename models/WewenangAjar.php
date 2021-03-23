<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wewenang_ajar".
 *
 * @property int $id
 * @property int $jabatan_id
 * @property int $kualifikasi_id
 * @property int $prodi_id
 * @property string $wewenang
 *
 * @property MJabatanAkademik $jabatan
 * @property MJenjangPendidikan $kualifikasi
 * @property MJenjangPendidikan $prodi
 */
class WewenangAjar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wewenang_ajar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jabatan_id', 'kualifikasi_id', 'wewenang'], 'required'],
            [['jabatan_id', 'kualifikasi_id', 'prodi_id'], 'integer'],
            [['wewenang'], 'string', 'max' => 1],
            [['jabatan_id', 'kualifikasi_id', 'prodi_id'], 'unique', 'targetAttribute' => ['jabatan_id', 'kualifikasi_id', 'prodi_id']],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatanAkademik::className(), 'targetAttribute' => ['jabatan_id' => 'id']],
            [['kualifikasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => MJenjangPendidikan::className(), 'targetAttribute' => ['kualifikasi_id' => 'id']],
            [['prodi_id'], 'exist', 'skipOnError' => true, 'targetClass' => MJenjangPendidikan::className(), 'targetAttribute' => ['prodi_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jabatan_id' => 'Jabatan',
            'kualifikasi_id' => 'Kualifikasi',
            'prodi_id' => 'Program Studi',
            'wewenang' => 'Wewenang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(MJabatanAkademik::className(), ['id' => 'jabatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKualifikasi()
    {
        return $this->hasOne(MJenjangPendidikan::className(), ['id' => 'kualifikasi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(MJenjangPendidikan::className(), ['id' => 'prodi_id']);
    }
}
