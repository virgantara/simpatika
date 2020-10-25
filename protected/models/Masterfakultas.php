<?php

/**
 * This is the model class for table "{{masterfakultas}}".
 *
 * The followings are the available columns in table '{{masterfakultas}}':
 * @property integer $id
 * @property string $kode_badan_hukum
 * @property string $kode_pt
 * @property string $kode_fakultas
 * @property string $nama_fakultas
 * @property string $tgl_pendirian
 * @property string $pejabat
 * @property string $jabatan
 *
 * The followings are the available model relations:
 * @property Masterdosen $pejabat0
 * @property Masterprogramstudi[] $masterprogramstudis
 */
class Masterfakultas extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{masterfakultas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_badan_hukum, kode_pt, kode_fakultas, nama_fakultas', 'required'),
			array('kode_badan_hukum', 'length', 'max'=>7),
			array('kode_pt', 'length', 'max'=>6),
			array('kode_fakultas', 'length', 'max'=>5),
			array('nama_fakultas', 'length', 'max'=>100),
			array('pejabat', 'length', 'max'=>30),
			array('jabatan', 'length', 'max'=>1),
			array('tgl_pendirian', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_badan_hukum, kode_pt, kode_fakultas, nama_fakultas, tgl_pendirian, pejabat, jabatan', 'safe', 'on'=>'search'),
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
			'pejabat0' => array(self::BELONGS_TO, 'Masterdosen', 'pejabat'),
			'masterprogramstudis' => array(self::HAS_MANY, 'Masterprogramstudi', 'kode_fakultas'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_badan_hukum' => 'Kode Badan Hukum',
			'kode_pt' => 'Kode Pt',
			'kode_fakultas' => 'Kode Fakultas',
			'nama_fakultas' => 'Nama Fakultas',
			'tgl_pendirian' => 'Tgl Pendirian',
			'pejabat' => 'Pejabat',
			'jabatan' => 'Jabatan',
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
		$criteria->addSearchCondition('kode_badan_hukum',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_pt',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kode_fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tgl_pendirian',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('pejabat',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jabatan',$this->SEARCH,true,'OR');

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
	 * @return Masterfakultas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
