<?php

/**
 * This is the model class for table "{{mastermahasiswa}}".
 *
 * The followings are the available columns in table '{{mastermahasiswa}}':
 * @property integer $id
 * @property string $kode_pt
 * @property string $kode_fakultas
 * @property string $kode_prodi
 * @property string $kode_jenjang_studi
 * @property string $nim_mhs
 * @property string $nama_mahasiswa
 * @property string $tempat_lahir
 * @property string $tgl_lahir
 * @property string $jenis_kelamin
 * @property string $tahun_masuk
 * @property string $semester_awal
 * @property string $batas_studi
 * @property string $asal_propinsi
 * @property string $tgl_masuk
 * @property string $tgl_lulus
 * @property string $status_aktivitas
 * @property string $status_awal
 * @property string $jml_sks_diakui
 * @property string $nim_asal
 * @property string $asal_pt
 * @property string $nama_asal_pt
 * @property string $asal_jenjang_studi
 * @property string $asal_prodi
 * @property string $kode_biaya_studi
 * @property string $kode_pekerjaan
 * @property string $tempat_kerja
 * @property string $kode_pt_kerja
 * @property string $kode_ps_kerja
 * @property string $nip_promotor
 * @property string $nip_co_promotor1
 * @property string $nip_co_promotor2
 * @property string $nip_co_promotor3
 * @property string $nip_co_promotor4
 * @property string $photo_mahasiswa
 * @property string $semester
 * @property string $keterangan
 * @property integer $status_bayar
 * @property string $telepon
 * @property string $hp
 * @property string $email
 * @property string $alamat
 * @property string $berat
 * @property string $tinggi
 * @property string $ktp
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property string $kode_pos
 * @property string $desa
 * @property string $kecamatan
 * @property string $kecamatan_feeder
 * @property string $jenis_tinggal
 * @property string $penerima_kps
 * @property string $no_kps
 * @property string $provinsi
 * @property string $kabupaten
 * @property string $status_warga
 * @property string $warga_negara
 * @property string $warga_negara_feeder
 * @property string $status_sipil
 * @property string $agama
 * @property string $gol_darah
 * @property string $masuk_kelas
 * @property string $tgl_sk_yudisium
 * @property integer $status_mahasiswa
 * @property string $kampus
 * @property string $jur_thn_smta
 * @property integer $is_synced
 * @property string $kode_pd
 * @property string $va_code
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property MahasiswaOrtu[] $mahasiswaOrtus
 * @property Masterprogramstudi $kodeProdi
 */
