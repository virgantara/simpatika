<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jabatan_fungsional".
 *
 * @property int $id
 * @property string|null $sister_id
 * @property string $NIY
 * @property string|null $sk_jabatan_fungsional
 * @property string|null $jabatan_fungsional
 * @property string|null $terhitung_mulai_tanggal_jabatan_fungsional
 * @property float|null $angka_kredit
 * @property string|null $kelebihan_pengajaran
 * @property string|null $kelebihan_penelitian
 * @property string|null $kelebihan_pengabdian_masyarakat
 * @property string|null $kelebihan_kegiatan_penunjang
 * @property int|null $id_jabfung
 */
class JabatanFungsional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jabatan_fungsional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY'], 'required'],
            [['terhitung_mulai_tanggal_jabatan_fungsional'], 'safe'],
            [['angka_kredit'], 'number'],
            [['id_jabfung'], 'integer'],
            [['sister_id', 'jabatan_fungsional', 'kelebihan_pengajaran', 'kelebihan_penelitian', 'kelebihan_pengabdian_masyarakat', 'kelebihan_kegiatan_penunjang'], 'string', 'max' => 100],
            [['NIY'], 'string', 'max' => 15],
            [['sk_jabatan_fungsional'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sister_id' => 'Sister ID',
            'NIY' => 'Niy',
            'sk_jabatan_fungsional' => 'Sk Jabatan Fungsional',
            'jabatan_fungsional' => 'Jabatan Fungsional',
            'terhitung_mulai_tanggal_jabatan_fungsional' => 'Terhitung Mulai Tanggal Jabatan Fungsional',
            'angka_kredit' => 'Angka Kredit',
            'kelebihan_pengajaran' => 'Kelebihan Pengajaran',
            'kelebihan_penelitian' => 'Kelebihan Penelitian',
            'kelebihan_pengabdian_masyarakat' => 'Kelebihan Pengabdian Masyarakat',
            'kelebihan_kegiatan_penunjang' => 'Kelebihan Kegiatan Penunjang',
            'id_jabfung' => 'Id Jabfung',
        ];
    }
}
