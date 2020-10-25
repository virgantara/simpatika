<?php

/**
 * This is the model class for table "{{mahasiswa_ortu}}".
 *
 * The followings are the available columns in table '{{mahasiswa_ortu}}':
 * @property integer $id
 * @property string $nim
 * @property string $hubungan
 * @property string $nama
 * @property string $agama
 * @property string $pendidikan
 * @property string $pekerjaan
 * @property string $penghasilan
 * @property string $hidup
 * @property string $alamat
 * @property string $kota
 * @property string $propinsi
 * @property string $negara
 * @property string $pos
 * @property string $telepon
 * @property string $hp
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Mastermahasiswa $nim0
 * @property Pilihan $agama0
 * @property Pilihan $pendidikan0
 * @property Pilihan $pekerjaan0
 * @property Pilihan $penghasilan0
 */
class MahasiswaOrtu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mahasiswa_ortu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nim, kota, propinsi, negara, telepon, hp, email', 'length', 'max'=>20),
			array('hubungan', 'length', 'max'=>4),
			array('nama', 'length', 'max'=>100),
			array('agama, pendidikan, pekerjaan, penghasilan, hidup, pos', 'length', 'max'=>10),
			array('alamat', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nim, hubungan, nama, agama, pendidikan, pekerjaan, penghasilan, hidup, alamat, kota, propinsi, negara, pos, telepon, hp, email', 'safe', 'on'=>'search'),
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
			'agama0' => array(self::BELONGS_TO, 'Pilihan', 'agama','condition'=>'kode = 51'),
			'pendidikan0' => array(self::BELONGS_TO, 'Pilihan', 'pendidikan','condition'=>'kode = "01"'),
			'pekerjaan0' => array(self::BELONGS_TO, 'Pilihan', 'pekerjaan','condition'=>'kode = 55'),
			'penghasilan0' => array(self::BELONGS_TO, 'Pilihan', 'penghasilan','condition'=>'kode = 69'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nim' => 'Nim',
			'hubungan' => 'Hubungan',
			'nama' => 'Nama',
			'agama' => 'Agama',
			'pendidikan' => 'Pendidikan',
			'pekerjaan' => 'Pekerjaan',
			'penghasilan' => 'Penghasilan',
			'hidup' => 'Hidup',
			'alamat' => 'Alamat',
			'kota' => 'Kota',
			'propinsi' => 'Propinsi',
			'negara' => 'Negara',
			'pos' => 'Pos',
			'telepon' => 'Telepon',
			'hp' => 'Hp',
			'email' => 'Email',
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
		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('hubungan',$this->hubungan,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('pendidikan',$this->pendidikan,true);
		$criteria->compare('pekerjaan',$this->pekerjaan,true);
		$criteria->compare('penghasilan',$this->penghasilan,true);
		$criteria->compare('hidup',$this->hidup,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('kota',$this->kota,true);
		$criteria->compare('propinsi',$this->propinsi,true);
		$criteria->compare('negara',$this->negara,true);
		$criteria->compare('pos',$this->pos,true);
		$criteria->compare('telepon',$this->telepon,true);
		$criteria->compare('hp',$this->hp,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MahasiswaOrtu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
