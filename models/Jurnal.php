<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jurnal".
 *
 * @property int $id
 * @property int $jenis_publikasi_id
 * @property string $judul
 * @property string $nama_jurnal
 * @property string $pissn
 * @property string $eissn
 * @property string $volume
 * @property string $nomor
 * @property string $halaman
 * @property int $tahun_terbit
 * @property string $berkas
 * @property string $sumber_dana
 * @property int $is_approved
 * @property string $created_at
 * @property string $updated_at
 *
 * @property JenisPublikasi $jenisPublikasi
 * @property JurnalAuthor[] $jurnalAuthors
 */
class Jurnal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jurnal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_publikasi_id', 'judul', 'nama_jurnal', 'tahun_terbit', 'sumber_dana'], 'required'],
            [['jenis_publikasi_id', 'tahun_terbit', 'is_approved'], 'integer'],
            [['judul', 'berkas'], 'string'],
            [['created_at', 'updated_at','path_berkas'], 'safe'],
            [['nama_jurnal', 'pissn', 'eissn', 'volume', 'nomor', 'halaman'], 'string', 'max' => 255],
            [['sumber_dana'], 'string', 'max' => 11],
            [['jenis_publikasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisPublikasi::className(), 'targetAttribute' => ['jenis_publikasi_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_publikasi_id' => 'Jenis Publikasi ID',
            'judul' => 'Judul',
            'nama_jurnal' => 'Nama Jurnal',
            'pissn' => 'P-ISSN',
            'eissn' => 'E-ISSN',
            'volume' => 'Volume',
            'nomor' => 'Nomor',
            'halaman' => 'Halaman',
            'tahun_terbit' => 'Tahun Terbit',
            'berkas' => 'Berkas',
            'sumber_dana' => 'Sumber Dana',
            'is_approved' => 'Is Approved',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getNamaJenisLuaran()
    {
        return $this->jenisPublikasi->nama;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisPublikasi()
    {
        return $this->hasOne(JenisPublikasi::className(), ['id' => 'jenis_publikasi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurnalAuthors()
    {
        return $this->hasMany(JurnalAuthor::className(), ['jurnal_id' => 'id']);
    }
}
