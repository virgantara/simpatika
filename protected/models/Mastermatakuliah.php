<?php

/**
 * This is the model class for table "{{mastermatakuliah}}".
 *
 * The followings are the available columns in table '{{mastermatakuliah}}':
 * @property integer $id
 * @property string $kode_feeder
 * @property string $tahun_akademik
 * @property string $kode_pt
 * @property string $kode_fakultas
 * @property string $kode_prodi
 * @property string $kode_jenjang_studi
 * @property string $kode_mata_kuliah
 * @property string $nama_mata_kuliah
 * @property string $sks
 * @property string $sks_tatap_muka
 * @property string $sks_praktikum
 * @property string $sks_praktek_lap
 * @property string $semester
 * @property string $kode_kelompok
 * @property string $kode_kurikulum
 * @property string $kode_matkul
 * @property string $nidn
 * @property string $jenjang_prodi
 * @property string $prodi_pengampu
 * @property string $status_mata_kuliah
 * @property string $silabus
 * @property string $sap
 * @property string $bahan_ajar
 * @property string $diktat
 * @property string $status_wajib
 * @property string $sms
 * @property string $created_at
 * @property string $updated_at
 */
class Mastermatakuliah extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mastermatakuliah}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tahun_akademik, kode_pt, kode_fakultas, kode_prodi, kode_mata_kuliah, nama_mata_kuliah, sks, diktat', 'required'),
			array('kode_feeder', 'length', 'max'=>255),
			array('tahun_akademik, kode_fakultas, kode_jenjang_studi, sks, sks_tatap_muka, sks_praktikum, sks_praktek_lap, semester, kode_kelompok, kode_matkul, jenjang_prodi, status_mata_kuliah, silabus, sap, bahan_ajar, diktat', 'length', 'max'=>5),
			array('kode_pt', 'length', 'max'=>6),
			array('kode_prodi, kode_mata_kuliah', 'length', 'max'=>15),
			array('nama_mata_kuliah, kode_kurikulum, prodi_pengampu', 'length', 'max'=>50),
			array('nidn', 'length', 'max'=>25),
			array('status_wajib', 'length', 'max'=>10),
			array('sms', 'length', 'max'=>1),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_feeder, tahun_akademik, kode_pt, kode_fakultas, kode_prodi, kode_jenjang_studi, kode_mata_kuliah, nama_mata_kuliah, sks, sks_tatap_muka, sks_praktikum, sks_praktek_lap, semester, kode_kelompok, kode_kurikulum, kode_matkul, nidn, jenjang_prodi, prodi_pengampu, status_mata_kuliah, silabus, sap, bahan_ajar, diktat, status_wajib, sms, created_at, updated_at', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_feeder' => 'Kode Feeder',
			'tahun_akademik' => 'Tahun Akademik',
			'kode_pt' => 'Kode Pt',
			'kode_fakultas' => 'Kode Fakultas',
			'kode_prodi' => 'Kode Prodi',
			'kode_jenjang_studi' => 'Kode Jenjang Studi',
			'kode_mata_kuliah' => 'Kode Mata Kuliah',
			'nama_mata_kuliah' => 'Nama Mata Kuliah',
			'sks' => 'Sks',
			'sks_tatap_muka' => 'Sks Tatap Muka',
			'sks_praktikum' => 'Sks Praktikum',
			'sks_praktek_lap' => 'Sks Praktek Lap',
			'semester' => 'Semester',
			'kode_kelompok' => 'Kode Kelompok',
			'kode_kurikulum' => 'Kode Kurikulum',
			'kode_matkul' => 'Kode Matkul',
			'nidn' => 'Nidn',
			'jenjang_prodi' => 'Jenjang Prodi',
			'prodi_pengampu' => 'Prodi Pengampu',
			'status_mata_kuliah' => 'Status Mata Kuliah',
			'silabus' => 'Silabus',
			'sap' => 'Sap',
			'bahan_ajar' => 'Bahan Ajar',
			'diktat' => 'Diktat',
			'status_wajib' => 'Status Wajib',
			'sms' => 'Sms',
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
		$criteria->addSearchCondition('kode_feeder',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tahun_akademik',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pt',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_jenjang_studi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_mata_kuliah',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_mata_kuliah',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_tatap_muka',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_praktikum',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_praktek_lap',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('semester',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_kelompok',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_kurikulum',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_matkul',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nidn',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jenjang_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('prodi_pengampu',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_mata_kuliah',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('silabus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sap',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bahan_ajar',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('diktat',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_wajib',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sms',$this->SEARCH,true,'OR');
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
	 * @return Mastermatakuliah the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function quickCreate($tahun_akademik, $fakultas, $prodi, $kode_mk, $nama_mk,$nidn, $sks, $semester )
	{
		$new = new Mastermatakuliah;
		$new->tahun_akademik = $tahun_akademik;
		$new->kode_pt = '073090';
		$new->kode_fakultas = $fakultas;
		$new->kode_prodi = $prodi;
		$new->kode_jenjang_studi = 'S';
		$new->kode_mata_kuliah = $kode_mk;
		$new->nama_mata_kuliah = $nama_mk;
		$new->nidn = $nidn;
		$new->sks = $sks;
		$new->semester = $semester;
		$new->diktat = 'N';
		$new->sms = 2;
		

		$msg = array();

		if($new->validate())
		{
			$new->save();
			$msg = array(
				'code' => '200',
				'message' => 'sukses'
			);
			return $msg;
		}

		else
		{
			$errors = '';
			
			foreach($new->getErrors() as $attribute){
				foreach($attribute as $error){
					$errors .= $error.' ';
				}
			}
			
			$msg = array(
				'code' => '501',
				'message' => $errors
			);
			return $msg;
		}

	}
}