class Mastermahasiswa extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;
	public $uploadedFile;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mastermahasiswa}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nim_mhs, nama_mahasiswa', 'required'),
			array('status_bayar, status_mahasiswa, is_synced', 'numerical', 'integerOnly'=>true),
			array('kode_pt, asal_prodi, kode_pos', 'length', 'max'=>6),
			array('kode_fakultas, kode_prodi, kode_jenjang_studi, jenis_kelamin, semester_awal, batas_studi, status_awal, asal_jenjang_studi, semester, rt, rw', 'length', 'max'=>5),
			array('nim_mhs, nama_asal_pt, telepon, hp', 'length', 'max'=>25),
			array('nama_mahasiswa, dusun, desa, kecamatan, warga_negara, status_sipil, jur_thn_smta, kode_pd', 'length', 'max'=>100),
			array('tempat_lahir, asal_propinsi, status_aktivitas, email, status_warga', 'length', 'max'=>50),
			array('tahun_masuk', 'length', 'max'=>4),
			array('jml_sks_diakui', 'length', 'max'=>45),
			array('nim_asal, kode_biaya_studi, kode_pekerjaan, tempat_kerja, kode_pt_kerja', 'length', 'max'=>55),
			array('asal_pt, ktp', 'length', 'max'=>30),
			array('kode_ps_kerja, nip_promotor, nip_co_promotor4', 'length', 'max'=>44),
			array('nip_co_promotor1', 'length', 'max'=>11),
			array('nip_co_promotor2', 'length', 'max'=>12),
			array('nip_co_promotor3', 'length', 'max'=>33),
			array('photo_mahasiswa, alamat, kecamatan_feeder, provinsi, kabupaten, warga_negara_feeder', 'length', 'max'=>255),
			array('berat, tinggi', 'length', 'max'=>3),
			array('jenis_tinggal, no_kps, agama, va_code', 'length', 'max'=>20),
			array('penerima_kps, masuk_kelas', 'length', 'max'=>1),
			array('gol_darah, kampus', 'length', 'max'=>2),
			array('tgl_lahir, tgl_masuk, tgl_lulus, keterangan, tgl_sk_yudisium, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_pt, kode_fakultas, kode_prodi, kode_jenjang_studi, nim_mhs, nama_mahasiswa, tempat_lahir, tgl_lahir, jenis_kelamin, tahun_masuk, semester_awal, batas_studi, asal_propinsi, tgl_masuk, tgl_lulus, status_aktivitas, status_awal, jml_sks_diakui, nim_asal, asal_pt, nama_asal_pt, asal_jenjang_studi, asal_prodi, kode_biaya_studi, kode_pekerjaan, tempat_kerja, kode_pt_kerja, kode_ps_kerja, nip_promotor, nip_co_promotor1, nip_co_promotor2, nip_co_promotor3, nip_co_promotor4, photo_mahasiswa, semester, keterangan, status_bayar, telepon, hp, email, alamat, berat, tinggi, ktp, rt, rw, dusun, kode_pos, desa, kecamatan, kecamatan_feeder, jenis_tinggal, penerima_kps, no_kps, provinsi, kabupaten, status_warga, warga_negara, warga_negara_feeder, status_sipil, agama, gol_darah, masuk_kelas, tgl_sk_yudisium, status_mahasiswa, kampus, jur_thn_smta, is_synced, kode_pd, va_code, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ortus' => array(self::HAS_MANY, 'MahasiswaOrtu', 'nim'),
			'kodeProdi' => array(self::BELONGS_TO, 'Masterprogramstudi', 'kode_prodi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_pt' => 'Kode Pt',
			'kode_fakultas' => 'Kode Fakultas',
			'kode_prodi' => 'Kode Prodi',
			'kode_jenjang_studi' => 'Kode Jenjang Studi',
			'nim_mhs' => 'Nim Mhs',
			'nama_mahasiswa' => 'Nama Mahasiswa',
			'tempat_lahir' => 'Tempat Lahir',
			'tgl_lahir' => 'Tgl Lahir',
			'jenis_kelamin' => 'Jenis Kelamin',
			'tahun_masuk' => 'Tahun Masuk',
			'semester_awal' => 'Semester Awal',
			'batas_studi' => 'Batas Studi',
			'asal_propinsi' => 'Asal Propinsi',
			'tgl_masuk' => 'Tgl Masuk',
			'tgl_lulus' => 'Tgl Lulus',
			'status_aktivitas' => 'Status Aktivitas',
			'status_awal' => 'Status Awal',
			'jml_sks_diakui' => 'Jml Sks Diakui',
			'nim_asal' => 'Nim Asal',
			'asal_pt' => 'Asal Pt',
			'nama_asal_pt' => 'Nama Asal Pt',
			'asal_jenjang_studi' => 'Asal Jenjang Studi',
			'asal_prodi' => 'Asal Prodi',
			'kode_biaya_studi' => 'Kode Biaya Studi',
			'kode_pekerjaan' => 'Kode Pekerjaan',
			'tempat_kerja' => 'Tempat Kerja',
			'kode_pt_kerja' => 'Kode Pt Kerja',
			'kode_ps_kerja' => 'Kode Ps Kerja',
			'nip_promotor' => 'Nip Promotor',
			'nip_co_promotor1' => 'Nip Co Promotor1',
			'nip_co_promotor2' => 'Nip Co Promotor2',
			'nip_co_promotor3' => 'Nip Co Promotor3',
			'nip_co_promotor4' => 'Nip Co Promotor4',
			'photo_mahasiswa' => 'Photo Mahasiswa',
			'semester' => 'Semester',
			'keterangan' => 'Keterangan',
			'status_bayar' => 'Status Bayar',
			'telepon' => 'Telepon',
			'hp' => 'Hp',
			'email' => 'Email',
			'alamat' => 'Alamat',
			'berat' => 'Berat',
			'tinggi' => 'Tinggi',
			'ktp' => 'Ktp',
			'rt' => 'Rt',
			'rw' => 'Rw',
			'dusun' => 'Dusun',
			'kode_pos' => 'Kode Pos',
			'desa' => 'Desa',
			'kecamatan' => 'Kecamatan',
			'kecamatan_feeder' => 'Kecamatan Feeder',
			'jenis_tinggal' => 'Jenis Tinggal',
			'penerima_kps' => 'Penerima Kps',
			'no_kps' => 'No Kps',
			'provinsi' => 'Provinsi',
			'kabupaten' => 'Kabupaten',
			'status_warga' => 'Status Warga',
			'warga_negara' => 'Warga Negara',
			'warga_negara_feeder' => 'Warga Negara Feeder',
			'status_sipil' => 'Status Sipil',
			'agama' => 'Agama',
			'gol_darah' => 'Gol Darah',
			'masuk_kelas' => 'Masuk Kelas',
			'tgl_sk_yudisium' => 'Tgl Sk Yudisium',
			'status_mahasiswa' => 'Status Mahasiswa',
			'kampus' => 'Kampus',
			'jur_thn_smta' => 'Jur Thn Smta',
			'is_synced' => 'Is Synced',
			'kode_pd' => 'Kode Pd',
			'va_code' => 'Va Code',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sort = new CSort;

		$criteria->addSearchCondition('id',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pt',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_jenjang_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nim_mhs',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_mahasiswa',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tempat_lahir',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_lahir',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jenis_kelamin',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tahun_masuk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('semester_awal',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('batas_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('asal_propinsi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_masuk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_lulus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_aktivitas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_awal',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jml_sks_diakui',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nim_asal',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('asal_pt',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_asal_pt',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('asal_jenjang_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('asal_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_biaya_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pekerjaan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tempat_kerja',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pt_kerja',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_ps_kerja',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nip_promotor',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nip_co_promotor1',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nip_co_promotor2',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nip_co_promotor3',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nip_co_promotor4',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('photo_mahasiswa',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('semester',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('keterangan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_bayar',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('telepon',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('hp',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('email',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('alamat',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('berat',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tinggi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('ktp',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('rt',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('rw',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('dusun',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pos',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('desa',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kecamatan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kecamatan_feeder',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jenis_tinggal',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('penerima_kps',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('no_kps',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('provinsi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kabupaten',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_warga',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('warga_negara',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('warga_negara_feeder',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_sipil',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('agama',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('gol_darah',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('masuk_kelas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_sk_yudisium',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_mahasiswa',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kampus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jur_thn_smta',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('is_synced',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pd',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('va_code',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('created_at',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('updated_at',$this->SEARCH,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array(
				'pageSize'=>$this->PAGE_SIZE,

			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mastermahasiswa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
