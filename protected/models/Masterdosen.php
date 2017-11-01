<?php

/**
 * This is the model class for table "simak_masterdosen".
 *
 * The followings are the available columns in table 'simak_masterdosen':
 * @property integer $id
 * @property string $kode_pt
 * @property string $kode_fakultas
 * @property string $kode_jurusan
 * @property string $kode_prodi
 * @property string $kode_jenjang_studi
 * @property string $no_ktp_dosen
 * @property string $nidn
 * @property string $niy
 * @property string $nama_dosen
 * @property string $gelar_depan
 * @property string $gelar_akademik
 * @property string $tempat_lahir_dosen
 * @property string $tgl_lahir_dosen
 * @property string $jenis_kelamin
 * @property string $kode_jabatan_akademik
 * @property string $kode_pendidikan_tertinggi
 * @property string $kode_status_kerja_pts
 * @property string $kode_status_aktivitas_dosen
 * @property string $tahun_semester
 * @property string $nip_pns
 * @property string $home_base
 * @property string $photo_dosen
 * @property string $no_telp_dosen
 * @property string $no_hp_dosen
 * @property string $email_dosen
 * @property string $alamat_dosen
 * @property string $alamat_domisili
 * @property string $kabupaten_dosen
 * @property integer $provinsi_dosen
 * @property string $agama_dosen
 */
