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
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_jadwal';
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
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hari, jam, jam_mulai, jam_selesai, kode_mk, nama_mk, kode_dosen, nama_dosen, semester, kelas, fakultas, nama_fakultas, prodi, nama_prodi, kd_ruangan, tahun_akademik, kuota_kelas, kampus, presensi, materi, bobot_formatif, bobot_uts, bobot_uas, bobot_harian1, bobot_harian', 'safe', 'on'=>'search'),
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
