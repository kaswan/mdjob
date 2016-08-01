<?php

App::uses('AppController', 'Controller');

class MailMagazineController extends AppController {
	public $uses = array('Applicant', 'Prefecture', 'Area', 'Qualification', 'MailMagazine');
	public function beforeFilter() {
		parent::beforeFilter();		
		
		
		$qualification = Cache::read('lists','qualification');
		if (!$qualification) {
			$qualification = $this->Qualification->find('list',array('fields' => array('name', 'name'), 'order' => 'is_other,id'));
			Cache::write('lists', $qualification, 'qualification');
		}
		$this->set('qualifications', $qualification);
		
		$prefecure_lists = Cache::read('lists','prefecture');
		if (!$prefecure_lists) {
			$prefecure_lists = $this->Prefecture->find('list',array('fields' => array('id', 'prefecture_name')));
			Cache::write('lists', $prefecure_lists, 'prefecture');
		}
		$this->set('prefecure_lists', $prefecure_lists);
	}
	
	public function index(){
		$area_lists = $this->Area->find('list',array('fields' => array('id', 'area_name')));
		$this->set('areas', $area_lists);
		$prefecure_lists = $this->Prefecture->find('list',array('fields' => array('id', 'prefecture_name', 'area_id')));
		$this->set('prefectures', $prefecure_lists);
		
		if(($this->request->is('post') || $this->request->is('put'))){
			foreach($this->params['data'] as $param_name => $value){
				$this->request->data[$param_name] = $value;
			}
		}
	}
	
	public function confirm(){
		if(isset($this->params['data']['confirm'])){
			$this->set('data', $this->params['data']);
			$this->search();
		}
	}
	
	public function sender(){
		$this->search();	
		if($this->params['data']['mailToTest'] != ''){			
			$Email = new CakeEmail();
			$Email->template("mail_magazine",null)
			->emailFormat('text')
			->viewVars(array('body'=>$this->request->data['mailBody'], 'name' => AuthComponent::user('name')))
			->from(array($this->request->data['mailFrom'] => $this->request->data['mailSender']))
			->to(explode(';', $this->request->data['mailToTest']))
			->subject($this->request->data['mailTitle'])
			->send();
				
			$this->Session->setFlash('テスト用メール送信しました。メールを確認ください');
			$this->Session->setFlash('テスト用メールを送信しました。「'. $this->request->data["mailToTest"] .'」を確認ください',  'default', array('class' => 'notice'));
		}else{
		
			if(!empty($applicants)){
				$this->request->data['MailMagazine'] = array(
						'user_id' => AuthComponent::user('id'),
						'title' => $this->params['data']['mailTitle'],
						'body' => $this->params['data']['mailBody'],
						'options' => json_encode($this->params['data']),
						'responses' => json_encode($applicants));
					
				$this->MailMagazine->save($this->request->data);
					
// 				foreach($applicants as $no => $val){
// 					foreach($val as $name => $email){
// 						$Email = new CakeEmail();
// 						$Email->template("mail_magazine",null)
// 						->emailFormat('text')
// 						->viewVars(array('body'=>$this->request->data['mailBody'], 'name' => $name))
// 						->from(array($this->request->data['mailFrom'] => $this->request->data['mailSender']))
// 						->to($email)
// 						->subject($this->request->data['mailTitle'])
// 						->send();
// 					}
// 				}
				$Email = new CakeEmail();
				$Email->template("mail_magazine",null)
				->emailFormat('text')
				->viewVars(array('body'=>$this->request->data['mailBody'], 'name' => AuthComponent::user('name')))
				->from(array($this->request->data['mailFrom'] => $this->request->data['mailSender']))
				->to(AuthComponent::user('email'))
				->subject($this->request->data['mailTitle'])
				->send();
				$this->Session->setFlash('(' . count($applicants) . '件) ' . 'メールマガジンの送信を完了しました。',  'default', array('class' => 'success'));
					
			}else{
				$this->Session->setFlash('選んだ条件でメール送信先を見つかりませんでした。条件を変えて、再度やり直してください。',  'default', array('class' => 'notice'));
			}
		}	
	}
	
	function search(){
		$option = array();
		$conditions = array();
		$conditions = array(
			'OR' => array(
				array('Applicant.email !=' => ''), 
				array('Applicant.email_mobile !=' => '')
			)	
		);
		if(($this->request->is('post') || $this->request->is('put'))){
			// Inspect all the named parameters to apply the filters
			foreach($this->params['data'] as $param_name => $value){
				// Don't apply the default named parameters used for pagination
				if(!in_array($param_name, array('mailToTest','mailFrom','mailSender','mailTitle', 'mailBody', 'send')) && $value != ''){
					// You may use a switch here to make special filters
					// like "between dates", "greater than", etc
					
					
					if ($param_name == 'age_range'){
						$age_ranges = array();
						foreach($value as $age){
						  $age_ranges['OR'][] = array('OR' => array('Applicant.age BETWEEN ? AND ?' => array($age , $age + 5)));
						}
						$conditions['AND'] = $age_ranges;
					} elseif ($param_name == 'prefectures'){
						$conditions['Applicant.prefecture_id'] = $value;
					} elseif ($param_name == 'mail_magazine_subscription' && $value != 'all'){
						$conditions['Applicant.'.$param_name] = $value;
					} elseif ($param_name == 'gender' && $value != 'all'){
						$conditions['Applicant.'.$param_name] = $value;
					} elseif ($param_name == 'qualification'){
				    	$option = array('INNER JOIN qualification_histories AS QualificationHistory ON Applicant.id=QualificationHistory.applicant_id');
		            	$conditions['QualificationHistory.name'] = $value;
					} elseif ($param_name == 'employment_pattern'){
		            	$conditions['Applicant.'.$param_name] = $value;
				    }
				    
				    
					$this->request->data[$param_name] = $value;
				}
			}
		}
		
		$conditions['Applicant.deleted'] = false;
		$this->Applicant->recursive = -1;
		$applicants = $this->Applicant->find('list',array('fields' => array('name','email_combine','id'), 'conditions' => $conditions, 'joins' => $option));
		$this->set('applicants', $applicants);
		
		
				
	}
}
?>