<?php 
App::uses('AppModel', 'Model');

class QualificationHistory extends AppModel {
	
	public $belongsTo = array('Applicant');
	
	public function beforeSave($options = array()) {
		if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey]))$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
		$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
		return true;
	}
    
}

?>