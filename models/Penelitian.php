<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penelitian".
 *
 * @property int $ID
 * @property string $NIY
 * @property string $judul_penelitian_pengabdian
 * @property int|null $tahun_kegiatan
 * @property string|null $status
 * @property string|null $dana_dikti
 * @property float|null $dana_institusi_lain
 * @property float|null $nilai
 * @property string|null $sister_id
 * @property string|null $nama_skim
 * @property int|null $durasi_kegiatan
 * @property string|null $tempat_kegiatan
 * @property float|null $dana_pt
 * @property int $tahun_usulan
 * @property string|null $nama_tahun_ajaran
 * @property int $tahun_dilaksanakan
 * @property int $tahun_pelaksanaan_ke
 * @property string|null $no_sk_tugas
 * @property string|null $tgl_sk_tugas
 * @property string|null $kategori_kegiatan_id
 * @property string|null $skim_kegiatan_id
 * @property string|null $kelompok_bidang_id
 * @property int|null $komponen_kegiatan_id
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property User $nIY
 * @property KategoriKegiatan $kategoriKegiatan
 * @property KelompokBidang $kelompokBidang
 * @property KomponenKegiatan $komponenKegiatan
 * @property SkimKegiatan $skimKegiatan
 * @property PenelitianAnggota[] $penelitianAnggotas
 * @property User[] $nIYs
 */
class Penelitian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penelitian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul_penelitian_pengabdian', 'tahun_usulan', 'tahun_dilaksanakan', 'tahun_pelaksanaan_ke'], 'required'],
            [['tahun_kegiatan', 'durasi_kegiatan', 'tahun_usulan', 'tahun_dilaksanakan', 'tahun_pelaksanaan_ke', 'komponen_kegiatan_id'], 'integer'],
            [['dana_institusi_lain', 'nilai', 'dana_pt'], 'number'],
            [['tgl_sk_tugas', 'updated_at', 'created_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['judul_penelitian_pengabdian'], 'string', 'max' => 500],
            [['status', 'sister_id', 'nama_skim', 'no_sk_tugas', 'skim_kegiatan_id', 'kelompok_bidang_id'], 'string', 'max' => 100],
            [['dana_dikti'], 'string', 'max' => 150],
            [['tempat_kegiatan'], 'string', 'max' => 255],
            [['nama_tahun_ajaran', 'kategori_kegiatan_id'], 'string', 'max' => 10],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['kategori_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriKegiatan::className(), 'targetAttribute' => ['kategori_kegiatan_id' => 'id']],
            [['kelompok_bidang_id'], 'exist', 'skipOnError' => true, 'targetClass' => KelompokBidang::className(), 'targetAttribute' => ['kelompok_bidang_id' => 'id']],
            [['komponen_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KomponenKegiatan::className(), 'targetAttribute' => ['komponen_kegiatan_id' => 'id']],
            [['skim_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SkimKegiatan::className(), 'targetAttribute' => ['skim_kegiatan_id' => 'id']],
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
            'tahun_kegiatan' => 'Tahun Kegiatan',
            'status' => 'Status',
            'dana_dikti' => 'Dana Dikti',
            'dana_institusi_lain' => 'Dana Institusi Lain',
            'nilai' => 'Nilai',
            'sister_id' => 'Sister ID',
            'nama_skim' => 'Nama Skim',
            'durasi_kegiatan' => 'Durasi Kegiatan',
            'tempat_kegiatan' => 'Tempat Kegiatan',
            'dana_pt' => 'Dana Pt',
            'tahun_usulan' => 'Tahun Usulan',
            'nama_tahun_ajaran' => 'Nama Tahun Ajaran',
            'tahun_dilaksanakan' => 'Tahun Dilaksanakan',
            'tahun_pelaksanaan_ke' => 'Tahun Pelaksanaan Ke',
            'no_sk_tugas' => 'No Sk Tugas',
            'tgl_sk_tugas' => 'Tgl Sk Tugas',
            'kategori_kegiatan_id' => 'Kategori Kegiatan ID',
            'skim_kegiatan_id' => 'Skim Kegiatan ID',
            'kelompok_bidang_id' => 'Kelompok Bidang ID',
            'komponen_kegiatan_id' => 'Komponen Kegiatan ID',
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
     * Gets query for [[KomponenKegiatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKomponenKegiatan()
    {
        return $this->hasOne(KomponenKegiatan::className(), ['id' => 'komponen_kegiatan_id']);
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
     * Gets query for [[PenelitianAnggotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenelitianAnggotas()
    {
        return $this->hasMany(PenelitianAnggota::className(), ['penelitian_id' => 'ID']);
    }

    /**
     * Gets query for [[NIYs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNIYs()
    {
        return $this->hasMany(User::className(), ['NIY' => 'NIY'])->viaTable('penelitian_anggota', ['penelitian_id' => 'ID']);
    }
}
