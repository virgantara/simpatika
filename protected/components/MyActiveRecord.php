<?php
class MyActiveRecord extends CActiveRecord
{

	public $log_key;


	public function afterSave(){
		
		return parent::afterSave();
	}
	
	public function afterDelete(){
		
		return parent::afterDelete();
	}
}
?>