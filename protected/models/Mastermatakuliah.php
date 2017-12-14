<?php

/**
 * This is the model class for table "simak_mastermatakuliah".
 *
 * The followings are the available columns in table 'simak_mastermatakuliah':
 * @property integer $id
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
 */
class Mastermatakuliah extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_mastermatakuliah';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tahun_akademik, kode_pt, kode_fakultas, kode_prodi, kode_jenjang_studi, kode_mata_kuliah, nama_mata_kuliah, sks, diktat', 'required'),
			array('tahun_akademik, kode_fakultas, kode_jenjang_studi, sks, sks_tatap_muka, sks_praktikum, sks_praktek_lap, semester, kode_kelompok, kode_matkul, jenjang_prodi, status_mata_kuliah, silabus, sap, bahan_ajar, diktat', 'length', 'max'=>5),
			array('kode_pt', 'length', 'max'=>6),
			array('nama_mata_kuliah','length','max'=>255),
			array('kode_prodi, kode_mata_kuliah', 'length', 'max'=>15),
			array('kode_kurikulum, prodi_pengampu', 'length', 'max'=>50),
			array('nidn', 'length', 'max'=>25),
			array('status_wajib', 'length', 'max'=>10),
			array('sms', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tahun_akademik, kode_pt, kode_fakultas, kode_prodi, kode_jenjang_studi, kode_mata_kuliah, nama_mata_kuliah, sks, sks_tatap_muka, sks_praktikum, sks_praktek_lap, semester, kode_kelompok, kode_kurikulum, kode_matkul, nidn, jenjang_prodi, prodi_pengampu, status_mata_kuliah, silabus, sap, bahan_ajar, diktat, status_wajib, sms', 'safe', 'on'=>'search'),
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
		);
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
		


		if($new->validate())
		{
			$new->save();
			return true;
		}

		else
		{
			print_r($new->getErrors());
			return false;
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
		$criteria->compare('tahun_akademik',$this->tahun_akademik,true);
		$criteria->compare('kode_pt',$this->kode_pt,true);
		$criteria->compare('kode_fakultas',$this->kode_fakultas,true);
		$criteria->compare('kode_prodi',$this->kode_prodi,true);
		$criteria->compare('kode_jenjang_studi',$this->kode_jenjang_studi,true);
		$criteria->compare('kode_mata_kuliah',$this->kode_mata_kuliah,true);
		$criteria->compare('nama_mata_kuliah',$this->nama_mata_kuliah,true);
		$criteria->compare('sks',$this->sks,true);
		$criteria->compare('sks_tatap_muka',$this->sks_tatap_muka,true);
		$criteria->compare('sks_praktikum',$this->sks_praktikum,true);
		$criteria->compare('sks_praktek_lap',$this->sks_praktek_lap,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('kode_kelompok',$this->kode_kelompok,true);
		$criteria->compare('kode_kurikulum',$this->kode_kurikulum,true);
		$criteria->compare('kode_matkul',$this->kode_matkul,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('jenjang_prodi',$this->jenjang_prodi,true);
		$criteria->compare('prodi_pengampu',$this->prodi_pengampu,true);
		$criteria->compare('status_mata_kuliah',$this->status_mata_kuliah,true);
		$criteria->compare('silabus',$this->silabus,true);
		$criteria->compare('sap',$this->sap,true);
		$criteria->compare('bahan_ajar',$this->bahan_ajar,true);
		$criteria->compare('diktat',$this->diktat,true);
		$criteria->compare('status_wajib',$this->status_wajib,true);
		$criteria->compare('sms',$this->sms,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
}