class Masterdosen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_masterdosen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_fakultas, kode_prodi, kode_jenjang_studi, no_ktp_dosen, nidn, nama_dosen', 'required'),
			array('provinsi_dosen', 'numerical', 'integerOnly'=>true),
			array('kode_pt, home_base', 'length', 'max'=>6),
			array('kode_fakultas, kode_jurusan, kode_jenjang_studi, kode_jabatan_akademik, kode_pendidikan_tertinggi, kode_status_kerja_pts, kode_status_aktivitas_dosen, tahun_semester', 'length', 'max'=>5),
			array('kode_prodi', 'length', 'max'=>15),
			array('no_ktp_dosen, nidn, nip_pns', 'length', 'max'=>30),
			array('niy, gelar_depan, no_hp_dosen', 'length', 'max'=>20),
			array('nama_dosen, tempat_lahir_dosen', 'length', 'max'=>50),
			array('gelar_akademik, kabupaten_dosen', 'length', 'max'=>10),
			array('jenis_kelamin', 'length', 'max'=>1),
			array('photo_dosen', 'length', 'max'=>255),
			array('no_telp_dosen', 'length', 'max'=>25),
			array('email_dosen', 'length', 'max'=>100),
			array('agama_dosen', 'length', 'max'=>2),
			array('tgl_lahir_dosen, alamat_dosen, alamat_domisili', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_pt, kode_fakultas, kode_jurusan, kode_prodi, kode_jenjang_studi, no_ktp_dosen, nidn, niy, nama_dosen, gelar_depan, gelar_akademik, tempat_lahir_dosen, tgl_lahir_dosen, jenis_kelamin, kode_jabatan_akademik, kode_pendidikan_tertinggi, kode_status_kerja_pts, kode_status_aktivitas_dosen, tahun_semester, nip_pns, home_base, photo_dosen, no_telp_dosen, no_hp_dosen, email_dosen, alamat_dosen, alamat_domisili, kabupaten_dosen, provinsi_dosen, agama_dosen', 'safe', 'on'=>'search'),
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

	public function quickCreate($fakultas, $prodi, $kode_dosen, $nama_dosen)
	{
		$new = new Masterdosen;
		$new->kode_fakultas = $fakultas;
		$new->kode_pt = 0;
		$new->kode_jurusan = $prodi;
		$new->kode_prodi = $prodi;
		$new->kode_jenjang_studi = 'B';
		$new->no_ktp_dosen = '12345678';
		$new->nidn = $kode_dosen;
		$new->niy = $kode_dosen;
		$new->nama_dosen = $nama_dosen;
		$new->jenis_kelamin = 'L';
		$new->kode_jabatan_akademik = 'A';
		$new->kode_pendidikan_tertinggi = 'B';
		$new->kode_status_kerja_pts = 'A';
		$new->kode_status_aktivitas_dosen = 'A';
		
		if($new->validate())
		{
			$new->save();
			return true;
		}

		else
		{
			return false;
		}

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_pt' => 'Kode Pt',
			'kode_fakultas' => 'Kode Fakultas',
			'kode_jurusan' => 'Kode Jurusan',
			'kode_prodi' => 'Kode Prodi',
			'kode_jenjang_studi' => 'Kode Jenjang Studi',
			'no_ktp_dosen' => 'No Ktp Dosen',
			'nidn' => 'Nidn',
			'niy' => 'Niy',
			'nama_dosen' => 'Nama Dosen',
			'gelar_depan' => 'Gelar Depan',
			'gelar_akademik' => 'Gelar Akademik',
			'tempat_lahir_dosen' => 'Tempat Lahir Dosen',
			'tgl_lahir_dosen' => 'Tgl Lahir Dosen',
			'jenis_kelamin' => 'Jenis Kelamin',
			'kode_jabatan_akademik' => 'Kode Jabatan Akademik',
			'kode_pendidikan_tertinggi' => 'Kode Pendidikan Tertinggi',
			'kode_status_kerja_pts' => 'Kode Status Kerja Pts',
			'kode_status_aktivitas_dosen' => 'Kode Status Aktivitas Dosen',
			'tahun_semester' => 'Tahun Semester',
			'nip_pns' => 'Nip Pns',
			'home_base' => 'Home Base',
			'photo_dosen' => 'Photo Dosen',
			'no_telp_dosen' => 'No Telp Dosen',
			'no_hp_dosen' => 'No Hp Dosen',
			'email_dosen' => 'Email Dosen',
			'alamat_dosen' => 'Alamat Dosen',
			'alamat_domisili' => 'Alamat Domisili',
			'kabupaten_dosen' => 'Kabupaten Dosen',
			'provinsi_dosen' => 'Provinsi Dosen',
			'agama_dosen' => 'Agama Dosen',
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
		$criteria->compare('kode_pt',$this->kode_pt,true);
		$criteria->compare('kode_fakultas',$this->kode_fakultas,true);
		$criteria->compare('kode_jurusan',$this->kode_jurusan,true);
		$criteria->compare('kode_prodi',$this->kode_prodi,true);
		$criteria->compare('kode_jenjang_studi',$this->kode_jenjang_studi,true);
		$criteria->compare('no_ktp_dosen',$this->no_ktp_dosen,true);
		$criteria->compare('nidn',$this->nidn,true);
		$criteria->compare('niy',$this->niy,true);
		$criteria->compare('nama_dosen',$this->nama_dosen,true);
		$criteria->compare('gelar_depan',$this->gelar_depan,true);
		$criteria->compare('gelar_akademik',$this->gelar_akademik,true);
		$criteria->compare('tempat_lahir_dosen',$this->tempat_lahir_dosen,true);
		$criteria->compare('tgl_lahir_dosen',$this->tgl_lahir_dosen,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('kode_jabatan_akademik',$this->kode_jabatan_akademik,true);
		$criteria->compare('kode_pendidikan_tertinggi',$this->kode_pendidikan_tertinggi,true);
		$criteria->compare('kode_status_kerja_pts',$this->kode_status_kerja_pts,true);
		$criteria->compare('kode_status_aktivitas_dosen',$this->kode_status_aktivitas_dosen,true);
		$criteria->compare('tahun_semester',$this->tahun_semester,true);
		$criteria->compare('nip_pns',$this->nip_pns,true);
		$criteria->compare('home_base',$this->home_base,true);
		$criteria->compare('photo_dosen',$this->photo_dosen,true);
		$criteria->compare('no_telp_dosen',$this->no_telp_dosen,true);
		$criteria->compare('no_hp_dosen',$this->no_hp_dosen,true);
		$criteria->compare('email_dosen',$this->email_dosen,true);
		$criteria->compare('alamat_dosen',$this->alamat_dosen,true);
		$criteria->compare('alamat_domisili',$this->alamat_domisili,true);
		$criteria->compare('kabupaten_dosen',$this->kabupaten_dosen,true);
		$criteria->compare('provinsi_dosen',$this->provinsi_dosen);
		$criteria->compare('agama_dosen',$this->agama_dosen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Masterdosen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
