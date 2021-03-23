<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\Prodi;

/**
 * This is the model class for table "user".
 *
 * @property integer $ID
 * @property string $NIY
 * @property string $status_admin
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dosen extends \yii\db\ActiveRecord
{
    public $password;
    public $total_penelitian;
    public $namanya;
    public $gendernya;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    
     public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'password_hash', 'email','id_prod'], 'required'],
            [['status_admin','namanya','gendernya'], 'string'],
            [['status', 'created_at', 'updated_at','id_prod','total_penelitian'], 'integer'],
            [['NIY'], 'string', 'max' => 15],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['NIY'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
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
            'nidnDosen' => 'NIDN',
            'id_prod' => 'Program Studi',
            'status_admin' => 'Status Admin',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'namanya' => 'Nama',
            'gendernya' => 'Gender',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password' => 'Password',
            'total_penelitian' => 'Penelitian'
        ];
    }
    
     public function getProdiDosen(){
        return $this->hasOne(Prodi::className(),['ID'=>'id_prod']);
    }
    
    public function getDosenAssignment(){
        return $this->hasMany(Assignment::className(),['NIY'=>'NIY']);
    }
    
     public function getDosenBuku(){
        return $this->hasMany(Buku::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenJabatan(){
        return $this->hasMany(Jabatan::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenKegiatan(){
        return $this->hasMany(Kegiatan::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenKonferensi(){
        return $this->hasMany(Konferensi::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenMakalah(){
        return $this->hasMany(Makalah::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenOrganisasi(){
        return $this->hasMany(Organisasi::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenPelatihan(){
        return $this->hasMany(Pelatihan::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenPendidikan(){
        return $this->hasMany(Pendidikan::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenPenelitian(){
        return $this->hasMany(Penelitian::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenPengabdian(){
        return $this->hasMany(Pengabdian::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenPengajaran(){
        return $this->hasMany(Pengajaran::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenPenghargaan(){
        return $this->hasMany(Penghargaan::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenProdukajar(){
        return $this->hasMany(ProdukAjar::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenResensi(){
        return $this->hasMany(Resensi::className(),['NIY'=>'NIY']);
    }
    
    public function getDosenData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }

    public function getNidnDosen(){
        return $this->dosenData->NIDN;
    }
    
    public function getJumlahPenelitian()
    {
    return $this->getDosenPenelitian()->count();
    }
    
    public function getJumlahPenghargaan()
    {
    return $this->getDosenPenghargaan()->count();
    }
    
    public function getJumlahPengabdian()
    {
    return $this->getDosenPengabdian()->count();
    }
    
    public function getJumlahKegiatan()
    {
    return $this->getDosenKegiatan()->count();
    }
    
//    public function getTotalPenelitian($total_penelitian)
//    {
//    return $total_penelitian = $total_penelitian + $this->getJumlahPenelitian();
//    }
}
