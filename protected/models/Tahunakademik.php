<?php

/**
 * This is the model class for table "simjad_tahunakademik".
 *
 * The followings are the available columns in table 'simjad_tahunakademik':
 * @property integer $id
 * @property string $tahun_id
 * @property string $tahun
 * @property integer $semester
 * @property string $nama_tahun
 * @property string $buka
 */
class Tahunakademik extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simjad_tahunakademik';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tahun_id, tahun, nama_tahun', 'required'),
			array('semester', 'numerical', 'integerOnly'=>true),
			array('tahun_id', 'length', 'max'=>5),
			array('tahun', 'length', 'max'=>4),
			array('nama_tahun', 'length', 'max'=>50),
			array('buka', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tahun_id, tahun, semester, nama_tahun, buka', 'safe', 'on'=>'search'),
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
			'tahun_id' => 'Tahun',
			'tahun' => 'Tahun',
			'semester' => 'Semester',
			'nama_tahun' => 'Nama Tahun',
			'buka' => 'Buka',
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
		$criteria->compare('tahun_id',$this->tahun_id,true);
		$criteria->compare('tahun',$this->tahun,true);
		$criteria->compare('semester',$this->semester);
		$criteria->compare('nama_tahun',$this->nama_tahun,true);
		$criteria->compare('buka',$this->buka,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tahunakademik the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
