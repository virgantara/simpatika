<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "simak_jadwal_temp".
 *
 * @property int $id
 * @property string $hari
 * @property int|null $jam_ke
 * @property string $jam
 * @property string|null $jam_mulai
 * @property string|null $jam_selesai
 * @property string $kode_mk
 * @property string|null $nama_mk
 * @property string $kode_dosen
 * @property string|null $nama_dosen
 * @property string|null $kode_pengampu_nidn
 * @property string|null $nama_dosen_bernidn
 * @property string $semester
 * @property string $kelas
 * @property string|null $fakultas
 * @property string|null $nama_fakultas
 * @property string|null $prodi
 * @property string|null $nama_prodi
 * @property string $kd_ruangan
 * @property string|null $tahun_akademik
 * @property int|null $kuota_kelas
 * @property string $kampus
 * @property string|null $presensi
 * @property string|null $materi
 * @property string|null $bobot_formatif
 * @property string|null $bobot_uts
 * @property string|null $bobot_uas
 * @property string|null $bobot_harian1
 * @property string|null $bobot_harian
 * @property int|null $bentrok
 * @property string|null $bentrok_with
 * @property string $created
 * @property string $modified
 */
class SimakJadwalTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'simak_jadwal_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hari', 'jam', 'kode_mk', 'kode_dosen', 'semester', 'kelas', 'kd_ruangan', 'kampus'], 'required'],
            [['jam_ke', 'kuota_kelas', 'bentrok'], 'integer'],
            [['jam_mulai', 'jam_selesai', 'created', 'modified'], 'safe'],
            [['presensi'], 'string'],
            [['hari', 'bobot_formatif', 'bobot_uts', 'bobot_uas'], 'string', 'max' => 30],
            [['jam', 'kode_mk', 'kode_dosen', 'kd_ruangan'], 'string', 'max' => 20],
            [['nama_mk', 'nama_dosen', 'nama_dosen_bernidn', 'nama_fakultas', 'nama_prodi', 'materi', 'bentrok_with'], 'string', 'max' => 255],
            [['kode_pengampu_nidn'], 'string', 'max' => 100],
            [['semester'], 'string', 'max' => 5],
            [['kelas', 'prodi', 'tahun_akademik'], 'string', 'max' => 10],
            [['fakultas'], 'string', 'max' => 7],
            [['kampus'], 'string', 'max' => 2],
            [['bobot_harian1', 'bobot_harian'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hari' => 'Hari',
            'jam_ke' => 'Jam Ke',
            'jam' => 'Jam',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'kode_mk' => 'Kode Mk',
            'nama_mk' => 'Nama Mk',
            'kode_dosen' => 'Kode Dosen',
            'nama_dosen' => 'Nama Dosen',
            'kode_pengampu_nidn' => 'Kode Pengampu Nidn',
            'nama_dosen_bernidn' => 'Nama Dosen Bernidn',
            'semester' => 'Semester',
            'kelas' => 'Kelas',
            'fakultas' => 'Fakultas',
            'nama_fakultas' => 'Nama Fakultas',
            'prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi',
            'kd_ruangan' => 'Kd Ruangan',
            'tahun_akademik' => 'Tahun Akademik',
            'kuota_kelas' => 'Kuota Kelas',
            'kampus' => 'Kampus',
            'presensi' => 'Presensi',
            'materi' => 'Materi',
            'bobot_formatif' => 'Bobot Formatif',
            'bobot_uts' => 'Bobot Uts',
            'bobot_uas' => 'Bobot Uas',
            'bobot_harian1' => 'Bobot Harian1',
            'bobot_harian' => 'Bobot Harian',
            'bentrok' => 'Bentrok',
            'bentrok_with' => 'Bentrok With',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
