<?php

/**
 * This is the model class for table "{{matakuliah}}".
 *
 * The followings are the available columns in table '{{matakuliah}}':
 * @property integer $id
 * @property string $kode_mk
 * @property string $nama_mk
 * @property string $nama_mk_en
 * @property string $kode_feeder
 * @property string $created_at
 * @property string $updated_at
 * @property string $prodi
 * @property integer $jenis_mk
 * @property integer $sks_mk
 * @property integer $sks_tm
 * @property integer $sks_prak
 * @property integer $sks_prak_lap
 * @property integer $sks_sim
 * @property string $metode_pelaksanaan_kuliah
 * @property string $tgl_mulai_efektif
 * @property string $tgl_akhir_efektif
 *
 * The followings are the available model relations:
 * @property KurikulumMk[] $kurikulumMks
 * @property Masterprogramstudi $prodi0
 * @property Pilihan $jenisMk
 */
class Matakuliah extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{matakuliah}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_mk, prodi, jenis_mk, sks_mk', 'required'),
			array('jenis_mk, sks_mk, sks_tm, sks_prak, sks_prak_lap, sks_sim', 'numerical', 'integerOnly'=>true),
			array('kode_mk', 'length', 'max'=>25),
			array('nama_mk, nama_mk_en, kode_feeder, metode_pelaksanaan_kuliah', 'length', 'max'=>255),
			array('prodi', 'length', 'max'=>10),
			array('created_at, updated_at, tgl_mulai_efektif, tgl_akhir_efektif', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_mk, nama_mk, nama_mk_en, kode_feeder, created_at, updated_at, prodi, jenis_mk, sks_mk, sks_tm, sks_prak, sks_prak_lap, sks_sim, metode_pelaksanaan_kuliah, tgl_mulai_efektif, tgl_akhir_efektif', 'safe', 'on'=>'search'),
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
			'kurikulumMks' => array(self::HAS_MANY, 'KurikulumMk', 'matakuliah_id'),
			'prodi0' => array(self::BELONGS_TO, 'Masterprogramstudi', 'prodi'),
			'jenisMk' => array(self::BELONGS_TO, 'Pilihan', 'jenis_mk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_mk' => 'Kode Mk',
			'nama_mk' => 'Nama Mk',
			'nama_mk_en' => 'Nama Mk En',
			'kode_feeder' => 'Kode Feeder',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'prodi' => 'Prodi',
			'jenis_mk' => 'Jenis Mk',
			'sks_mk' => 'Sks Mk',
			'sks_tm' => 'Sks Tm',
			'sks_prak' => 'Sks Prak',
			'sks_prak_lap' => 'Sks Prak Lap',
			'sks_sim' => 'Sks Sim',
			'metode_pelaksanaan_kuliah' => 'Metode Pelaksanaan Kuliah',
			'tgl_mulai_efektif' => 'Tgl Mulai Efektif',
			'tgl_akhir_efektif' => 'Tgl Akhir Efektif',
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
		$criteria->addSearchCondition('kode_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_mk_en',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_feeder',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('created_at',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('updated_at',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('prodi',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jenis_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_mk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_tm',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_prak',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_prak_lap',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('sks_sim',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('metode_pelaksanaan_kuliah',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_mulai_efektif',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_akhir_efektif',$this->SEARCH,true,'OR');

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
	 * @return Matakuliah the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
