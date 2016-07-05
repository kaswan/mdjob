<?php 
App::uses('AppModel', 'Model');

class Prefecture extends AppModel {
	
	public $hasMany = array('Applicant');
    
}

?>