<?php

/**
 * This is the model class for table "{{pencekalan}}".
 *
 * The followings are the available columns in table '{{pencekalan}}':
 * @property integer $id
 * @property string $tahun_id
 * @property string $nim
 * @property integer $tahfidz
 * @property integer $adm
 * @property integer $akpam
 * @property integer $akademik
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Mastermahasiswa $nim0
 * @property Tahunakademik $tahun
 */
class Pencekalan extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pencekalan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tahun_id, nim', 'required'),
			array('tahfidz, adm, akpam, akademik', 'numerical', 'integerOnly'=>true),
			array('tahun_id', 'length', 'max'=>5),
			array('nim', 'length', 'max'=>25),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tahun_id, nim, tahfidz, adm, akpam, akademik, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'nim0' => array(self::BELONGS_TO, 'Mastermahasiswa', 'nim'),
			'tahun' => array(self::BELONGS_TO, 'Tahunakademik', 'tahun_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tahun_id' => 'Tahun',
			'nim' => 'Nim',
			'tahfidz' => 'Tahfidz',
			'adm' => 'Adm',
			'akpam' => 'Akpam',
			'akademik' => 'Akademik',
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


		$criteria->addSearchCondition('tahun_id',$this->tahun_id,true);
		$criteria->addSearchCondition('nim',$this->nim,true,'OR');
		$criteria->addSearchCondition('tahfidz',$this->tahfidz,true);
		$criteria->addSearchCondition('adm',$this->adm,true);
		$criteria->addSearchCondition('akpam',$this->akpam,true);
		$criteria->addSearchCondition('akademik',$this->akademik,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array(
				'pageSize'=>$this->PAGE_SIZE,

			),
		));
	}

	public static function getListMahasiswa($kampus, $prodi)
	{
		// $tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		// $tahunaktif = $tahun_akademik->tahun_id;
		// $criteria=new CDbCriteria;
		// $criteria->addCondition('tahun_id= :p1 AND m.kode_prodi=:p2 AND m.kampus =:p3');
		// $criteria->params = array(':p1'=>$tahunaktif,':p2'=>$prodi,':p3'=>$kampus);
		// $criteria->order = 'm.nama_mahasiswa ASC';
		// $criteria->join = 'RIGHT JOIN simak_mastermahasiswa m ON m.nim_mhs = t.nim';
		// $criteria->together = true;

		return Mastermahasiswa::model()->findAllByAttributes(['kampus'=>$kampus,'kode_prodi'=>$prodi,'status_aktivitas'=>'A'],['order'=>'nama_mahasiswa ASC']);
	}

	// public function getNamaMahasiswa()
	// {

	// 	return $this->nim0->nama_mahasiswa;
	// }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pencekalan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
