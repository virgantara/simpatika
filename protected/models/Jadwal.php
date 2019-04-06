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
	public $SEARCH;
	public $PAGE_SIZE = 10;
	public $KODEPRODI = 0;


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
			array('hari, jam_ke, kode_mk, kode_dosen, semester, kelas, prodi, kampus', 'required'),
			array('kuota_kelas', 'numerical', 'integerOnly'=>true),
			array('hari, bobot_formatif, bobot_uts, bobot_uas', 'length', 'max'=>30),
			array('jam, kode_mk, kode_dosen, kd_ruangan', 'length', 'max'=>20),
			array('jam_mulai, jam_selesai', 'type', 'type'=>'datetime', 'datetimeFormat'=>'hh:mm','message'=>'Format {attribute} tidak sesuai. Gunakan format hh:mm'),
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
			array('id, hari, jam_ke, jam, jam_mulai, jam_selesai, kode_mk, nama_mk, kode_dosen, nama_dosen, semester, kelas, fakultas, nama_fakultas, prodi, nama_prodi, kd_ruangan, tahun_akademik, kuota_kelas, kampus, presensi, materi, bobot_formatif, bobot_uts, bobot_uas, bobot_harian1, bobot_harian, bentrok, bentrok_with, creatd, modified', 'safe', 'on'=>'search'),
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

	public function findJadwalDosenParalel($jadwal)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		$dosen = $jadwal->kode_dosen;
		$hari = $jadwal->hari;
		$jam = $jadwal->jam_mulai;
		$kampus = $jadwal->kampus;
		$nama_mk = $jadwal->nama_mk;
		// $tahunaktif = $jadwal->tahun_akademik;
		$semester = $jadwal->semester;

		$model = Yii::app()->db->createCommand()
	    ->select('*, t.id as idjadwal')
	    ->from('simak_jadwal_temp t')
	    ->join('m_hari h', 'h.nama_hari=t.hari')
	    ->join('m_jam j', 'j.id_jam=t.jam_ke')
	    ->join('simak_mastermatakuliah m', 'm.kode_mata_kuliah=t.kode_mk')
	    ->join('simak_kampus km', 'km.id=t.kampus')
	    ->join('simak_masterkelas kls', 'kls.id=t.kelas')
	    ->where('kampus=:p2 AND kode_dosen=:p3 AND hari=:p4 AND t.jam_mulai=:p5 AND t.tahun_akademik=:p6 AND t.semester=:p7 AND t.nama_mk =:p8', array(
	    	':p2' => $kampus,
			':p3' => $dosen,
			':p4' => $hari,
			':p5' => $jam,
			':p6' => $tahunaktif,
			':p7' => $semester,
			':p8'=> $nama_mk))
	    ->group('idjadwal')
	    ->queryAll();

		// $criteria=new CDbCriteria;
		// $criteria->addCondition('kampus=:p2 AND kode_dosen=:p3 AND hari=:p4 AND jam_mulai=:p5 AND tahun_akademik =:p6 AND semester =:p7 AND nama_mk=:p8');
		// $criteria->params = array(
		// 	// ':p1'=> $prodi,
		// 	':p2' => $kampus,
		// 	':p3' => $dosen,
		// 	':p4' => $hari,
		// 	':p5' => $jam,
		// 	':p6' => $tahunaktif,
		// 	':p7' => $semester,
		// 	':p8'=> $nama_mk
		// );
		// $jadwals = Jadwal::model()->findAll($criteria);	

		return $model;
	}

	public function updateParalel($dosen, $hari, $jam, $kampus, $mk, $tahunaktif, $semester)
	{
		$params = array(
			'kode_dosen' => $dosen,
			'hari' => $hari,
			'jam_mulai' => $jam_mulai,
			'kampus' => $kampus,
			'kode_mk' => $mk,
			'semester' => $semester,
			'tahun_akademik' => $tahunaktif,
		);

		$jadwals = Jadwal::model()->findAllByAttributes($params);

		foreach($jadwals as $jadwal)
		{
			$jadwal->bentrok = 2;
			$jadwal->save(false,array('bentrok'));
		}			
	}

	public function findListParalel($jam, $hari, $semester)
	{
		$tahunaktif = Yii::app()->request->cookies['tahunaktif']->value;
		$params = array(
			// 'kode_dosen' => $kode_dosen,
			'hari' => $hari,
			'semester' => $semester,
			'tahun_akademik' => $tahunaktif,
			'jam_mulai' => $jam,
			'bentrok' => 2
		);

		$jadwals = Jadwal::model()->findAllByAttributes($params);
		return $jadwals;
	}

	public function findListBentrok($kode_dosen, $jam, $hari)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;

		$params = array(
			'kode_dosen' => $kode_dosen,
			'hari' => $hari,
			// 'semester' => $semester,
			'tahun_akademik' => $tahunaktif,
			'jam_mulai' => $jam,
			'bentrok' => 1
		);

		$jadwals = Jadwal::model()->findAllByAttributes($params);
		return $jadwals;
	}

	public function cekKonflik($m)
	{

		// $jam = $jam.':00';
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;

		$criteria=new CDbCriteria;
		$criteria->addCondition('kode_dosen=:p3 AND hari=:p4 AND jam_mulai=:p5 AND tahun_akademik =:p6');
		$criteria->params = array(
			// ':p1'=> $prodi,
			// ':p2' => $m->kampus,
			':p3' => $m->kode_dosen,
			':p4' => $m->hari,
			':p5' => $m->jam_mulai,
			':p6' => $tahunaktif,
			// ':p7' => $semester,
			// ':p8'=> $kode_mk
		);

		// $m->bentrok = 0;
		// $m->save(save(false,array('bentrok'));
		
		$jadwals = Jadwal::model()->findAll($criteria);
		$is_bentrok = false;
		$bentrok_with = '';
		foreach($jadwals as $jadwal)
		{
			if($m->id != $jadwal->id)
			{
				$is_bentrok = true;
				$jadwal->bentrok = 1;
				$jadwal->save(false,array('bentrok'));
				
				$bentrok_with .= $jadwal->id.'|';
			}

			// else{
			// 	$is_bentrok = false;
			// }
		}	

		if($is_bentrok)
		{
			$m->bentrok = 1;
			$m->bentrok_with = $bentrok_with;
			$m->save(false,array('bentrok','bentrok_with'));
		}

		$criteria=new CDbCriteria;
		$criteria->addCondition('kampus=:p2 AND kode_dosen=:p3 AND hari=:p4 AND jam_mulai=:p5 AND tahun_akademik =:p6 AND semester =:p7 AND nama_mk=:p8');
		$criteria->params = array(
			// ':p1'=> $prodi,
			':p2' => $m->kampus,
			':p3' => $m->kode_dosen,
			':p4' => $m->hari,
			':p5' => $m->jam_mulai,
			':p6' => $tahunaktif,
			':p7' => $m->semester,
			':p8'=> $m->nama_mk
		);
		$jadwals = Jadwal::model()->findAll($criteria);	

		foreach($jadwals as $jadwal)
		{

			if($jadwal->prodi != $m->prodi)
			{
			// paralel
				$jadwal->bentrok_with = '-';
				$jadwal->bentrok = 2;
				$jadwal->save(false,array('bentrok','bentrok_with'));
				$m->bentrok = 2;
				$m->bentrok_with = '-';
				$m->save(false,array('bentrok','bentrok_with'));
			}
		}			


		

		// update paralel
		// $this->updateParalel($dosen, $hari, $jam, $kampus, $mk, $tahunaktif, $semester);
		// return $isconflict;
	}

	public function countBentrok()
	{	
		// $tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		// $tahunaktif = $tahun_akademik->tahun_id;
		// $criteria=new CDbCriteria;
		// $criteria->addCondition('t.bentrok=1 AND tahun_akademik='.$tahunaktif);
		// $model = Jadwal::model()->findAll($criteria);	

		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$criteria=new CDbCriteria;
		$criteria->compare('bentrok',1);
		$criteria->compare('tahun_akademik',$tahun_akademik->tahun_id);
		// $criteria->join = 'JOIN m_hari h ON h.nama_hari = t.hari';
		$criteria->order = 'kode_dosen ASC';
		// $criteria->group = 'kode_dosen';
		$model = Jadwal::model()->findAll($criteria);	

		return count($model);
	}

	public function findDosenInJadwalByProdi($id)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.kode_prodi="'.$id.'" AND t.tahun_akademik='.$tahunaktif);
		$model = Jadwal::model()->find($criteria);	

		return $model;
	}

	public function findDosenInJadwal($id)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		$model = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from('simak_jadwal_temp t')
	    ->join('m_hari h', 'h.nama_hari=t.hari')
	    ->join('simak_masterdosen d', 'd.nidn=t.kode_dosen')
	    ->join('m_jam j', 'j.id_jam=t.jam_ke')
	    ->join('simak_mastermatakuliah m', 'm.kode_mata_kuliah=t.kode_mk')
	    ->join('simak_kampus km', 'km.id=t.kampus')
	    ->join('simak_masterkelas kls', 'kls.id=t.kelas')
	    ->where('kode_dosen=:p1 AND t.tahun_akademik=:p2', array(':p1'=>$id,':p2'=>$tahunaktif))
	    ->group('t.kode_dosen')
	    ->order('d.nama_dosen')
	    ->queryAll();

		return $model;
	}

	public function findJadwalPerProdi($id)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		$criteria=new CDbCriteria;
		// $criteria->join = 'JOIN simak_jadwal_temp j ON j.kode_dosen = t.nidn';
		$criteria->addCondition('t.prodi='.$id.' AND tahun_akademik='.$tahunaktif);
		$criteria->group = 't.kode_dosen';
		$model = Jadwal::model()->findAll($criteria);	

		return $model;
	}

	public function findProdiInJadwal()
	{
		$criteria=new CDbCriteria;
		// $criteria->join = 'JOIN simak_masterdosen d ON t.kode_prodi = d.kode_prodi ';
		$criteria->join .= 'JOIN simak_jadwal_temp j ON j.prodi = t.kode_prodi';
		$criteria->order = 't.kode_fakultas';
		// $criteria->join = 'JOIN simak_jadwal_temp j ON j.prodi = t.kode_prodi';

		// $criteria->group = 't.kode_prodi';
		$model = Masterprogramstudi::model()->findAll($criteria);	

		return $model;
	}

	public function findProdi()
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;

		$criteria=new CDbCriteria;
		// $criteria->join = 'JOIN simak_masterdosen d ON t.kode_prodi = d.kode_prodi ';
		$criteria->join = 'JOIN simak_jadwal_temp j ON j.prodi = t.kode_prodi';
		$criteria->addCondition('j.tahun_akademik=:p1');
		$criteria->params = array(':p1'=>$tahunaktif);
		
		$criteria->order = 't.kode_fakultas';
		// $criteria->join = 'JOIN simak_jadwal_temp j ON j.prodi = t.kode_prodi';

		// $criteria->group = 't.kode_prodi';
		$model = Masterprogramstudi::model()->findAll($criteria);	

		return $model;
	}

	public function findKampus($id)
	{
		// $tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		// $tahunaktif = $tahun_akademik->tahun_id;
		// $criteria=new CDbCriteria;
		// $criteria->addCondition('prodi= :p1 AND j.tahun_akademik=:p2');
		// $criteria->params = array(':p1'=>$id,':p2'=>$tahunaktif);
		// $criteria->order = 'kode_kampus ASC';
		// $criteria->join = 'JOIN simak_jadwal_temp j ON j.kampus = t.id';
		// $criteria->group = 't.kode_kampus';


		$model = Kampus::model()->findAll();	



		return $model;
	}

	public function findSemester($id, $kampus, $kelas)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		$list_semester = $tahunaktif % 2 == 0 ? [2,4,6,8] : [1,3,5,7];
		
		return $list_semester;
	}

	public function findRekapJadwalPerkampus($id,$kampus)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		$criteria=new CDbCriteria;
		$criteria->addCondition('prodi=:p1 AND kampus = :p2 AND tahun_akademik = :p3');
		$criteria->params = array(
			':p1' =>$id,
			':p2' => $kampus,
			':p3' => $tahunaktif,
		);
		$criteria->order = 'semester ASC';
		$model = Jadwal::model()->findAll($criteria);	

		return $model;
	}

	public function findRekapJadwalPerDosenAllBentrok($kode_dosen)
	{
		
		$criteria=new CDbCriteria;
		// $criteria->compare('tahun_akademik',$tahun_akademik);
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$criteria->addCondition('kode_dosen=:p1 AND bentrok = :p2 AND tahun_akademik=:p3');

		$criteria->params = array(
			':p1' =>$kode_dosen,
			':p2' => 1,
			':p3' => $tahun_akademik->tahun_id
		);
		$model = Jadwal::model()->findAll($criteria);	

		return $model;
	}

	public function findRekapJadwalPerDosenAll($kode_dosen)
	{
		// $criteria=new CDbCriteria;
		// // $criteria->compare('tahun_akademik',$tahun_akademik);
		// $criteria->addCondition('kode_dosen=:p1');
		// $criteria->params = array(
		// 	':p1' =>$kode_dosen
		// );
		// $model = Jadwal::model()->findAll($criteria);	
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$model = Yii::app()->db->createCommand()
	    ->select('DISTINCT(t.id) as idjadwal,t.*,m.sks,j.nama_jam,km.nama_kampus,kls.nama_kelas')
	    ->from('simak_jadwal_temp t')
	    ->join('m_hari h', 'h.nama_hari=t.hari')
	    ->join('m_jam j', 'j.id_jam=t.jam_ke')
	    ->join('simak_mastermatakuliah m', 'm.kode_mata_kuliah=t.kode_mk')
	    ->join('simak_kampus km', 'km.id=t.kampus')
	    ->join('simak_masterkelas kls', 'kls.id=t.kelas')
	    ->where('kode_dosen=:p1 AND t.tahun_akademik=:p2 AND m.tahun_akademik =:p3', [
	    	':p1'=>$kode_dosen,
	    	':p2'=>$tahun_akademik->tahun_id,
	    	':p3'=>$tahun_akademik->tahun_id
	    ])
	    // ->group('idjadwal')
	    ->order('t.kode_dosen ASC')
	    ->queryAll();

		return $model;
	}

	public function findRekapJadwalAllBentrok($tahun_akademik=0)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$criteria=new CDbCriteria;
		$criteria->compare('bentrok',1);
		$criteria->compare('tahun_akademik',$tahun_akademik->tahun_id);
		// $criteria->join = 'JOIN m_hari h ON h.nama_hari = t.hari';
		$criteria->order = 'kode_dosen ASC';
		// $criteria->group = 'kode_dosen';
		$model = Jadwal::model()->findAll($criteria);	

		return $model;
	}

	public function findRekapJadwalAll($tahun_akademik=0)
	{
		// $criteria=new CDbCriteria;
		// // $criteria->compare('tahun_akademik',$tahun_akademik);
		// // $criteria->join = 'JOIN m_hari h ON h.nama_hari = t.hari';
		// $criteria->order = 'kode_dosen ASC';
		// $criteria->group = 'kode_dosen';
		// $model = Jadwal::model()->findAll($criteria);	
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$model = Yii::app()->db->createCommand()
	    ->select('t.*')
	    ->from('simak_jadwal_temp t')
	    // ->join('m_hari h', 'h.nama_hari=t.hari')
	    // ->join('m_jam j', 'j.id_jam=t.jam_ke')
	    // ->join('simak_mastermatakuliah m', 'm.kode_mata_kuliah=t.kode_mk')
	    // ->join('simak_kampus km', 'km.id=t.kampus')
	    // ->join('simak_masterkelas kls', 'kls.id=t.kelas')
	    ->where('t.tahun_akademik=:p1', [':p1'=>$tahun_akademik->tahun_id])
	    // ->group('t.kode_dosen')
	    ->order('t.kode_dosen ASC')
	    ->queryAll();


		return $model;
	}

	public function findRekapJadwalPerkelas($id,$kampus, $kelas, $semester)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$user = Yii::app()->db->createCommand()
	    ->select('t.*,t.id as idjadwal')
	    ->from('simak_jadwal_temp t')
	    // ->join('m_hari h', 'h.nama_hari=t.hari')
	    // ->join('m_jam j', 'j.id_jam=t.jam_ke')
	    // ->join('simak_mastermatakuliah m', 'm.kode_mata_kuliah=t.kode_mk')
	    // ->join('simak_kampus km', 'km.id=t.kampus')
	    // ->join('simak_masterkelas kls', 'kls.id=t.kelas')
	    ->where('t.prodi=:p1 AND t.kampus=:p2 AND t.kelas=:p3 AND t.semester =:p4 AND t.tahun_akademik=:p5 ', array(':p1'=>$id,':p2'=>$kampus,':p3'=>$kelas,':p4'=>$semester,':p5'=>$tahun_akademik->tahun_id))
	    // ->group('t.id')
	    // ->order('h.urutan ASC')
	    ->queryAll();

		// $criteria=new CDbCriteria;
		// $criteria->addCondition('t.prodi=:p1 AND t.kampus=:p2 AND t.kelas=:p3 AND t.semester=:p4');
		// $criteria->params = array(
		// 	':p1' => $id,
		// 	':p2' => $kampus,
		// 	':p3' => $kelas,
		// 	':p4' => $semester
		// );
		// $criteria->join = 'JOIN m_hari h ON h.nama_hari = t.hari';
		// $criteria->order = 'h.urutan ASC';
		// $model = Jadwal::model()->findAll($criteria);	

		return $user;
	}

	public function findJadwalDosen($dosen, $hari, $jamke)
	{
		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$model = Yii::app()->db->createCommand()
	    ->select('t.*,km.nama_kampus,kls.nama_kelas,m.sks')
	    ->from('simak_jadwal_temp t')
	    ->join('m_hari h', 'h.nama_hari=t.hari')
	    ->join('m_jam j', 'j.id_jam=t.jam_ke')
	    ->join('simak_mastermatakuliah m', 'm.kode_mata_kuliah=t.kode_mk')
	    ->join('simak_kampus km', 'km.id=t.kampus')
	    ->join('simak_masterkelas kls', 'kls.id=t.kelas')
	    ->where('kode_dosen=:p1 AND hari=:p2 AND jam_ke=:p3 AND t.tahun_akademik=:p4', array(':p1'=>$dosen,':p2'=>$hari,':p3'=>$jamke,':p4'=>$tahun_akademik->tahun_id))
	    ->queryAll();

		// $params = array(
		// 	'kode_dosen' => $dosen,
		// 	'hari' => $hari,
		// 	'jam_ke' => $jamke
		// );
		// $model = Jadwal::model()->findAllByAttributes($params);

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
			'jam_ke' => 'Jam ke',
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

		$sort = new CSort();
		$criteria=new CDbCriteria;

		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));



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

		$criteria->compare('t.tahun_akademik',$tahun_akademik->tahun_id);
		

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

	public function searchBentrok()
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
		$criteria->compare('bentrok',1,true);

		if(Yii::app()->user->checkAccess(array(WebUser::R_PRODI)))
		{
			
			$prodi = Yii::app()->user->getState('prodi');
			$criteria->compare('prodi',$prodi);	
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	// protected function beforeSave()
	// {
	// 	$this->jam_mulai = $this->jam_mulai.':00';
	// 	$this->jam_selesai = $this->jam_selesai.':00';
	// 	return parent::beforeSave();
	// }

	protected function afterFind()
	{
		$mk = Mastermatakuliah::model()->findByAttributes(array('kode_mata_kuliah'=> $this->kode_mk));
		if(empty($mk)){
			// echo 'Kode MK '.$this->kode_mk.' tidak ada di Master Matakuliah';exit;
		}
		$this->SKS = !empty($mk) ? $mk->sks : 0;
		$this->hari = trim($this->hari);
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
