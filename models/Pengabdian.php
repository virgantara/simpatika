<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengabdian".
 *
 * @property int $ID
 * @property string $NIY
 * @property string $judul_penelitian_pengabdian
 * @property string|null $nama_tahun_ajaran
 * @property string|null $nama_skim
 * @property string|null $tempat_kegiatan
 * @property string|null $no_sk_tugas
 * @property string|null $tgl_sk_tugas
 * @property string|null $tahun_usulan
 * @property string|null $tahun_kegiatan
 * @property string|null $tahun_dilaksanakan
 * @property int|null $durasi_kegiatan
 * @property int $tahun_pelaksanaan_ke
 * @property string|null $jenis_penelitian_pengabdian
 * @property float|null $nilai
 * @property string|null $sister_id
 * @property string|null $kategori_kegiatan_id
 * @property string|null $skim_kegiatan_id
 * @property string|null $kelompok_bidang_id
 * @property float $dana_dikti
 * @property float $dana_pt
 * @property float $dana_institusi_lain
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property User $nIY
 * @property KategoriKegiatan $kategoriKegiatan
 * @property KelompokBidang $kelompokBidang
 * @property SkimKegiatan $skimKegiatan
 * @property PengabdianAnggota[] $pengabdianAnggotas
 */
class Pengabdian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengabdian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'judul_penelitian_pengabdian', 'tahun_pelaksanaan_ke', 'dana_dikti', 'dana_pt', 'dana_institusi_lain','tahun_usulan','tahun_kegiatan','tahun_dilaksanakan','durasi_kegiatan'], 'required'],
            [['tgl_sk_tugas', 'updated_at', 'created_at','skim_kegiatan_id','kelompok_bidang_id','kategori_kegiatan_id','sister_id','nilai','is_claimed'], 'safe'],
            [['durasi_kegiatan', 'tahun_pelaksanaan_ke'], 'integer'],
            [['nilai', 'dana_dikti', 'dana_pt', 'dana_institusi_lain'], 'number'],
            [['NIY'], 'string', 'max' => 15],
            [['judul_penelitian_pengabdian'], 'string', 'max' => 500],
            [['nama_tahun_ajaran', 'no_sk_tugas', 'sister_id', 'skim_kegiatan_id', 'kelompok_bidang_id'], 'string', 'max' => 100],
            [['nama_skim', 'tempat_kegiatan'], 'string', 'max' => 255],
            [['tahun_usulan', 'tahun_kegiatan', 'tahun_dilaksanakan', 'jenis_penelitian_pengabdian', 'kategori_kegiatan_id'], 'string', 'max' => 10],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['kategori_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriKegiatan::className(), 'targetAttribute' => ['kategori_kegiatan_id' => 'id']],
            [['kelompok_bidang_id'], 'exist', 'skipOnError' => true, 'targetClass' => KelompokBidang::className(), 'targetAttribute' => ['kelompok_bidang_id' => 'id']],
            [['skim_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SkimKegiatan::className(), 'targetAttribute' => ['skim_kegiatan_id' => 'id']],
            [['komponen_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KomponenKegiatan::className(), 'targetAttribute' => ['komponen_kegiatan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'Niy',
            'judul_penelitian_pengabdian' => 'Judul Penelitian Pengabdian',
            'nama_tahun_ajaran' => 'Nama Tahun Ajaran',
            'nama_skim' => 'Nama Skim',
            'tempat_kegiatan' => 'Tempat Kegiatan',
            'no_sk_tugas' => 'No Sk Tugas',
            'tgl_sk_tugas' => 'Tgl Sk Tugas',
            'tahun_usulan' => 'Tahun Usulan',
            'tahun_kegiatan' => 'Tahun Kegiatan',
            'tahun_dilaksanakan' => 'Tahun Dilaksanakan',
            'durasi_kegiatan' => 'Lama Kegiatan (Tahun)',
            'tahun_pelaksanaan_ke' => 'Tahun Pelaksanaan Ke',
            'jenis_penelitian_pengabdian' => 'Jenis Penelitian Pengabdian',
            'nilai' => 'Nilai',
            'sister_id' => 'Sister ID',
            'kategori_kegiatan_id' => 'Kategori Kegiatan',
            'skim_kegiatan_id' => 'Jenis SKIM',
            'kelompok_bidang_id' => 'Kelompok Bidang',
            'dana_dikti' => 'Dana Dikti',
            'dana_pt' => 'Dana PT',
            'dana_institusi_lain' => 'Dana Institusi Lain',
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
     * Gets query for [[KategoriKegiatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriKegiatan()
    {
        return $this->hasOne(KategoriKegiatan::className(), ['id' => 'kategori_kegiatan_id']);
    }

    /**
     * Gets query for [[KelompokBidang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKelompokBidang()
    {
        return $this->hasOne(KelompokBidang::className(), ['id' => 'kelompok_bidang_id']);
    }

    /**
     * Gets query for [[SkimKegiatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkimKegiatan()
    {
        return $this->hasOne(SkimKegiatan::className(), ['id' => 'skim_kegiatan_id']);
    }

    /**
     * Gets query for [[PengabdianAnggotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPengabdianAnggotas()
    {
        return $this->hasMany(PengabdianAnggota::className(), ['pengabdian_id' => 'ID']);
    }

    public function getKomponenKegiatan()
    {
        return $this->hasOne(KomponenKegiatan::className(), ['id' => 'komponen_kegiatan_id']);
    }
}
