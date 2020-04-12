<?php

/**
 * This is the model class for table "{{sk}}".
 *
 * The followings are the available columns in table '{{sk}}':
 * @property integer $id
 * @property string $kode_prodi
 * @property string $judul
 * @property string $nomor_sk
 * @property string $tanggal
 * @property string $tentang
 * @property string $buka
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Masterprogramstudi $kodeProdi
 */
class Sk extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sk}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_prodi', 'length', 'max'=>15),
			array('judul, nomor_sk, tanggal, tentang', 'length', 'max'=>255),
			array('buka', 'length', 'max'=>1),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_prodi, judul, nomor_sk, tanggal, tentang, buka, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'kodeProdi' => array(self::BELONGS_TO, 'Masterprogramstudi', 'kode_prodi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_prodi' => 'Kode Prodi',
			'judul' => 'Judul',
			'nomor_sk' => 'Nomor Sk',
			'tanggal' => 'Tanggal',
			'tentang' => 'Tentang',
			'buka' => 'Buka',
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

		if(Yii::app()->user->checkAccess([WebUser::R_PRODI]))
		{
			$criteria->compare('kode_prodi',Yii::app()->user->getState('prodi'));
		}

		$criteria->addSearchCondition('judul',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nomor_sk',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tanggal',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('tentang',$this->SEARCH,true,'OR');

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
	 * @return Sk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
