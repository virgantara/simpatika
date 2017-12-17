<?php

/**
 * This is the model class for table "simak_mastermahasiswa".
 *
 * The followings are the available columns in table 'simak_mastermahasiswa':
 * @property integer $id
 * @property string $kode_pt
 * @property string $kode_fakultas
 * @property string $kode_prodi
 * @property string $kode_jenjang_studi
 * @property string $nim_mhs
 * @property string $nama_mahasiswa
 * @property string $tempat_lahir
 * @property string $tgl_lahir
 * @property string $jenis_kelamin
 * @property string $tahun_masuk
 * @property string $semester_awal
 * @property string $batas_studi
 * @property string $asal_propinsi
 * @property string $tgl_masuk
 * @property string $tgl_lulus
 * @property string $status_aktivitas
 * @property string $status_awal
 * @property string $jml_sks_diakui
 * @property string $nim_asal
 * @property string $asal_pt
 * @property string $nama_asal_pt
 * @property string $asal_jenjang_studi
 * @property string $asal_prodi
 * @property string $kode_biaya_studi
 * @property string $kode_pekerjaan
 * @property string $tempat_kerja
 * @property string $kode_pt_kerja
 * @property string $kode_ps_kerja
 * @property string $nip_promotor
 * @property string $nip_co_promotor1
 * @property string $nip_co_promotor2
 * @property string $nip_co_promotor3
 * @property string $nip_co_promotor4
 * @property string $photo_mahasiswa
 * @property string $semester
 * @property string $keterangan
 * @property integer $status_bayar
 * @property string $telepon
 * @property string $hp
 * @property string $email
 * @property string $alamat
 * @property string $berat
 * @property string $tinggi
 * @property string $ktp
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property string $kode_pos
 * @property string $desa
 * @property string $kecamatan
 * @property string $jenis_tinggal
 * @property string $penerima_kps
 * @property string $no_kps
 * @property string $provinsi
 * @property string $kabupaten
 * @property string $warga_negara
 * @property string $status_sipil
 * @property string $agama
 * @property string $gol_darah
 * @property string $masuk_kelas
 * @property string $tgl_sk_yudisium
 * @property integer $status_mahasiswa
 * @property string $kampus
 */
class Mastermahasiswa extends CActiveRecord
{

