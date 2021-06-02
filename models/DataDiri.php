<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_diri".
 *
 * @property integer $ID
 * @property string $NIY
 
 * @property string $nama
 * @property string $gender
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $status_kawin
 * @property string $agama
 * @property string $pangkat
 * @property string $jabatan_fungsional
 * @property string $perguruan_tinggi
 * @property string $alamat_kampus
 * @property string $telp_kampus
 * @property string $fax_kampus
 * @property string $alamat_rumah
 * @property string $telp_hp
 * @property string $f_foto
 */
class DataDiri extends \yii\db\ActiveRecord
{    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_diri';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'nama', 'gender', 'tempat_lahir', 'tanggal_lahir', 'status_kawin', 'agama', 'pangkat', 'jabatan_fungsional','alamat_rumah', 'telp_hp','status_dosen','kode_unik', 'nik','kampus'], 'required'],
            [['gender', 'status_kawin', 'alamat_kampus', 'alamat_rumah','status_dosen','jenjang_kode'], 'string'],
            [['permalink'], 'unique'],
            [['kode_unik','tanggal_lahir','bidang_ilmu_id','permalink','expertise','kepakaran_id','kode_feeder','id_reg_ptk','tugas_dosen_id','telegram_username','gelar_depan','gelar_belakang','no_sertifikat_pendidik'], 'safe'],
            [['NIY', 'telp_kampus', 'fax_kampus', 'telp_hp'], 'string', 'max' => 15],
            [['nama', 'perguruan_tinggi'], 'string', 'max' => 50],
            [['tempat_lahir'], 'string', 'max' => 30],
            [['agama','NIDN'], 'string', 'max' => 20],
            
