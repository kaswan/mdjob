<?php
App::uses('AppController', 'Controller');
 
class ApplicantsController extends AppController {

	public $uses = array('Applicant','Institution','WorkType','Prefecture', 'ProgressStatus', 'User', 
			'WorkHistory', 'QualificationHistory', 'UploadDocument', 'Post', 'Qualification');
	public $components = array('Paginator','Mpdf', 'RequestHandler');
	public $paginate = array();
	
	public function beforeFilter() {
	    parent::beforeFilter();	
	    
	    $lists = Cache::read('lists','institution');
	    if (!$lists) {
	    	$lists = $this->Institution->find('list',array('fields' => array('id', 'name')));
	    	Cache::write('lists', $lists, 'institution');
	    }
	    $this->set('institution_lists', $lists);
	    
	    $prefecure_lists = Cache::read('lists','prefecture');
	    if (!$prefecure_lists) {
	    	$prefecure_lists = $this->Prefecture->find('list',array('fields' => array('id', 'prefecture_name')));
	    	Cache::write('lists', $prefecure_lists, 'prefecture');
	    }    
	    $this->set('prefectures', $prefecure_lists);
	    
	    $progress_status = Cache::read('lists','progress_status');
	    if (!$progress_status) {
	    	$progress_status = $this->ProgressStatus->find('list',array('fields' => array('id', 'name')));
	    	Cache::write('lists', $progress_status, 'progress_status');
	    }
	    $this->set('statuses', $progress_status);
	    
	    
	    $user = Cache::read('lists','user');
	    if (!$user) {
	    	$user = $this->User->find('list',array('fields' => array('id', 'name')));
	    	Cache::write('lists', $user, 'user');
	    }
	    $this->set('users', $user);
	    
	    $qualification = Cache::read('lists','qualification');
	    if (!$qualification) {
	    	$qualification = $this->Qualification->find('list',array('fields' => array('name', 'name'), 'order' => 'is_other,id'));
	    	Cache::write('lists', $qualification, 'qualification');
	    }
	    $this->set('qualifications', $qualification);
	    
	}
	
	public function index() {
		
		$conditions = array();
		$option = array();
		if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Applicant'])){
			$filter_url['controller'] = $this->request->params['controller'];
			$filter_url['action'] = $this->request->params['action'];
			// We need to overwrite the page every time we change the parameters
			$filter_url['page'] = 1;
		
			// for each filter we will add a GET parameter for the generated url
			foreach($this->data['Applicant'] as $name => $value){
				if($value){
					// You might want to sanitize the $value here
					// or even do a urlencode to be sure
					//$filter_url[$name] = urlencode($value);
					$filter_url[$name] = $value;
				}
			}
			// now that we have generated an url with GET parameters,
			// we'll redirect to that page
			return $this->redirect($filter_url);
		} else {
			// Inspect all the named parameters to apply the filters
			foreach($this->params['named'] as $param_name => $value){
				// Don't apply the default named parameters used for pagination
				if(!in_array($param_name, array('page','sort','direction','limit'))){
					// You may use a switch here to make special filters
					// like "between dates", "greater than", etc
		            if($param_name == "freeword"){
		            	$conditions['OR'] = array(
		            			array('Applicant.freeword LIKE' => '%' . $value . '%')
		            	);
		            } else if($param_name == "gender"){
		            	$conditions['AND'] = array(array('Applicant.gender LIKE' => '%' . $value . '%'));
// 		            }else if($param_name == "phone"){
// 		            	$conditions['AND'] = array(array('Applicant.tel LIKE' => '%' . $value . '%'));
		            } elseif ($param_name == 'age'){
		            	$conditions['AND'] = array(array('Applicant.age BETWEEN ? AND ?' => array($value , $value + 5)));
				    } elseif ($param_name == 'prefecture'){
		            	$conditions['Applicant.prefecture_id'] = $value;
				    } elseif ($param_name == 'qualification'){
				    	$option = array('INNER JOIN qualification_histories AS QualificationHistory ON Applicant.id=QualificationHistory.applicant_id');
		            	$conditions['QualificationHistory.name'] = $value;
				    } else {
		            	$conditions['Applicant.'.$param_name] = $value;
		            }
					$this->request->data['Applicant'][$param_name] = $value;
				}
			}
		}
		# for latest update check applicants and migrate data
		$this->migration();
		
		$conditions['Applicant.deleted'] = false;
		
