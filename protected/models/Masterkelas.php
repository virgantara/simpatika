<?php

/**
 * This is the model class for table "{{masterkelas}}".
 *
 * The followings are the available columns in table '{{masterkelas}}':
 * @property integer $id
 * @property string $tahun_akademik
 * @property string $kd_kelas
 * @property string $nama_kelas
 * @property string $kuota
 * @property string $keterangan
 * @property integer $id_kampus
 */
class Masterkelas extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{masterkelas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tahun_akademik, kd_kelas, nama_kelas, kuota, keterangan', 'required'),
			array('id_kampus', 'numerical', 'integerOnly'=>true),
			array('tahun_akademik', 'length', 'max'=>5),
			array('kd_kelas, nama_kelas, kuota', 'length', 'max'=>10),
			array('keterangan', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tahun_akademik, kd_kelas, nama_kelas, kuota, keterangan, id_kampus', 'safe', 'on'=>'search'),
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
			'kd_kelas' => 'Kd Kelas',
			'nama_kelas' => 'Nama Kelas',
			'kuota' => 'Kuota',
			'keterangan' => 'Keterangan',
			'id_kampus' => 'Id Kampus',
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
		$criteria->addSearchCondition('tahun_akademik',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kd_kelas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nama_kelas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kuota',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('keterangan',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('id_kampus',$this->SEARCH,true,'OR');

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
	 * @return Masterkelas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
