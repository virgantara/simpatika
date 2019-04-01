<?php

/**
 * This is the model class for table "simak_masterkelas".
 *
 * The followings are the available columns in table 'simak_masterkelas':
 * @property integer $id
 * @property string $tahun_akademik
 * @property string $kd_kelas
 * @property string $nama_kelas
 * @property string $kuota
 * @property string $keterangan
 */
class Masterkelas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simak_masterkelas';
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
			'kAMPUS' => array(self::BELONGS_TO, 'Kampus', 'id_kampus'),
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
		$criteria->compare('tahun_akademik',$this->tahun_akademik,true);
		$criteria->compare('kd_kelas',$this->kd_kelas,true);
		$criteria->compare('nama_kelas',$this->nama_kelas,true);
		$criteria->compare('kuota',$this->kuota,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
