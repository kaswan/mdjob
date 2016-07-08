<?php

App::uses('AppController', 'Controller');

class MailMagazineController extends AppController {
	public $uses = array('Applicant', 'Prefecture', 'Area');
	public function beforeFilter() {
		parent::beforeFilter();		
	}
	
	public function index(){
		$area_lists = $this->Area->find('list',array('fields' => array('id', 'area_name')));
		$this->set('areas', $area_lists);
		$prefecure_lists = $this->Prefecture->find('list',array('fields' => array('id', 'prefecture_name', 'area_id')));
		$this->set('prefectures', $prefecure_lists);
	}
	
	
	public function sender(){
		$this->search();
	}
	
	function search(){
		$conditions = array();
		$conditions = array(
				
					'OR' => array(
							'NOT' => array(
							'Applicant.email' => array('',NULL), 'Applicant.email_mobile' => array('',NULL)
									)
					)
				
				
		);
		if(($this->request->is('post') || $this->request->is('put'))){
			// Inspect all the named parameters to apply the filters
			foreach($this->params['named'] as $param_name => $value){
				// Don't apply the default named parameters used for pagination
				if(!in_array($param_name, array('mailToTest','mailFrom','mailSender','mailTitle', 'mailBody'))){
					// You may use a switch here to make special filters
					// like "between dates", "greater than", etc
					
					
					if ($param_name == 'age'){
						$conditions['AND'] = array(array('Applicant.age BETWEEN ? AND ?' => array($value , $value + 5)));
					} elseif ($param_name == 'prefecture'){
						$conditions['Applicant.prefecture_id'] = $value;
					} elseif ($param_name == 'mail_magazine_subscription' && $value != 'all'){
						$conditions['Applicant.'.$param_name] = $value;
					} elseif ($param_name == 'gender' && $value != 'all'){
						$conditions['Applicant.'.$param_name] = $value;
					} else {
						$conditions['Applicant.'.$param_name] = $value;
					}
					$this->request->data['Applicant'][$param_name] = $value;
				}
			}
		}
		
		$conditions['Applicant.deleted'] = false;		
		$this->Applicant->recursive = -1;
		$applicants = $this->Applicant->find('list',array('fields' => array('name','email_combine','id'), 'conditions' => $conditions));
		pr($applicants);
	}
}
?>