		$this->Paginator->settings = $this->paginate;
 		$this->Applicant->recursive = 0;
		$this->Paginator->settings = array(
				'conditions' => $conditions, 
				'limit' => 25,
				'joins' => $option,
				'order' => array(
					'Applicant.sort_modified_date' => 'DESC',
				   'Applicant.status' => 'ASC',
				   'Applicant.created_at' => 'DESC'
			));
		$this->set('applicants', $this->Paginator->paginate());
		
		$applicants = $this->Applicant->find('list',array('fields' => array('id'), 'conditions' => $conditions, 'joins' => $option, 'order' => array(
				'Applicant.sort_modified_date' => 'DESC',
				'Applicant.status' => 'ASC',
				'Applicant.created_at' => 'DESC'
			)));
		Cache::write('lists', $applicants, 'applicant');		
		
	}

	public function view($id = null) {
		/*$this->layout = 'default';*/
		$this->Applicant->id = $id;
		$this->Applicant->saveField('status', 'read');
		
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('applicant', $this->Applicant->read(null, $id));
		$this->set('prev', $this->getPrevApplicant($id, Cache::read('lists','applicant')));
		$this->set('next', $this->getNextApplicant($id, Cache::read('lists','applicant')));
	}

	public function print_view($id = null) {
		$this->layout = 'print';
		Configure::write('debug', 0);
		
		// initializing mPDF
		$this->Mpdf->init();
		$date = date('YmdHi');
		// setting filename of output pdf file
		$this->Mpdf->setFilename("{$id}_{$date}.pdf");

		// setting output to I, D, F, S
		$this->Mpdf->setOutput('I');

		// you can call any mPDF method via component, for example:
		$this->Mpdf->SetWatermarkText("Draft");
		
		$this->Applicant->id = $id;
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('applicant', $this->Applicant->read(null, $id));
	}
	
	
	public function entry_sheet($id = null) {
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Applicant->id = $id;
			$this->Applicant->save($this->request->data);
		}
		
		$this->layout = 'print';
		Configure::write('debug', 0);
		
		// initializing mPDF
		$this->Mpdf->init();
		$date = date('YmdHi');
		// setting filename of output pdf file
		$this->Mpdf->setFilename("{$id}_{$date}.pdf");
	
		// setting output to I, D, F, S
		$this->Mpdf->setOutput('I');
	
		// you can call any mPDF method via component, for example:
		$this->Mpdf->SetWatermarkText("Draft");
	
		$this->Applicant->id = $id;
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('applicant', $this->Applicant->read(null, $id));
	}
	
	public function sender_info($id = null){
		$this->set('id', $id);
		$this->request->data = $this->Applicant->read(null, $id);
	}
	
	
	public function add() {
		
		if ($this->request->is('post')) {
			foreach ($this->request->data['UploadDocument'] as $key => $val) {
				if (empty($val['document']['name'])) {
					unset($this->request->data['UploadDocument'][$key]);
				}
			}
			$this->request->data['Applicant']['status'] = 'read';
			$this->request->data['Applicant']['created_at'] = date("Y-m-d H:i:s");
			$this->request->data['Applicant']['sort_modified_date'] = date("Y-m-d H:i:s");
			if ($this->Applicant->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('登録しました。'));
				return $this->redirect(array('action' => 'view', $this->Applicant->id));
			}
			$this->Session->setFlash('保存できませんでした。もう一度試してください。');
		}
	}

	
	public function edit($id = null) {
		
		$this->Applicant->id = $id;
		$this->Applicant->saveField('status', 'read');
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		//pr($this->request->data['QualificationHistory']);
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if(!empty($this->request->data['WorkHistory'])){
				$work_res = Hash::extract($this->request->data['WorkHistory'], '{n}.id');
				$condition = array('applicant_id' => $this->Applicant->id, 'NOT' => array('WorkHistory.id' => $work_res));
				$this->WorkHistory->deleteAll($condition,false);
				
			}else{
				$condition = array('applicant_id' => $this->Applicant->id);
				$this->WorkHistory->deleteAll($condition,false);
			}		
			
			if(!empty($this->request->data['QualificationHistory'])){
				$qualification_res = Hash::extract($this->request->data['QualificationHistory'], '{n}.id');
				$condition = array('applicant_id' => $this->Applicant->id, 'NOT' => array('QualificationHistory.id' => $qualification_res));
				$this->QualificationHistory->deleteAll($condition,false);
				
			}else{
				$condition = array('applicant_id' => $this->Applicant->id);
				$this->QualificationHistory->deleteAll($condition,false);
			}
			
			if(!empty($this->request->data['UploadDocument'])){
				$upload_res = Hash::extract($this->request->data['UploadDocument'], '{n}.id');
				$condition = array('target_id' => $this->Applicant->id, 'type' => 'Applicant', 'NOT' => array('UploadDocument.id' => $upload_res));
				$this->UploadDocument->deleteAll($condition,false);
				foreach ($this->request->data['UploadDocument'] as $key => $val) {
					if (empty($val['document']['name'])) {
						unset($this->request->data['UploadDocument'][$key]);
					}
				}
			}else{
				$condition = array('target_id' => $this->Applicant->id, 'type' => 'Applicant');
				$this->UploadDocument->deleteAll($condition,false);
			}
			
			if ($this->Applicant->saveAssociated($this->request->data)) {
				$this->Session->setFlash('保存しました。');
				return $this->redirect(array('action' => 'view', $this->Applicant->id));
			}
			$this->Session->setFlash('保存できませんでした。もう一度試してください。');
		} else {
			$this->request->data = $this->Applicant->read(null, $id);
		}
	}

	public function modified_date_update($id = null){
		$this->Applicant->id = $id;
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('存在しません'));
		}
		if(AuthComponent::user('role') == 'admin'){
			if ($this->Applicant->saveField('sort_modified_date', date("Y-m-d H:i:s"))) {
				$this->Session->setFlash("新しい方に上げました");
				return $this->redirect($this->referer());
			}
		}
		$this->Session->setFlash('新しい方に上げませんでした。');
		return $this->redirect(array('action' => 'index'));
	}
	
	public function delete($id = null) {
		$this->Applicant->id = $id;
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('削除権限ありません'));
		}
		if(AuthComponent::user('role') == 'admin'){
			if ($this->Applicant->saveField('deleted', true)) {
				$this->Session->setFlash("登録情報を削除しました");
				return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash('削除出来ませんでした。');
		return $this->redirect(array('action' => 'index'));
	}
	
	public function in_place_editing($id = null) {
		Configure::write('debug', 0);
		if (!$id) return;
		if ($this->request->data) {
			# get all the fields with its values (there should be only one, but anyway ...)
			foreach($this->data['Applicant'] as $field => $value){
				
				$this->Applicant->id = $id;
				$this->Applicant->saveField($field, $value);
				if($field == 'progress_status_id'){
					$status = $this->ProgressStatus->read(null, $value);
					$this->set('updated_value', $status['ProgressStatus']['name']);
				}elseif ($field == 'user_id'){
					$user = $this->User->read(null, $value);
					$this->set('updated_value', $user['User']['name']);
				}elseif ($field == 'mail_magazine_subscription'){
					$applicant = $this->Applicant->read(null, $id);
					$this->set('updated_value', $applicant['Applicant']['mail_magazine_subscription'] ? '希望する' : '希望しない');
				}
				
				$this->beforeRender();
				$this->layout = 'ajax';
			}
		}
	}
	
	public function migration(){
		$prefecure_lists = Cache::read('prefecure_lists','default');
		$this->Applicant->recursive = -1;
		$post_entries = $this->Applicant->find('list',array('fields' => array('id','post_id'), 'conditions' => array('post_id <>' => null)));
		if(!empty($post_entries)){
			$posts = $this->Post->find('all', array('conditions' => array('Post.id NOT' => $post_entries)));
		}else{
			$posts = $this->Post->find('all');
		}
		$data = array();
		foreach ($posts as $key => $val){
			$data['Applicant'][] = $this->Post->data_read($val, $prefecure_lists);
		}
	
		if(!empty($data['Applicant']))$this->Applicant->saveMany($data['Applicant'], array('validate' => false,'deep' => true));
		return true;
	}

	function getPrevApplicant($key, $hash = array()) {
		$keys = array_keys($hash);
		$found_index = array_search($key, $keys);
		if ($found_index === false || $found_index === 0) return false;
		return $keys[$found_index - 1];
	}
	
	function getNextApplicant($key, $hash = array()) {
		$keys = array_keys($hash);
		$found_index = array_search($key, $keys);
		if ($found_index === false || end($hash) === $key) return false;
		return $keys[$found_index + 1];
	}
}
?>