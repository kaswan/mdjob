<?php 
App::uses('AppModel', 'Model');

class ContactPerson extends AppModel {
	
	public $belongsTo = array('Institution' => array('counterCache' => true));
	
	public function beforeSave($options = array()) {
		if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey]))$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
		$this->data[$this->alias]['direct_phone_number'] = str_replace('−','-',$this->data[$this->alias]['direct_phone_number']);
		$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
		return true;
	}
    
}

?>