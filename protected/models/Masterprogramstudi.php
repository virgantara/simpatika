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
 * @property string $nama_prodi
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
 */
class Masterprogramstudi extends CActiveRecord
{
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
			array('nama_prodi, no_sk_dikti, email_prodi, nama_operator', 'length', 'max'=>50),
			array('kode_status', 'length', 'max'=>1),
			array('no_sk_akreditasi, nidn_ketua_prodi, telp_ketua_prodi, fax_prodi, hp_operator, telepon_program_studi', 'length', 'max'=>25),
			array('frekuensi_kurikulum, pelaksanaan_kurikulum', 'length', 'max'=>10),
			array('singkatan, kode_feeder', 'length', 'max'=>255),
			array('tgl_sk_dikti, tgl_akhir_sk_dikti, tgl_pendirian_program_studi, tgl_sk_akreditasi, tgl_akhir_sk_akreditasi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_fakultas, kode_jurusan, kode_prodi, kode_jenjang_studi, nama_prodi, semester_awal, no_sk_dikti, tgl_sk_dikti, tgl_akhir_sk_dikti, jml_sks_lulus, kode_status, tahun_semester_mulai, email_prodi, tgl_pendirian_program_studi, no_sk_akreditasi, tgl_sk_akreditasi, tgl_akhir_sk_akreditasi, kode_status_akreditasi, frekuensi_kurikulum, pelaksanaan_kurikulum, nidn_ketua_prodi, telp_ketua_prodi, fax_prodi, nama_operator, hp_operator, telepon_program_studi, singkatan, kode_feeder', 'safe', 'on'=>'search'),
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
			'nama_prodi' => 'Nama Prodi',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kode_fakultas',$this->kode_fakultas,true);
		$criteria->compare('kode_jurusan',$this->kode_jurusan,true);
		$criteria->compare('kode_prodi',$this->kode_prodi,true);
		$criteria->compare('kode_jenjang_studi',$this->kode_jenjang_studi,true);
		$criteria->compare('nama_prodi',$this->nama_prodi,true);
		$criteria->compare('semester_awal',$this->semester_awal,true);
		$criteria->compare('no_sk_dikti',$this->no_sk_dikti,true);
		$criteria->compare('tgl_sk_dikti',$this->tgl_sk_dikti,true);
		$criteria->compare('tgl_akhir_sk_dikti',$this->tgl_akhir_sk_dikti,true);
		$criteria->compare('jml_sks_lulus',$this->jml_sks_lulus,true);
		$criteria->compare('kode_status',$this->kode_status,true);
		$criteria->compare('tahun_semester_mulai',$this->tahun_semester_mulai,true);
		$criteria->compare('email_prodi',$this->email_prodi,true);
		$criteria->compare('tgl_pendirian_program_studi',$this->tgl_pendirian_program_studi,true);
		$criteria->compare('no_sk_akreditasi',$this->no_sk_akreditasi,true);
		$criteria->compare('tgl_sk_akreditasi',$this->tgl_sk_akreditasi,true);
		$criteria->compare('tgl_akhir_sk_akreditasi',$this->tgl_akhir_sk_akreditasi,true);
		$criteria->compare('kode_status_akreditasi',$this->kode_status_akreditasi,true);
		$criteria->compare('frekuensi_kurikulum',$this->frekuensi_kurikulum,true);
		$criteria->compare('pelaksanaan_kurikulum',$this->pelaksanaan_kurikulum,true);
		$criteria->compare('nidn_ketua_prodi',$this->nidn_ketua_prodi,true);
		$criteria->compare('telp_ketua_prodi',$this->telp_ketua_prodi,true);
		$criteria->compare('fax_prodi',$this->fax_prodi,true);
		$criteria->compare('nama_operator',$this->nama_operator,true);
		$criteria->compare('hp_operator',$this->hp_operator,true);
		$criteria->compare('telepon_program_studi',$this->telepon_program_studi,true);
		$criteria->compare('singkatan',$this->singkatan,true);
		$criteria->compare('kode_feeder',$this->kode_feeder,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
