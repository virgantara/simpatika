<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hki".
 *
 * @property int $id
 * @property int $jenis_hki_id
 * @property string $no_pendaftaran
 * @property string $judul
 * @property string $status_hki
 * @property int $tahun_pelaksanaan
 * @property string $sumber_dana
 * @property string $berkas
 * @property string $created_at
 * @property string $updated_at
 *
 * @property JenisLuaran $jenisHki
 * @property HkiAuthor[] $hkiAuthors
 */
class Hki extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hki';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_hki_id', 'no_pendaftaran', 'judul', 'status_hki', 'tahun_pelaksanaan', 'sumber_dana'], 'required'],
            [['jenis_hki_id', 'tahun_pelaksanaan'], 'integer'],
            [['berkas'], 'string'],
            [['created_at', 'updated_at','shared_link','ver'], 'safe'],
            [['no_pendaftaran', 'judul', 'status_hki', 'sumber_dana'], 'string', 'max' => 255],
            [['jenis_hki_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisLuaran::className(), 'targetAttribute' => ['jenis_hki_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_hki_id' => 'Jenis Hki ID',
            'no_pendaftaran' => 'No Pendaftaran',
            'judul' => 'Judul',
            'status_hki' => 'Status HKI',
            'tahun_pelaksanaan' => 'Tahun Pelaksanaan',
            'sumber_dana' => 'Sumber Dana',
            'berkas' => 'Berkas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisHki()
    {
        return $this->hasOne(JenisLuaran::className(), ['id' => 'jenis_hki_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHkiAuthors()
    {
        return $this->hasMany(HkiAuthor::className(), ['hki_id' => 'id']);
    }
}
