<?php

/**
 * This is the model class for table "simak_jadwal_log".
 *
 * The followings are the available columns in table 'simak_jadwal_log':
 * @property integer $id
 * @property string $hari
 * @property integer $jam_ke
 * @property string $jam
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $kode_mk
 * @property string $nama_mk
 * @property string $kode_dosen
 * @property string $nama_dosen
 * @property string $semester
 * @property string $kelas
 * @property string $fakultas
 * @property string $nama_fakultas
 * @property string $prodi
 * @property string $nama_prodi
 * @property string $kd_ruangan
 * @property string $tahun_akademik
 * @property integer $kuota_kelas
 * @property string $kampus
 * @property string $presensi
 * @property string $materi
 * @property string $bobot_formatif
 * @property string $bobot_uts
 * @property string $bobot_uas
 * @property string $bobot_harian1
 * @property string $bobot_harian
 * @property integer $bentrok
 * @property string $bentrok_with
 * @property string $created
 * @property string $modified
 */
class JadwalLog extends CActiveRecord
{
	public $SKS;
	public $SEARCH;
	public $PAGE_SIZE = 10;
	public $KODEPRODI = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_jadwal_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hari, jam, kode_mk, kode_dosen, semester, kelas, prodi, kd_ruangan, kampus, created, modified', 'required'),
			array('jam_ke, kuota_kelas, bentrok', 'numerical', 'integerOnly'=>true),
			array('hari, bobot_formatif, bobot_uts, bobot_uas', 'length', 'max'=>30),
			array('jam, kode_mk, kode_dosen, kd_ruangan', 'length', 'max'=>20),
			array('nama_mk, nama_dosen, nama_fakultas, nama_prodi, materi, bentrok_with', 'length', 'max'=>255),
			array('semester', 'length', 'max'=>5),
			array('kelas, prodi, tahun_akademik', 'length', 'max'=>10),
			array('fakultas', 'length', 'max'=>7),
			array('kampus', 'length', 'max'=>2),
			array('bobot_harian1, bobot_harian', 'length', 'max'=>4),
			array('jam_mulai, jam_selesai, presensi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_catatan, id, hari, jam_ke, jam, jam_mulai, jam_selesai, kode_mk, nama_mk, kode_dosen, nama_dosen, semester, kelas, fakultas, nama_fakultas, prodi, nama_prodi, kd_ruangan, tahun_akademik, kuota_kelas, kampus, presensi, materi, bobot_formatif, bobot_uts, bobot_uas, bobot_harian1, bobot_harian, bentrok, bentrok_with, created, modified', 'safe', 'on'=>'search'),
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
			'jAM' => array(self::BELONGS_TO, 'Jam', 'jam_ke'),
			'kAMPUS' => array(self::BELONGS_TO, 'Kampus', 'kampus'),
			'mk' => array(self::BELONGS_TO, 'Mastermatakuliah', 'kode_mk'),
			'kELAS' => array(self::BELONGS_TO, 'Masterkelas', 'kelas'),
			'pRODI' => array(self::BELONGS_TO, 'Masterprogramstudi', 'prodi'),
			'dOSEN' => array(self::BELONGS_TO, 'Masterdosen', 'kode_dosen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_catatan' => 'Catatan ID',
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
		$sort = new CSort();
		$criteria=new CDbCriteria;

		$criteria->addSearchCondition('t.id',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('hari',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jam',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jam_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jam_selesai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_dosen',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_dosen',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kAMPUS.nama_kampus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kELAS.nama_kelas',$this->SEARCH,true,'OR');
		$criteria->with = array('kAMPUS','kELAS');
		$criteria->together = true;

		if($this->KODEPRODI != 0)
		{
			$criteria->compare('prodi',$this->KODEPRODI);	
		}
		

		if(Yii::app()->user->checkAccess(array(WebUser::R_PRODI)))
		{
			
			$prodi = Yii::app()->user->getState('prodi');
			$criteria->compare('prodi',$prodi);	
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array(
				'pageSize'=>$this->PAGE_SIZE,
				
			),
		));
	}

	protected function afterFind()
	{
		$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=> $this->kode_mk));
		$this->SKS = $mk->sks;
		$this->hari = trim($this->hari);
		return parent::afterFind();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JadwalLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
