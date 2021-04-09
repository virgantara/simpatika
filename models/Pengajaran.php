<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengajaran".
 *
 * @property int $ID
 * @property string $NIY
 * @property string|null $kode_mk
 * @property string $matkul
 * @property string|null $hari
 * @property string|null $jam
 * @property string|null $kelas
 * @property float|null $sks
 * @property int $jadwal_id
 * @property int $tahun_akademik
 * @property string|null $program_pendidikan
 * @property string|null $jurusan
 * @property string|null $institusi
 * @property string|null $program
 * @property string|null $tanggal_awal
 * @property string|null $tanggal_akhir
 * @property string|null $f_penugasan
 * @property string|null $ver
 * @property string|null $is_claimed
 * @property string|null $sister_id
 * @property int|null $komponen_id
 * @property float|null $sks_bkd
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property User $nIY
 */
class Pengajaran extends \yii\db\ActiveRecord
{

    public $namanya;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'matkul', 'jadwal_id', 'tahun_akademik'], 'required'],
            [['matkul'], 'string'],
            [['sks', 'sks_bkd'], 'number'],
            [['jadwal_id', 'tahun_akademik', 'komponen_id'], 'integer'],
            [['tanggal_awal', 'tanggal_akhir', 'updated_at', 'created_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['kode_mk'], 'string', 'max' => 255],
            [['hari', 'jam'], 'string', 'max' => 20],
            [['kelas', 'sister_id'], 'string', 'max' => 100],
            [['program_pendidikan', 'jurusan', 'institusi', 'program', 'ver'], 'string', 'max' => 50],
            [['f_penugasan'], 'string', 'max' => 200],
            [['is_claimed'], 'string', 'max' => 1],
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
            'kode_mk' => 'Kode Mk',
            'matkul' => 'Matkul',
            'hari' => 'Hari',
            'jam' => 'Jam',
            'kelas' => 'Kelas',
            'sks' => 'Sks',
            'jadwal_id' => 'Jadwal ID',
            'tahun_akademik' => 'Tahun Akademik',
            'program_pendidikan' => 'Program Pendidikan',
            'jurusan' => 'Jurusan',
            'institusi' => 'Institusi',
            'program' => 'Program',
            'tanggal_awal' => 'Tanggal Awal',
            'tanggal_akhir' => 'Tanggal Akhir',
            'f_penugasan' => 'F Penugasan',
            'ver' => 'Ver',
            'is_claimed' => 'Is Claimed',
            'sister_id' => 'Sister ID',
            'komponen_id' => 'Komponen ID',
            'sks_bkd' => 'Sks Bkd',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getPengajaranDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
    public function getPengajaranData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
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
