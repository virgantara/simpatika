<?php

/**
 * This is the model class for table "simak_jadwal_lampiran_sk".
 *
 * The followings are the available columns in table 'simak_jadwal_lampiran_sk':
 * @property string $nomor_sk
 * @property string $tanggal_sk
 * @property string $tentang
 * @property string $tanggal_penetapan
 * @property string $bunyi_lampiran
 */
class JadwalLampiranSk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_jadwal_lampiran_sk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nomor_sk, tanggal_sk, tentang, tanggal_penetapan, bunyi_lampiran', 'required'),
			array('nomor_sk, tanggal_sk, tanggal_penetapan', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nomor_sk, tanggal_sk, tentang, tanggal_penetapan, bunyi_lampiran', 'safe', 'on'=>'search'),
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
			'nomor_sk' => 'Nomor Sk',
			'tanggal_sk' => 'Tanggal Sk',
			'tentang' => 'Tentang',
			'tanggal_penetapan' => 'Tanggal Penetapan',
			'bunyi_lampiran' => 'Bunyi Lampiran',
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

		$criteria->compare('nomor_sk',$this->nomor_sk,true);
		$criteria->compare('tanggal_sk',$this->tanggal_sk,true);
		$criteria->compare('tentang',$this->tentang,true);
		$criteria->compare('tanggal_penetapan',$this->tanggal_penetapan,true);
		$criteria->compare('bunyi_lampiran',$this->bunyi_lampiran,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JadwalLampiranSk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
