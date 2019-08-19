<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property integer $role_id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string $reset_hash
 * @property string $last_login
 * @property string $last_ip
 * @property string $created_on
 * @property integer $deleted
 * @property integer $reset_by
 * @property integer $banned
 * @property string $ban_message
 * @property string $display_name
 * @property string $display_name_changed
 * @property string $timezone
 * @property string $language
 * @property integer $active
 * @property string $activate_hash
 * @property integer $password_iterations
 * @property integer $force_password_reset
 * @property string $nim
 * @property integer $status_data
 * @property string $kampus
 * @property string $fakultas
 * @property string $prodi
 */
class Users extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password_hash, password_iterations', 'required'),
			array('role_id, deleted, reset_by, banned, active, password_iterations, force_password_reset, status_data', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>120),
			array('username', 'length', 'max'=>30),
			array('password_hash', 'length', 'max'=>60),
			array('reset_hash, last_ip, activate_hash', 'length', 'max'=>40),
			array('ban_message, display_name', 'length', 'max'=>255),
			array('timezone', 'length', 'max'=>4),
			array('language, nim', 'length', 'max'=>20),
			array('kampus, fakultas, prodi', 'length', 'max'=>10),
			array('last_login, created_on, display_name_changed', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role_id, email, username, password_hash, reset_hash, last_login, last_ip, created_on, deleted, reset_by, banned, ban_message, display_name, display_name_changed, timezone, language, active, activate_hash, password_iterations, force_password_reset, nim, status_data, kampus, fakultas, prodi', 'safe', 'on'=>'search'),
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
			'role_id' => 'Role',
			'email' => 'Email',
			'username' => 'Username',
			'password_hash' => 'Password Hash',
			'reset_hash' => 'Reset Hash',
			'last_login' => 'Last Login',
			'last_ip' => 'Last Ip',
			'created_on' => 'Created On',
			'deleted' => 'Deleted',
			'reset_by' => 'Reset By',
			'banned' => 'Banned',
			'ban_message' => 'Ban Message',
			'display_name' => 'Display Name',
			'display_name_changed' => 'Display Name Changed',
			'timezone' => 'Timezone',
			'language' => 'Language',
			'active' => 'Active',
			'activate_hash' => 'Activate Hash',
			'password_iterations' => 'Password Iterations',
			'force_password_reset' => 'Force Password Reset',
			'nim' => 'Nim',
			'status_data' => 'Status Data',
			'kampus' => 'Kampus',
			'fakultas' => 'Fakultas',
			'prodi' => 'Prodi',
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
		$criteria->addSearchCondition('role_id',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('email',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('username',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('password_hash',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('reset_hash',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('last_login',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('last_ip',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('created_on',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('deleted',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('reset_by',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('banned',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('ban_message',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('display_name',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('display_name_changed',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('timezone',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('language',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('active',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('activate_hash',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('password_iterations',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('force_password_reset',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('nim',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('status_data',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('kampus',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('fakultas',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('prodi',$this->SEARCH,true,'OR');

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
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
