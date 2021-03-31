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
 * @property int|null $durasi_kegiatan
 * @property string|null $jenis_penelitian_pengabdian
 * @property float|null $nilai
 * @property string|null $sister_id
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property User $nIY
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
            [['NIY', 'judul_penelitian_pengabdian'], 'required'],
            [['durasi_kegiatan'], 'integer'],
            [['nilai'], 'number'],
            [['updated_at', 'created_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['judul_penelitian_pengabdian'], 'string', 'max' => 500],
            [['nama_tahun_ajaran', 'sister_id'], 'string', 'max' => 100],
            [['nama_skim'], 'string', 'max' => 255],
            [['jenis_penelitian_pengabdian'], 'string', 'max' => 10],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
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
            'durasi_kegiatan' => 'Durasi Kegiatan',
            'jenis_penelitian_pengabdian' => 'Jenis Penelitian Pengabdian',
            'nilai' => 'Nilai',
            'sister_id' => 'Sister ID',
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
     * Gets query for [[PengabdianAnggotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPengabdianAnggotas()
    {
        return $this->hasMany(PengabdianAnggota::className(), ['pengabdian_id' => 'ID']);
    }
}