            [['f_foto'], 'string', 'max' => 200],
            [['f_foto'], 'file', 'extensions' => 'png,jpg,jpeg','maxSize' => 1024 * 1024],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['jenjang_kode'], 'exist', 'skipOnError' => true, 'targetClass' => MJenjangPendidikan::className(), 'targetAttribute' => ['jenjang_kode' => 'kode']],
            [['pangkat'], 'exist', 'skipOnError' => true, 'targetClass' => MPangkat::className(), 'targetAttribute' => ['pangkat' => 'id']],
            [['jabatan_fungsional'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatanAkademik::className(), 'targetAttribute' => ['jabatan_fungsional' => 'id']],
            [['bidang_ilmu_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidangIlmu::className(), 'targetAttribute' => ['bidang_ilmu_id' => 'kode']],
            [['kepakaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidangKepakaran::className(), 'targetAttribute' => ['kepakaran_id' => 'id']],
            [['tugas_dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => TugasDosen::className(), 'targetAttribute' => ['tugas_dosen_id' => 'id']],
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
            'tugas_dosen_id' => 'Tugas Dosen',
            'NIDN' => 'NIDN',
            'nik' => 'NIK/No KTP',
            'nama' => 'Nama',
            'no_sertifikat_pendidik' => 'No Sertifikat Pendidik (SERDOS)',
            'bidang_ilmu_id' => 'Bidang Ilmu',
            'gender' => 'JK',
            'kode_unik' => 'Kode Unik',
            'status_dosen' => 'Status Dosen',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'status_kawin' => 'Status Kawin',
            'agama' => 'Agama',
            'pangkat' => 'Golongan Kepangkatan',
            'jabatan_fungsional' => 'Jabatan Fungsional',
            'perguruan_tinggi' => 'Perguruan Tinggi',
            'alamat_kampus' => 'Alamat Kampus',
            'telp_kampus' => 'Telp Kampus',
            'fax_kampus' => 'Fax Kampus',
            'alamat_rumah' => 'Alamat Rumah',
            'telp_hp' => 'Telp Hp',
            'f_foto' => 'Foto',
            'namaJabfung' => 'Jab. Fung.',
            'namaPangkat' => 'Pangkat',
            'jenjang_kode' => 'Pendidikan Terakhir'
        ];
    }

    public function getKepakaran()
    {
        return $this->hasOne(BidangKepakaran::className(), ['id' => 'kepakaran_id']);
    }

    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }
    
     public function getDataBuku(){
        return $this->hasMany(Buku::className(),['NIY'=>'NIY']);
    }
    
    public function getDataJabatan(){
        return $this->hasMany(Jabatan::className(),['NIY'=>'NIY']);
    }
    
    public function getDataDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
    
    public function getDataKegiatan(){
        return $this->hasMany(Kegiatan::className(),['NIY'=>'NIY']);
    }
    
    public function getDataKonferensi(){
        return $this->hasMany(Konferensi::className(),['NIY'=>'NIY']);
    }
    
    public function getDataMakalah(){
        return $this->hasMany(Makalah::className(),['NIY'=>'NIY']);
    }
    
    public function getDataOrganisasi(){
        return $this->hasMany(Organisasi::className(),['NIY'=>'NIY']);
    }
    
    public function getDataPelatihan(){
        return $this->hasMany(Pelatihan::className(),['NIY'=>'NIY']);
    }
    
    public function getDataPendidikan(){
        return $this->hasMany(Pendidikan::className(),['NIY'=>'NIY']);
    }
    
    public function getDataPenelitian(){
        return $this->hasMany(Penelitian::className(),['NIY'=>'NIY']);
    }
    
    public function getDataPengabdian(){
        return $this->hasMany(Pengabdian::className(),['NIY'=>'NIY']);
    }
    
    public function getDataPengajaran(){
        return $this->hasMany(Pengajaran::className(),['NIY'=>'NIY']);
    }
    
    public function getDataPenghargaan(){
        return $this->hasMany(Penghargaan::className(),['NIY'=>'NIY']);
    }
    
    public function getDataProdukajar(){
        return $this->hasMany(ProdukAjar::className(),['NIY'=>'NIY']);
    }
    
    public function getDataResensi(){
        return $this->hasMany(Resensi::className(),['NIY'=>'NIY']);
    }
    
    public static function getListDataDosen()
    {
       
        $query = DataDiri::find();
        $query->joinWith(['nIY as usr']);
        $query->where(['usr.status_admin'=>'user']);
        $query->orderBy(['nama'=>'ASC']);
        $list = $query->all();
        $list=\yii\helpers\ArrayHelper::map($list,'NIY',function($data){
            return $data->NIY.' '.$data->nama;
        });

        return $list;
    }

    public function getNamaPangkat(){
        return $this->pangkat0->nama.' Gol. '.$this->pangkat0->golongan;
    }

    public function getNamaJabfung(){
        return $this->jabatanFungsional->nama;
    }

    public function getKodeJabfung(){
        return $this->jabatanFungsional->kode;
    }

    public function getPangkat0()
    {
        return $this->hasOne(MPangkat::className(), ['id' => 'pangkat']);
    }

    public function getBidangIlmu()
    {
        return $this->hasOne(BidangIlmu::className(), ['kode' => 'bidang_ilmu_id']);
    }

    public function getJenjangKode()
    {
        return $this->hasOne(MJenjangPendidikan::className(), ['kode' => 'jenjang_kode']);
    }

    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {

            $this->tanggal_lahir = date('Y-m-d',strtotime($this->tanggal_lahir));

            return true;
        } else {
            return false;
        }

        
    }

    public function afterFind(){
        parent::afterFind();

        $this->tanggal_lahir = date('d-m-Y',strtotime($this->tanggal_lahir));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatanFungsional()
    {
        return $this->hasOne(MJabatanAkademik::className(), ['id' => 'jabatan_fungsional']);
    }

    public static function countData($jenjang, $pangkat,$status = 1){
        $jf = MJabatanAkademik::find()->where(['kode'=>$pangkat])->one();
        $query = DataDiri::find();
        $query->joinWith(['nIY as u']);
        $query->where([
            'jenjang_kode' => $jenjang,
            'jabatan_fungsional' => $jf->id,
            'status_dosen' => $status,
            'u.status' => 'aktif'
        ]);

        $query->andWhere(['not',[self::tableName().'.nama'=>null]]);
        // $query->andWhere('LENGTH(NIDN) > 9');
        $total = $query->count();

        return $total;
    }

    public function getTugasDosen()
    {
        return $this->hasOne(TugasDosen::className(), ['id' => 'tugas_dosen_id']);
    }
}
