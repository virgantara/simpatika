<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penugasan".
 *
 * @property int $id
 * @property string|null $sister_id
 * @property string|null $NIY
 * @property string $status_pegawai
 * @property string $nama_ikatan_kerja
 * @property string $nama_jenjang_pendidikan
 * @property string $unit_kerja
 * @property string $perguruan_tinggi
 * @property string|null $terhitung_mulai_tanggal_surat_tugas
 */
class Penugasan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penugasan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_pegawai', 'nama_ikatan_kerja', 'nama_jenjang_pendidikan', 'unit_kerja', 'perguruan_tinggi'], 'required'],
            [['terhitung_mulai_tanggal_surat_tugas'], 'safe'],
            [['sister_id', 'status_pegawai', 'nama_ikatan_kerja', 'nama_jenjang_pendidikan', 'unit_kerja', 'perguruan_tinggi'], 'string', 'max' => 100],
            [['NIY'], 'string', 'max' => 15],
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
            'status_pegawai' => 'Status Pegawai',
            'nama_ikatan_kerja' => 'Nama Ikatan Kerja',
            'nama_jenjang_pendidikan' => 'Nama Jenjang Pendidikan',
            'unit_kerja' => 'Unit Kerja',
            'perguruan_tinggi' => 'Perguruan Tinggi',
            'terhitung_mulai_tanggal_surat_tugas' => 'Terhitung Mulai Tanggal Surat Tugas',
        ];
    }
}
