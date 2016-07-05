<?php 
App::uses('AppModel', 'Model');

class ProgressStatus extends AppModel {
	
	public $hasMany = array('Applicant');
	
	public function beforeSave($options = array()) {
		if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey])){
			$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
		}
		$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
		return true;
	}
	
	public function afterSave($created, $options = Array()){
		return Cache::write('lists', $this->find('list',array('fields' => array('id', 'name'))),'progress_status');
	}
    
}

?>