<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengelola_jurnal".
 *
 * @property int $id
 * @property string $peran_dalam_kegiatan
 * @property string|null $no_sk_tugas
 * @property string|null $apakah_masih_aktif
 * @property string|null $tgl_sk_tugas
 * @property string|null $tgl_sk_tugas_selesai
 * @property string|null $nama_media_publikasi
 * @property string|null $kategori_kegiatan_id
 * @property int|null $komponen_kegiatan_id
 * @property string|null $NIY
 * @property string|null $sister_id
 * @property float|null $sks_bkd
 * @property string|null $is_claimed
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property KategoriKegiatan $kategoriKegiatan
 * @property KomponenKegiatan $komponenKegiatan
 * @property User $nIY
 */
class PengelolaJurnal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengelola_jurnal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['peran_dalam_kegiatan'], 'required'],
            [['tgl_sk_tugas', 'tgl_sk_tugas_selesai', 'updated_at', 'created_at'], 'safe'],
            [['komponen_kegiatan_id'], 'integer'],
            [['sks_bkd'], 'number'],
            [['peran_dalam_kegiatan', 'nama_media_publikasi'], 'string', 'max' => 255],
            [['no_sk_tugas', 'sister_id'], 'string', 'max' => 100],
            [['apakah_masih_aktif', 'is_claimed'], 'string', 'max' => 1],
            [['kategori_kegiatan_id'], 'string', 'max' => 10],
            [['NIY'], 'string', 'max' => 15],
            [['kategori_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriKegiatan::className(), 'targetAttribute' => ['kategori_kegiatan_id' => 'id']],
            [['komponen_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KomponenKegiatan::className(), 'targetAttribute' => ['komponen_kegiatan_id' => 'id']],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'peran_dalam_kegiatan' => 'Peran Dalam Kegiatan',
            'no_sk_tugas' => 'No Sk Tugas',
            'apakah_masih_aktif' => 'Apakah Masih Aktif',
            'tgl_sk_tugas' => 'Tgl Sk Tugas',
            'tgl_sk_tugas_selesai' => 'Tgl Sk Tugas Selesai',
            'nama_media_publikasi' => 'Nama Media Publikasi',
            'kategori_kegiatan_id' => 'Kategori Kegiatan ID',
            'komponen_kegiatan_id' => 'Komponen Kegiatan ID',
            'NIY' => 'Niy',
            'sister_id' => 'Sister ID',
            'sks_bkd' => 'Sks Bkd',
            'is_claimed' => 'Is Claimed',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
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
     * Gets query for [[KomponenKegiatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKomponenKegiatan()
    {
        return $this->hasOne(KomponenKegiatan::className(), ['id' => 'komponen_kegiatan_id']);
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
}
