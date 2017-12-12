<?php

/**
 * This is the model class for table "simak_datakrs".
 *
 * The followings are the available columns in table 'simak_datakrs':
 * @property integer $id
 * @property string $kode_pt
 * @property string $kode_fak
 * @property string $kode_jenjang
 * @property string $kode_jurusan
 * @property string $kode_prodi
 * @property string $kode_mk
 * @property string $nama_mk
 * @property string $sks
 * @property string $mahasiswa
 * @property string $kode_dosen
 * @property string $namadosen
 * @property integer $semester
 * @property string $kode_jadwal
 * @property string $kelas
 * @property string $harian
 * @property string $normatif
 * @property string $uts
 * @property string $uas
 * @property string $nilai_angka
 * @property string $nilai_huruf
 * @property string $bobot_nilai
 * @property string $created_date
 * @property string $tahun_akademik
 * @property string $status
 * @property string $semester_matakuliah
 * @property integer $status_publis
 * @property string $jumlah_nilai
 * @property string $status_krs
 * @property string $lulus
 * @property string $pindahan
 */
class Datakrs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_datakrs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_mk, sks, mahasiswa, semester', 'required'),
			array('semester, status_publis', 'numerical', 'integerOnly'=>true),
			array('kode_pt, kode_fak, kode_jurusan, kode_prodi, kode_jadwal, uas, bobot_nilai, jumlah_nilai, status_krs', 'length', 'max'=>10),
			array('kode_jenjang, lulus', 'length', 'max'=>3),
			array('kode_mk, mahasiswa, kode_dosen, kelas', 'length', 'max'=>20),
			array('nama_mk, namadosen', 'length', 'max'=>100),
			array('sks, normatif, uts, nilai_huruf', 'length', 'max'=>5),
			array('harian, semester_matakuliah', 'length', 'max'=>4),
			array('nilai_angka', 'length', 'max'=>15),
			array('tahun_akademik', 'length', 'max'=>6),
			array('status, pindahan', 'length', 'max'=>2),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_pt, kode_fak, kode_jenjang, kode_jurusan, kode_prodi, kode_mk, nama_mk, sks, mahasiswa, kode_dosen, namadosen, semester, kode_jadwal, kelas, harian, normatif, uts, uas, nilai_angka, nilai_huruf, bobot_nilai, created_date, tahun_akademik, status, semester_matakuliah, status_publis, jumlah_nilai, status_krs, lulus, pindahan', 'safe', 'on'=>'search'),
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
			'kode_pt' => 'Kode Pt',
			'kode_fak' => 'Kode Fak',
			'kode_jenjang' => 'Kode Jenjang',
			'kode_jurusan' => 'Kode Jurusan',
			'kode_prodi' => 'Kode Prodi',
			'kode_mk' => 'Kode Mk',
			'nama_mk' => 'Nama Mk',
			'sks' => 'Sks',
			'mahasiswa' => 'Mahasiswa',
			'kode_dosen' => 'Kode Dosen',
			'namadosen' => 'Namadosen',
			'semester' => 'Semester',
			'kode_jadwal' => 'Kode Jadwal',
			'kelas' => 'Kelas',
			'harian' => 'Harian',
			'normatif' => 'Normatif',
			'uts' => 'Uts',
			'uas' => 'Uas',
			'nilai_angka' => 'Nilai Angka',
			'nilai_huruf' => 'Nilai Huruf',
			'bobot_nilai' => 'Bobot Nilai',
			'created_date' => 'Created Date',
			'tahun_akademik' => 'Tahun Akademik',
			'status' => 'Status',
			'semester_matakuliah' => 'Semester Matakuliah',
			'status_publis' => 'Status Publis',
			'jumlah_nilai' => 'Jumlah Nilai',
			'status_krs' => 'Status Krs',
			'lulus' => 'Lulus',
			'pindahan' => 'Pindahan',
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
		$sort = new CSort();

		$criteria->compare('id',$this->id);
		$criteria->compare('kode_pt',$this->kode_pt,true);
		$criteria->compare('kode_fak',$this->kode_fak,true);
		$criteria->compare('kode_jenjang',$this->kode_jenjang,true);
		$criteria->compare('kode_jurusan',$this->kode_jurusan,true);
		$criteria->compare('kode_prodi',$this->kode_prodi,true);
		$criteria->compare('kode_mk',$this->kode_mk,true);
		$criteria->compare('nama_mk',$this->nama_mk,true);
		$criteria->compare('sks',$this->sks,true);
		$criteria->compare('mahasiswa',$this->mahasiswa,true);
		$criteria->compare('kode_dosen',$this->kode_dosen,true);
		$criteria->compare('namadosen',$this->namadosen,true);
		$criteria->compare('semester',$this->semester);
		$criteria->compare('kode_jadwal',$this->kode_jadwal,true);
		$criteria->compare('kelas',$this->kelas,true);
		$criteria->compare('harian',$this->harian,true);
		$criteria->compare('normatif',$this->normatif,true);
		$criteria->compare('uts',$this->uts,true);
		$criteria->compare('uas',$this->uas,true);
		$criteria->compare('nilai_angka',$this->nilai_angka,true);
		$criteria->compare('nilai_huruf',$this->nilai_huruf,true);
		$criteria->compare('bobot_nilai',$this->bobot_nilai,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('tahun_akademik',$this->tahun_akademik,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('semester_matakuliah',$this->semester_matakuliah,true);
		$criteria->compare('status_publis',$this->status_publis);
		$criteria->compare('jumlah_nilai',$this->jumlah_nilai,true);
		$criteria->compare('status_krs',$this->status_krs,true);
		$criteria->compare('lulus',$this->lulus,true);
		$criteria->compare('pindahan',$this->pindahan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array(
				'pageSize'=>100,
				
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Datakrs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
