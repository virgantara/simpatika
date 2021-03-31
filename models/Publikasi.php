<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publikasi".
 *
 * @property int $id
 * @property string|null $judul_publikasi_paten
 * @property string|null $NIY
 * @property string|null $nama_jenis_publikasi
 * @property string|null $nama_kategori_kegiatan
 * @property string|null $tanggal_terbit
 * @property string|null $sister_id
 * @property string|null $tautan_laman_jurnal
 * @property string|null $tautan
 * @property string|null $volume
 * @property string|null $nomor
 * @property string|null $halaman
 * @property string|null $penerbit
 * @property string|null $doi
 * @property string|null $issn
 * @property string|null $is_claimed
 * @property int|null $kegiatan_id
 * @property float|null $sks_bkd
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property User $nIY
 * @property KomponenKegiatan $kegiatan
 */
class Publikasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publikasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal_terbit', 'updated_at', 'created_at'], 'safe'],
            [['kegiatan_id'], 'integer'],
            [['sks_bkd'], 'number'],
            [['judul_publikasi_paten', 'nama_jenis_publikasi', 'nama_kategori_kegiatan', 'tautan_laman_jurnal', 'tautan', 'penerbit', 'doi', 'issn'], 'string', 'max' => 255],
            [['NIY'], 'string', 'max' => 15],
            [['sister_id'], 'string', 'max' => 100],
            [['volume', 'nomor'], 'string', 'max' => 5],
            [['halaman'], 'string', 'max' => 50],
            [['is_claimed'], 'string', 'max' => 1],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KomponenKegiatan::className(), 'targetAttribute' => ['kegiatan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul_publikasi_paten' => 'Judul Publikasi Paten',
            'NIY' => 'Niy',
            'nama_jenis_publikasi' => 'Nama Jenis Publikasi',
            'nama_kategori_kegiatan' => 'Nama Kategori Kegiatan',
            'tanggal_terbit' => 'Tanggal Terbit',
            'sister_id' => 'Sister ID',
            'tautan_laman_jurnal' => 'Tautan Laman Jurnal',
            'tautan' => 'Tautan',
            'volume' => 'Volume',
            'nomor' => 'Nomor',
            'halaman' => 'Halaman',
            'penerbit' => 'Penerbit',
            'doi' => 'Doi',
            'issn' => 'Issn',
            'is_claimed' => 'Is Claimed',
            'kegiatan_id' => 'Kegiatan ID',
            'sks_bkd' => 'Sks Bkd',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[NIY]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }

    /**
     * Gets query for [[Kegiatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKegiatan()
    {
        return $this->hasOne(KomponenKegiatan::className(), ['id' => 'kegiatan_id']);
    }
}
