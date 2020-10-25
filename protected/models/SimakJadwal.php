<?php

/**
 * This is the model class for table "{{jadwal}}".
 *
 * The followings are the available columns in table '{{jadwal}}':
 * @property integer $id
 * @property string $hari
 * @property string $jam
 * @property string $kode_mk
 * @property string $kode_dosen
 * @property string $semester
 * @property string $kelas
 * @property string $fakultas
 * @property string $prodi
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
 * @property integer $jadwal_temp_id
 * @property string $created_at
 * @property string $updated_at
 */
class SimakJadwal extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{jadwal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hari, jam, kode_mk, kode_dosen, semester, kelas, prodi, kd_ruangan, kampus', 'required'),
			array('kuota_kelas, jadwal_temp_id', 'numerical', 'integerOnly'=>true),
			array('hari, bobot_formatif, bobot_uts, bobot_uas', 'length', 'max'=>30),
			array('jam, kode_mk, kode_dosen, kd_ruangan', 'length', 'max'=>20),
			array('semester', 'length', 'max'=>5),
			array('kelas, prodi, tahun_akademik', 'length', 'max'=>10),
			array('fakultas', 'length', 'max'=>7),
			array('kampus', 'length', 'max'=>2),
			array('materi', 'length', 'max'=>255),
			array('bobot_harian1, bobot_harian', 'length', 'max'=>4),
			array('presensi, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hari, jam, kode_mk, kode_dosen, semester, kelas, fakultas, prodi, kd_ruangan, tahun_akademik, kuota_kelas, kampus, presensi, materi, bobot_formatif, bobot_uts, bobot_uas, bobot_harian1, bobot_harian, jadwal_temp_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'hari' => 'Hari',
			'jam' => 'Jam',
			'kode_mk' => 'Kode Mk',
			'kode_dosen' => 'Kode Dosen',
			'semester' => 'Semester',
			'kelas' => 'Kelas',
			'fakultas' => 'Fakultas',
			'prodi' => 'Prodi',
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
			'jadwal_temp_id' => 'Jadwal Temp',
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
		$criteria->addSearchCondition('hari',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jam',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_dosen',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('semester',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kelas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kd_ruangan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tahun_akademik',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kuota_kelas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kampus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('presensi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('materi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bobot_formatif',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bobot_uts',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bobot_uas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bobot_harian1',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('bobot_harian',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jadwal_temp_id',$this->SEARCH,true,'OR');
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
	 * @return SimakJadwal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
