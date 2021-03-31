<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengajaran".
 *
 * @property integer $ID
 * @property string $NIY
 * @property string $matkul
 * @property string $program_pendidikan
 * @property string $jurusan
 * @property string $institusi
 * @property string $program
 * @property integer $tahun_awal
 * @property integer $tahun_akhir
 * @property string $f_penugasan
 */
class Pengajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    public static function tableName()
    {
        return 'pengajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'matkul', 'jurusan', 'kode_mk','jam','hari','kelas','sks','tahun_akademik','jadwal_id'], 'required'],
            [['matkul'], 'string'],
           
            [['NIY'], 'string', 'max' => 15],
            [['bukti','komponen_id','sks_bkd'], 'safe'],
            [['program_pendidikan', 'jurusan', 'institusi', 'program','ver'], 'string', 'max' => 50],
            [['f_penugasan','namanya'], 'string', 'max' => 200],
            [['f_penugasan'], 'file','extensions'=>'pdf','maxSize' => 1024 * 1024 * 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'NIY',
            'namanya' => 'Nama',
            'matkul' => 'Matkul',
            'program_pendidikan' => 'Program Pendidikan',
            'jurusan' => 'Prodi',
            'institusi' => 'Institusi',
            'program' => 'Program',
            'tanggal_awal' => 'Tahun Mulai',
            'tanggal_akhir' => 'Tahun Berakhir',
            'f_penugasan' => 'Bukti Penugasan',
            'ver' => 'Status Verifikasi',
        ];
    }
    public function getPengajaranDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
    public function getPengajaranData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
