<?php

/**
 * This is the model class for table "m_jam".
 *
 * The followings are the available columns in table 'm_jam':
 * @property string $nama_jam
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property integer $id_jam
 * @property string $prefix
 */
class Jam extends CActiveRecord
{

	public $SEARCH;
	public $PAGE_SIZE = 10;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_jam';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_jam', 'length', 'max'=>50),
			array('prefix', 'length', 'max'=>20),
			array('jam_mulai, jam_selesai', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nama_jam, jam_mulai, jam_selesai, id_jam, prefix', 'safe', 'on'=>'search'),
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
			'nama_jam' => 'Nama Jam',
			'jam_mulai' => 'Jam Mulai',
			'jam_selesai' => 'Jam Selesai',
			'id_jam' => 'Id Jam',
			'prefix' => 'Prefix',
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

		$criteria->addSearchCondition('nama_jam',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jam_mulai',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('jam_selesai',$this->SEARCH,true,'OR');
		// $criteria->addSearchCondition('id_jam',$this->SEARCH,true,'OR');
		$criteria->addSearchCondition('prefix',$this->SEARCH,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array(
				'pageSize'=>$this->PAGE_SIZE,

			),
		));
	}

	protected function beforeSave()
	{

		$this->jam_mulai = $this->jam_mulai.':00';
		$this->jam_selesai = $this->jam_selesai.':00';
		return parent::beforeSave();
	}

	public function validatorCompareDateTime($attribute, $params)
    {
        $compareAttribute = $params['compareAttribute'];
        $condition = $params['condition'];
        if ($this->hasErrors($attribute) || $this->hasErrors($compareAttribute) || empty($this->$compareAttribute)) {
            return;
        }
        $validateValue = new DateTime($this->$attribute, new DateTimeZone(Yii::app()->getTimeZone()));
        $compareValue = new DateTime($this->$compareAttribute, new DateTimeZone(Yii::app()->getTimeZone()));
        switch ($condition) {
            case '>=':
                if (($validateValue >= $compareValue) === false) {
                    $this->addError($attribute, sprintf('The value in the "%s" field must be greater than or equal to the value in the "%s" field', $this->getAttributeLabel($attribute), $this->getAttributeLabel($compareAttribute)));
                }
                break;
 
            case '>':
                if (($validateValue > $compareValue) === false) {
                    $this->addError($attribute, sprintf('The value in the "%s" field must be greater than the value in the "%s" field', $this->getAttributeLabel($attribute), $this->getAttributeLabel($compareAttribute)));
                }
                break;
        }
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jam the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
