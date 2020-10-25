<?php

/**
 * This is the model class for table "{{masterprogramstudi}}".
 *
 * The followings are the available columns in table '{{masterprogramstudi}}':
 * @property integer $id
 * @property string $kode_fakultas
 * @property string $kode_jurusan
 * @property string $kode_prodi
 * @property string $kode_jenjang_studi
 * @property string $gelar_lulusan
 * @property string $gelar_lulusan_en
 * @property string $gelar_lulusan_short
 * @property string $nama_prodi
 * @property string $nama_prodi_en
 * @property string $semester_awal
 * @property string $no_sk_dikti
 * @property string $tgl_sk_dikti
 * @property string $tgl_akhir_sk_dikti
 * @property string $jml_sks_lulus
 * @property string $kode_status
 * @property string $tahun_semester_mulai
 * @property string $email_prodi
 * @property string $tgl_pendirian_program_studi
 * @property string $no_sk_akreditasi
 * @property string $tgl_sk_akreditasi
 * @property string $tgl_akhir_sk_akreditasi
 * @property string $kode_status_akreditasi
 * @property string $frekuensi_kurikulum
 * @property string $pelaksanaan_kurikulum
 * @property string $nidn_ketua_prodi
 * @property string $telp_ketua_prodi
 * @property string $fax_prodi
 * @property string $nama_operator
 * @property string $hp_operator
 * @property string $telepon_program_studi
 * @property string $singkatan
 * @property string $kode_feeder
 *
 * The followings are the available model relations:
 * @property Mastermahasiswa[] $mastermahasiswas
 * @property Masterfakultas $kodeFakultas
 * @property ProdiCapem[] $prodiCapems
 */
class Masterprogramstudi extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{masterprogramstudi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_fakultas, kode_prodi, kode_jenjang_studi, nama_prodi, semester_awal, no_sk_dikti, jml_sks_lulus, kode_status, tahun_semester_mulai, email_prodi, no_sk_akreditasi, kode_status_akreditasi, frekuensi_kurikulum, pelaksanaan_kurikulum, nidn_ketua_prodi, telp_ketua_prodi, fax_prodi, nama_operator, hp_operator, telepon_program_studi', 'required'),
			array('kode_fakultas, kode_jurusan, kode_jenjang_studi, semester_awal, jml_sks_lulus, tahun_semester_mulai, kode_status_akreditasi', 'length', 'max'=>5),
			array('kode_prodi', 'length', 'max'=>15),
			array('gelar_lulusan, gelar_lulusan_en, gelar_lulusan_short, nama_prodi_en, singkatan, kode_feeder', 'length', 'max'=>255),
			array('nama_prodi, no_sk_dikti, email_prodi, nama_operator', 'length', 'max'=>50),
			array('kode_status', 'length', 'max'=>1),
			array('no_sk_akreditasi, telp_ketua_prodi, fax_prodi, hp_operator, telepon_program_studi', 'length', 'max'=>25),
			array('frekuensi_kurikulum, pelaksanaan_kurikulum', 'length', 'max'=>10),
			array('nidn_ketua_prodi', 'length', 'max'=>30),
			array('tgl_sk_dikti, tgl_akhir_sk_dikti, tgl_pendirian_program_studi, tgl_sk_akreditasi, tgl_akhir_sk_akreditasi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_fakultas, kode_jurusan, kode_prodi, kode_jenjang_studi, gelar_lulusan, gelar_lulusan_en, gelar_lulusan_short, nama_prodi, nama_prodi_en, semester_awal, no_sk_dikti, tgl_sk_dikti, tgl_akhir_sk_dikti, jml_sks_lulus, kode_status, tahun_semester_mulai, email_prodi, tgl_pendirian_program_studi, no_sk_akreditasi, tgl_sk_akreditasi, tgl_akhir_sk_akreditasi, kode_status_akreditasi, frekuensi_kurikulum, pelaksanaan_kurikulum, nidn_ketua_prodi, telp_ketua_prodi, fax_prodi, nama_operator, hp_operator, telepon_program_studi, singkatan, kode_feeder', 'safe', 'on'=>'search'),
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
			'mastermahasiswas' => array(self::HAS_MANY, 'Mastermahasiswa', 'kode_prodi'),
			'kodeFakultas' => array(self::BELONGS_TO, 'Masterfakultas', 'kode_fakultas'),
			'prodiCapems' => array(self::HAS_MANY, 'ProdiCapem', 'prodi_id'),
			'masterdosens' => array(self::HAS_MANY, 'Masterdosen', 'kode_prodi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_fakultas' => 'Kode Fakultas',
			'kode_jurusan' => 'Kode Jurusan',
			'kode_prodi' => 'Kode Prodi',
			'kode_jenjang_studi' => 'Kode Jenjang Studi',
			'gelar_lulusan' => 'Gelar Lulusan',
			'gelar_lulusan_en' => 'Gelar Lulusan En',
			'gelar_lulusan_short' => 'Gelar Lulusan Short',
			'nama_prodi' => 'Nama Prodi',
			'nama_prodi_en' => 'Nama Prodi En',
			'semester_awal' => 'Semester Awal',
			'no_sk_dikti' => 'No Sk Dikti',
			'tgl_sk_dikti' => 'Tgl Sk Dikti',
			'tgl_akhir_sk_dikti' => 'Tgl Akhir Sk Dikti',
			'jml_sks_lulus' => 'Jml Sks Lulus',
			'kode_status' => 'Kode Status',
			'tahun_semester_mulai' => 'Tahun Semester Mulai',
			'email_prodi' => 'Email Prodi',
			'tgl_pendirian_program_studi' => 'Tgl Pendirian Program Studi',
			'no_sk_akreditasi' => 'No Sk Akreditasi',
			'tgl_sk_akreditasi' => 'Tgl Sk Akreditasi',
			'tgl_akhir_sk_akreditasi' => 'Tgl Akhir Sk Akreditasi',
			'kode_status_akreditasi' => 'Kode Status Akreditasi',
			'frekuensi_kurikulum' => 'Frekuensi Kurikulum',
			'pelaksanaan_kurikulum' => 'Pelaksanaan Kurikulum',
			'nidn_ketua_prodi' => 'Nidn Ketua Prodi',
			'telp_ketua_prodi' => 'Telp Ketua Prodi',
			'fax_prodi' => 'Fax Prodi',
			'nama_operator' => 'Nama Operator',
			'hp_operator' => 'Hp Operator',
			'telepon_program_studi' => 'Telepon Program Studi',
			'singkatan' => 'Singkatan',
			'kode_feeder' => 'Kode Feeder',
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
		$criteria->addSearchCondition('kode_fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_jurusan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_jenjang_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('gelar_lulusan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('gelar_lulusan_en',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('gelar_lulusan_short',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_prodi_en',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('semester_awal',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('no_sk_dikti',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_sk_dikti',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_akhir_sk_dikti',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jml_sks_lulus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_status',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tahun_semester_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('email_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_pendirian_program_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('no_sk_akreditasi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_sk_akreditasi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_akhir_sk_akreditasi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_status_akreditasi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('frekuensi_kurikulum',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('pelaksanaan_kurikulum',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nidn_ketua_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('telp_ketua_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('fax_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_operator',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('hp_operator',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('telepon_program_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('singkatan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_feeder',$this->SEARCH,true,'OR');

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
	 * @return Masterprogramstudi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
