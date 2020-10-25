<?php

/**
 * This is the model class for table "{{tahunakademik}}".
 *
 * The followings are the available columns in table '{{tahunakademik}}':
 * @property integer $id
 * @property string $tahun_id
 * @property string $tahun
 * @property integer $semester
 * @property string $nama_tahun
 * @property string $krs_mulai
 * @property string $krs_selesai
 * @property string $krs_online_mulai
 * @property string $krs_online_selesai
 * @property string $krs_ubah_mulai
 * @property string $krs_ubah_selesai
 * @property string $kss_cetak_mulai
 * @property string $kss_cetak_selesai
 * @property string $cuti
 * @property string $mundur
 * @property string $bayar_mulai
 * @property string $bayar_selesai
 * @property string $kuliah_mulai
 * @property string $kuliah_selesai
 * @property string $uts_mulai
 * @property string $uts_selesai
 * @property string $uas_mulai
 * @property string $uas_selesai
 * @property string $ekd_mulai
 * @property string $ekd_selesai
 * @property string $nilai
 * @property string $akhir_kss
 * @property integer $proses_buka
 * @property integer $proses_ipk
 * @property integer $proses_tutup
 * @property string $buka
 * @property string $syarat_krs
 * @property string $syarat_krs_ips
 * @property string $cuti_selesai
 * @property integer $max_sks
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Pencekalan[] $pencekalans
 * @property TahfidzPeriode[] $tahfidzPeriodes
 */
class SimakTahunakademik extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tahunakademik}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_tahun', 'required'),
			array('semester, proses_buka, proses_ipk, proses_tutup, max_sks', 'numerical', 'integerOnly'=>true),
			array('tahun_id', 'length', 'max'=>5),
			array('tahun', 'length', 'max'=>4),
			array('nama_tahun', 'length', 'max'=>50),
			array('buka, syarat_krs, syarat_krs_ips', 'length', 'max'=>10),
			array('krs_mulai, krs_selesai, krs_online_mulai, krs_online_selesai, krs_ubah_mulai, krs_ubah_selesai, kss_cetak_mulai, kss_cetak_selesai, cuti, mundur, bayar_mulai, bayar_selesai, kuliah_mulai, kuliah_selesai, uts_mulai, uts_selesai, uas_mulai, uas_selesai, ekd_mulai, ekd_selesai, nilai, akhir_kss, cuti_selesai, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tahun_id, tahun, semester, nama_tahun, krs_mulai, krs_selesai, krs_online_mulai, krs_online_selesai, krs_ubah_mulai, krs_ubah_selesai, kss_cetak_mulai, kss_cetak_selesai, cuti, mundur, bayar_mulai, bayar_selesai, kuliah_mulai, kuliah_selesai, uts_mulai, uts_selesai, uas_mulai, uas_selesai, ekd_mulai, ekd_selesai, nilai, akhir_kss, proses_buka, proses_ipk, proses_tutup, buka, syarat_krs, syarat_krs_ips, cuti_selesai, max_sks, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'pencekalans' => array(self::HAS_MANY, 'Pencekalan', 'tahun_id'),
			'tahfidzPeriodes' => array(self::HAS_MANY, 'TahfidzPeriode', 'tahun_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tahun_id' => 'Tahun',
			'tahun' => 'Tahun',
			'semester' => 'Semester',
			'nama_tahun' => 'Nama Tahun',
			'krs_mulai' => 'Krs Mulai',
			'krs_selesai' => 'Krs Selesai',
			'krs_online_mulai' => 'Krs Online Mulai',
			'krs_online_selesai' => 'Krs Online Selesai',
			'krs_ubah_mulai' => 'Krs Ubah Mulai',
			'krs_ubah_selesai' => 'Krs Ubah Selesai',
			'kss_cetak_mulai' => 'Kss Cetak Mulai',
			'kss_cetak_selesai' => 'Kss Cetak Selesai',
			'cuti' => 'Cuti',
			'mundur' => 'Mundur',
			'bayar_mulai' => 'Bayar Mulai',
			'bayar_selesai' => 'Bayar Selesai',
			'kuliah_mulai' => 'Kuliah Mulai',
			'kuliah_selesai' => 'Kuliah Selesai',
			'uts_mulai' => 'Uts Mulai',
			'uts_selesai' => 'Uts Selesai',
			'uas_mulai' => 'Uas Mulai',
			'uas_selesai' => 'Uas Selesai',
			'ekd_mulai' => 'Ekd Mulai',
			'ekd_selesai' => 'Ekd Selesai',
			'nilai' => 'Nilai',
			'akhir_kss' => 'Akhir Kss',
			'proses_buka' => 'Proses Buka',
			'proses_ipk' => 'Proses Ipk',
			'proses_tutup' => 'Proses Tutup',
			'buka' => 'Buka',
			'syarat_krs' => 'Syarat Krs',
			'syarat_krs_ips' => 'Syarat Krs Ips',
			'cuti_selesai' => 'Cuti Selesai',
			'max_sks' => 'Max Sks',
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
		$criteria->addSearchCondition('tahun_id',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tahun',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('semester',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_tahun',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('krs_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('krs_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('krs_online_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('krs_online_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('krs_ubah_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('krs_ubah_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kss_cetak_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kss_cetak_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('cuti',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('mundur',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bayar_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bayar_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kuliah_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kuliah_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('uts_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('uts_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('uas_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('uas_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('ekd_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('ekd_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nilai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('akhir_kss',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('proses_buka',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('proses_ipk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('proses_tutup',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('buka',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('syarat_krs',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('syarat_krs_ips',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('cuti_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('max_sks',$this->SEARCH,true,'OR');
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
	 * @return SimakTahunakademik the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