	public $uploadedFile;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_mastermahasiswa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nim_mhs, nama_mahasiswa', 'required'),
			array('status_bayar, status_mahasiswa', 'numerical', 'integerOnly'=>true),
			array('kode_pt, asal_prodi, kode_pos', 'length', 'max'=>6),
			array('kode_fakultas, kode_prodi, kode_jenjang_studi, jenis_kelamin, semester_awal, batas_studi, status_awal, asal_jenjang_studi, semester, rt, rw, kabupaten', 'length', 'max'=>5),
			array('nim_mhs, nama_asal_pt, telepon, hp', 'length', 'max'=>25),
			array('nama_mahasiswa, tempat_lahir, asal_propinsi, status_aktivitas, email', 'length', 'max'=>50),
			array('tahun_masuk', 'length', 'max'=>4),
			array('jml_sks_diakui', 'length', 'max'=>45),
			array('nim_asal, kode_biaya_studi, kode_pekerjaan, tempat_kerja, kode_pt_kerja', 'length', 'max'=>55),
			array('asal_pt, ktp, dusun', 'length', 'max'=>30),
			array('kode_ps_kerja, nip_promotor, nip_co_promotor4', 'length', 'max'=>44),
			array('nip_co_promotor1', 'length', 'max'=>11),
			array('nip_co_promotor2', 'length', 'max'=>12),
			array('nip_co_promotor3', 'length', 'max'=>33),
			array('photo_mahasiswa, alamat', 'length', 'max'=>255),
			array('berat, tinggi', 'length', 'max'=>3),
			array('desa, kecamatan, warga_negara, status_sipil', 'length', 'max'=>100),
			array('jenis_tinggal, no_kps, agama', 'length', 'max'=>20),
			array('penerima_kps, masuk_kelas', 'length', 'max'=>1),
			array('provinsi, gol_darah, kampus', 'length', 'max'=>2),
			array('tgl_lahir, tgl_masuk, tgl_lulus, keterangan, tgl_sk_yudisium', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_pt, kode_fakultas, kode_prodi, kode_jenjang_studi, nim_mhs, nama_mahasiswa, tempat_lahir, tgl_lahir, jenis_kelamin, tahun_masuk, semester_awal, batas_studi, asal_propinsi, tgl_masuk, tgl_lulus, status_aktivitas, status_awal, jml_sks_diakui, nim_asal, asal_pt, nama_asal_pt, asal_jenjang_studi, asal_prodi, kode_biaya_studi, kode_pekerjaan, tempat_kerja, kode_pt_kerja, kode_ps_kerja, nip_promotor, nip_co_promotor1, nip_co_promotor2, nip_co_promotor3, nip_co_promotor4, photo_mahasiswa, semester, keterangan, status_bayar, telepon, hp, email, alamat, berat, tinggi, ktp, rt, rw, dusun, kode_pos, desa, kecamatan, jenis_tinggal, penerima_kps, no_kps, provinsi, kabupaten, warga_negara, status_sipil, agama, gol_darah, masuk_kelas, tgl_sk_yudisium, status_mahasiswa, kampus', 'safe', 'on'=>'search'),
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
			'kode_fakultas' => 'Kode Fakultas',
			'kode_prodi' => 'Kode Prodi',
			'kode_jenjang_studi' => 'Kode Jenjang Studi',
			'nim_mhs' => 'Nim Mhs',
			'nama_mahasiswa' => 'Nama Mahasiswa',
			'tempat_lahir' => 'Tempat Lahir',
			'tgl_lahir' => 'Tgl Lahir',
			'jenis_kelamin' => 'Jenis Kelamin',
			'tahun_masuk' => 'Tahun Masuk',
			'semester_awal' => 'Semester Awal',
			'batas_studi' => 'Batas Studi',
			'asal_propinsi' => 'Asal Propinsi',
			'tgl_masuk' => 'Tgl Masuk',
			'tgl_lulus' => 'Tgl Lulus',
			'status_aktivitas' => 'Status Aktivitas',
			'status_awal' => 'Status Awal',
			'jml_sks_diakui' => 'Jml Sks Diakui',
			'nim_asal' => 'Nim Asal',
			'asal_pt' => 'Asal Pt',
			'nama_asal_pt' => 'Nama Asal Pt',
			'asal_jenjang_studi' => 'Asal Jenjang Studi',
			'asal_prodi' => 'Asal Prodi',
			'kode_biaya_studi' => 'Kode Biaya Studi',
			'kode_pekerjaan' => 'Kode Pekerjaan',
			'tempat_kerja' => 'Tempat Kerja',
			'kode_pt_kerja' => 'Kode Pt Kerja',
			'kode_ps_kerja' => 'Kode Ps Kerja',
			'nip_promotor' => 'Nip Promotor',
			'nip_co_promotor1' => 'Nip Co Promotor1',
			'nip_co_promotor2' => 'Nip Co Promotor2',
			'nip_co_promotor3' => 'Nip Co Promotor3',
			'nip_co_promotor4' => 'Nip Co Promotor4',
			'photo_mahasiswa' => 'Photo Mahasiswa',
			'semester' => 'Semester',
			'keterangan' => 'Keterangan',
			'status_bayar' => 'Status Bayar',
			'telepon' => 'Telepon',
			'hp' => 'Hp',
			'email' => 'Email',
			'alamat' => 'Alamat',
			'berat' => 'Berat',
			'tinggi' => 'Tinggi',
			'ktp' => 'Ktp',
			'rt' => 'Rt',
			'rw' => 'Rw',
			'dusun' => 'Dusun',
			'kode_pos' => 'Kode Pos',
			'desa' => 'Desa',
			'kecamatan' => 'Kecamatan',
			'jenis_tinggal' => 'Jenis Tinggal',
			'penerima_kps' => 'Penerima Kps',
			'no_kps' => 'No Kps',
			'provinsi' => 'Provinsi',
			'kabupaten' => 'Kabupaten',
			'warga_negara' => 'Warga Negara',
			'status_sipil' => 'Status Sipil',
			'agama' => 'Agama',
			'gol_darah' => 'Gol Darah',
			'masuk_kelas' => 'Masuk Kelas',
			'tgl_sk_yudisium' => 'Tgl Sk Yudisium',
			'status_mahasiswa' => 'Status Mahasiswa',
			'kampus' => 'Kampus',
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
		$criteria->compare('kode_prodi',$this->kode_prodi,true);
		$criteria->compare('kode_jenjang_studi',$this->kode_jenjang_studi,true);
		$criteria->compare('nim_mhs',$this->nim_mhs,true);
		$criteria->compare('nama_mahasiswa',$this->nama_mahasiswa,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('tahun_masuk',$this->tahun_masuk,true);
		$criteria->compare('semester_awal',$this->semester_awal,true);
		$criteria->compare('batas_studi',$this->batas_studi,true);
		$criteria->compare('asal_propinsi',$this->asal_propinsi,true);
		$criteria->compare('tgl_masuk',$this->tgl_masuk,true);
		$criteria->compare('tgl_lulus',$this->tgl_lulus,true);
		$criteria->compare('status_aktivitas',$this->status_aktivitas,true);
		$criteria->compare('status_awal',$this->status_awal,true);
		$criteria->compare('jml_sks_diakui',$this->jml_sks_diakui,true);
		$criteria->compare('nim_asal',$this->nim_asal,true);
		$criteria->compare('asal_pt',$this->asal_pt,true);
		$criteria->compare('nama_asal_pt',$this->nama_asal_pt,true);
		$criteria->compare('asal_jenjang_studi',$this->asal_jenjang_studi,true);
		$criteria->compare('asal_prodi',$this->asal_prodi,true);
		$criteria->compare('kode_biaya_studi',$this->kode_biaya_studi,true);
		$criteria->compare('kode_pekerjaan',$this->kode_pekerjaan,true);
		$criteria->compare('tempat_kerja',$this->tempat_kerja,true);
		$criteria->compare('kode_pt_kerja',$this->kode_pt_kerja,true);
		$criteria->compare('kode_ps_kerja',$this->kode_ps_kerja,true);
		$criteria->compare('nip_promotor',$this->nip_promotor,true);
		$criteria->compare('nip_co_promotor1',$this->nip_co_promotor1,true);
		$criteria->compare('nip_co_promotor2',$this->nip_co_promotor2,true);
		$criteria->compare('nip_co_promotor3',$this->nip_co_promotor3,true);
		$criteria->compare('nip_co_promotor4',$this->nip_co_promotor4,true);
		$criteria->compare('photo_mahasiswa',$this->photo_mahasiswa,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('status_bayar',$this->status_bayar);
		$criteria->compare('telepon',$this->telepon,true);
		$criteria->compare('hp',$this->hp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('berat',$this->berat,true);
		$criteria->compare('tinggi',$this->tinggi,true);
		$criteria->compare('ktp',$this->ktp,true);
		$criteria->compare('rt',$this->rt,true);
		$criteria->compare('rw',$this->rw,true);
		$criteria->compare('dusun',$this->dusun,true);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('desa',$this->desa,true);
		$criteria->compare('kecamatan',$this->kecamatan,true);
		$criteria->compare('jenis_tinggal',$this->jenis_tinggal,true);
		$criteria->compare('penerima_kps',$this->penerima_kps,true);
		$criteria->compare('no_kps',$this->no_kps,true);
		$criteria->compare('provinsi',$this->provinsi,true);
		$criteria->compare('kabupaten',$this->kabupaten,true);
		$criteria->compare('warga_negara',$this->warga_negara,true);
		$criteria->compare('status_sipil',$this->status_sipil,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('gol_darah',$this->gol_darah,true);
		$criteria->compare('masuk_kelas',$this->masuk_kelas,true);
		$criteria->compare('tgl_sk_yudisium',$this->tgl_sk_yudisium,true);
		$criteria->compare('status_mahasiswa',$this->status_mahasiswa);
		$criteria->compare('kampus',$this->kampus,true);
		$criteria->order = 'nim_mhs DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mastermahasiswa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
