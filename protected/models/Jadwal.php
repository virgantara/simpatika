<?php

/**
 * This is the model class for table "simak_jadwal".
 *
 * The followings are the available columns in table 'simak_jadwal':
 * @property integer $id
 * @property string $hari
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
 */
class Jadwal extends CActiveRecord
{

	public $SKS;
	public $uploadedFile;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_jadwal_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hari, jam_ke, kode_mk, kode_dosen, semester, kelas, prodi, kd_ruangan, kampus', 'required'),
			array('kuota_kelas', 'numerical', 'integerOnly'=>true),
			array('hari, bobot_formatif, bobot_uts, bobot_uas', 'length', 'max'=>30),
			array('jam, kode_mk, kode_dosen, kd_ruangan', 'length', 'max'=>20),
			array('nama_mk, nama_dosen, nama_fakultas, nama_prodi, materi', 'length', 'max'=>255),
			array('semester', 'length', 'max'=>5),
			array('kelas, prodi, tahun_akademik', 'length', 'max'=>10),
			array('fakultas', 'length', 'max'=>7),
			array('kampus', 'length', 'max'=>2),
			array('bobot_harian1, bobot_harian', 'length', 'max'=>4),
			array('jam_mulai, jam_selesai, presensi', 'safe'),
			// array('jam_selesai', 'validatorCompareDateTime', 'compareAttribute' => 'jam_mulai', 'condition' => '>'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hari, jam_ke, jam, jam_mulai, jam_selesai, kode_mk, nama_mk, kode_dosen, nama_dosen, semester, kelas, fakultas, nama_fakultas, prodi, nama_prodi, kd_ruangan, tahun_akademik, kuota_kelas, kampus, presensi, materi, bobot_formatif, bobot_uts, bobot_uas, bobot_harian1, bobot_harian', 'safe', 'on'=>'search'),
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
			// 'dOSEN' => array(self::BELONGS_TO, 'Masterdosen', 'kode_dosen'),
		);
	}

	public function findRekapJadwal($id,$kelas)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('prodi',$id);
		$criteria->compare('kelas',$kelas);
		$criteria->order = 'semester ASC';
		$model = Jadwal::model()->findAll($criteria);	

		return $model;
	}

	public function findJadwalDosen($dosen, $hari, $jamke)
	{
		$params = array(
			'kode_dosen' => $dosen,
			'hari' => $hari,
			'jam_ke' => $jamke
		);
		$model = Jadwal::model()->findByAttributes($params);

		return $model;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hari' => 'Hari',
			'jam_ke' => 'Jam',
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
		);
	}

	public function validatorCompareDateTime($attribute, $params)
    {
        $compareAttribute = $params['compareAttribute'];
        $condition = $params['condition'];
        if ($this->hasErrors($attribute) || $this->hasErrors($compareAttribute) || empty($this->$compareAttribute)) {
            return;
        }
        $validateValue = new DateTime($this->$attribute, new DateTimeZone(Yii::app()->getTimeZone()));
        $compareValue = new DateTime($this->$compareAttribute, new DateTimeZone(Yii::app()->getTimeZone()));
        switch ($condition) {
            case '>=':
                if (($validateValue >= $compareValue) === false) {
                    $this->addError($attribute, sprintf('The value in the "%s" field must be greater than or equal to the value in the "%s" field', $this->getAttributeLabel($attribute), $this->getAttributeLabel($compareAttribute)));
                }
                break;
 
            case '>':
                if (($validateValue > $compareValue) === false) {
                    $this->addError($attribute, sprintf('The value in the "%s" field must be greater than the value in the "%s" field', $this->getAttributeLabel($attribute), $this->getAttributeLabel($compareAttribute)));
                }
                break;
        }
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
		$criteria->compare('hari',$this->hari,true);
		$criteria->compare('jam',$this->jam,true);
		$criteria->compare('jam_mulai',$this->jam_mulai,true);
		$criteria->compare('jam_selesai',$this->jam_selesai,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nama_mk',$this->nama_mk,true);
		$criteria->compare('kode_dosen',$this->kode_dosen,true);
		$criteria->compare('nama_dosen',$this->nama_dosen,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('kelas',$this->kelas,true);
		$criteria->compare('fakultas',$this->fakultas,true);
		$criteria->compare('nama_fakultas',$this->nama_fakultas,true);
		$criteria->compare('prodi',$this->prodi,true);
		$criteria->compare('nama_prodi',$this->nama_prodi,true);
		$criteria->compare('kd_ruangan',$this->kd_ruangan,true);
		$criteria->compare('tahun_akademik',$this->tahun_akademik,true);
		$criteria->compare('kuota_kelas',$this->kuota_kelas);
		$criteria->compare('kampus',$this->kampus,true);
		$criteria->compare('presensi',$this->presensi,true);
		$criteria->compare('materi',$this->materi,true);
		$criteria->compare('bobot_formatif',$this->bobot_formatif,true);
		$criteria->compare('bobot_uts',$this->bobot_uts,true);
		$criteria->compare('bobot_uas',$this->bobot_uas,true);
		$criteria->compare('bobot_harian1',$this->bobot_harian1,true);
		$criteria->compare('bobot_harian',$this->bobot_harian,true);

		if(Yii::app()->user->checkAccess(array(WebUser::R_PRODI)))
		{
			
			$prodi = Yii::app()->user->getState('prodi');
			$criteria->compare('prodi',$prodi);	
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function afterFind()
	{
		$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=> $this->kode_mk));
		$this->SKS = $mk->sks;
		return parent::afterFind();
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jadwal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
