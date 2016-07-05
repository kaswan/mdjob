<?php 
App::uses('AppModel', 'Model');

class WorkType extends AppModel {
	
	public $hasMany = array('Applicant');
    
}

?>