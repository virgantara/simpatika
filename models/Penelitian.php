<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penelitian".
 *
 * @property integer $ID
 * @property string $NIY
 * @property string $judul
 * @property integer $tahun
 * @property string $status
 * @property string $sumberdana
 * @property string $f_penelitian
 */
class Penelitian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'penelitian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'judul_penelitian_pengabdian', 'tahun_usulan', 'tahun_dilaksanakan', 'tahun_pelaksanaan_ke'], 'required'],
            [['tahun_kegiatan', 'durasi_kegiatan', 'tahun_usulan', 'tahun_dilaksanakan', 'tahun_pelaksanaan_ke', 'komponen_kegiatan_id'], 'integer'],
            [['dana_institusi_lain', 'nilai', 'dana_pt'], 'number'],
            [['tgl_sk_tugas', 'updated_at', 'created_at','nama_tahun_ajaran'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['judul_penelitian_pengabdian'], 'string', 'max' => 500],
            [['status', 'sister_id', 'nama_skim', 'no_sk_tugas', 'skim_kegiatan_id', 'kelompok_bidang_id'], 'string', 'max' => 100],
            [['dana_dikti'], 'string', 'max' => 150],
            [['tempat_kegiatan'], 'string', 'max' => 255],
            [['kategori_kegiatan_id'], 'string', 'max' => 10],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
             [['kategori_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriKegiatan::className(), 'targetAttribute' => ['kategori_kegiatan_id' => 'id']],
            [['kelompok_bidang_id'], 'exist', 'skipOnError' => true, 'targetClass' => KelompokBidang::className(), 'targetAttribute' => ['kelompok_bidang_id' => 'id']],
            [['komponen_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KomponenKegiatan::className(), 'targetAttribute' => ['komponen_kegiatan_id' => 'id']],
            [['skim_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SkimKegiatan::className(), 'targetAttribute' => ['skim_kegiatan_id' => 'id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'Niy',
            'judul_penelitian_pengabdian' => 'Judul Penelitian Pengabdian',
            'tahun_kegiatan' => 'Tahun Kegiatan',
            'status' => 'Status',
            'dana_dikti' => 'Dana DIKTI',
            'dana_institusi_lain' => 'Dana Institusi Lain',
            'nilai' => 'Nilai',
            'sister_id' => 'Sister ID',
            'nama_skim' => 'Nama Skim',
            'durasi_kegiatan' => 'Lama Kegiatan (Tahun)',
            'tempat_kegiatan' => 'Tempat Kegiatan',
            'dana_pt' => 'Dana PT',
            'tahun_usulan' => 'Tahun Usulan',
            'tahun_dilaksanakan' => 'Tahun Dilaksanakan',
            'tahun_pelaksanaan_ke' => 'Tahun Pelaksanaan Ke',
            'no_sk_tugas' => 'No Sk Tugas',
            'tgl_sk_tugas' => 'Tgl Sk Tugas',
            'kategori_kegiatan_id' => 'Kategori Kegiatan',
            'skim_kegiatan_id' => 'Jenis SKIM',
            'kelompok_bidang_id' => 'Kelompok Bidang',
            'komponen_kegiatan_id' => 'Komponen Kegiatan',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'namanya' => 'Nama',
            
        ];
    }

    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
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
    
    public function getPenelitianDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getPenelitianData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }

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

}
