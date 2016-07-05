<?php
App::uses('AppController', 'Controller');
 
class InstitutionsController extends AppController {

	public $uses = array('Institution','Prefecture', 'UploadDocument', 'ContactPerson',);
	public $components = array('Paginator','Mpdf','RequestHandler' => array(
					'viewClassMap' => array('csv' => 'CsvView.Csv')
			));
	public $paginate = array(
			'limit' => 100,
			'order' => array(				
				'Institution.id' => 'ASC'
			)
	);
	
	public function beforeFilter() {
		$this->layout = 'institution';
		
		$prefecure_lists = Cache::read('lists','prefecture');
		if (!$prefecure_lists) {
			$prefecure_lists = $this->Prefecture->find('list',array('fields' => array('id', 'prefecture_name')));
			Cache::write('lists', $prefecure_lists, 'prefecture');
		}
		$this->set('prefectures', $prefecure_lists);
		
		$user = Cache::read('lists','user');
		if (!$user) {
			$user = $this->User->find('list',array('fields' => array('id', 'name')));
			Cache::write('lists', $user, 'user');
		}
		$this->set('users', $user);
	}
	
	public function index() {
				
		$conditions['Institution.deleted'] = false;		
		
		if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Institution'])){
			//pr($this->data['Institution']);
			$filter_url['controller'] = $this->request->params['controller'];
			$filter_url['action'] = $this->request->params['action'];
			// We need to overwrite the page every time we change the parameters
			$filter_url['page'] = 1;
		
			// for each filter we will add a GET parameter for the generated url
			foreach($this->data['Institution'] as $name => $value){
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
								array('Institution.freeword LIKE ' => '%' . $value . '%'),
						);
					} elseif ($param_name == 'prefecture'){
						$conditions['Institution.prefecture_id'] = $value;
					} elseif ($param_name == 'phone'){
						$conditions['OR'] = array(
								array('Institution.phone LIKE ' => '%' . $value . '%'),
								array('Institution.tel LIKE ' => '%' . $value . '%'),
						);
					} else {
						$conditions['Institution.'.$param_name] = $value;
					}
					$this->request->data['Institution'][$param_name] = $value;
				}
			}
		}
		$this->Paginator->settings = $this->paginate;
		$this->Institution->recursive = 0;
		$this->Paginator->settings = array(
				'conditions' => $conditions, 
				'limit' => 100,
				'order' => array(				   
// 				   'Institution.created_at' => 'DESC',
				   'Institution.id' => 'ASC'
			));
		$this->set('institutions', $this->Paginator->paginate());
	}

		
	public function add() {

		if ($this->request->is('post')) {
			foreach ($this->request->data['UploadDocument'] as $key => $val) {
				if (empty($val['document']['name'])) {
					unset($this->request->data['UploadDocument'][$key]);
				}
			}
			$this->request->data['Institution']['created_at'] = date("Y-m-d H:i:s");
			if ($this->Institution->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('施設登録しました。'));
				return $this->redirect(array('action' => 'view', $this->Institution->id));
			}
			$this->Session->setFlash('施設情報を保存できませんでした。もう一度試してください。');
		}
	}

	
	public function edit($id = null) {
				
		$this->Institution->id = $id;		
		if (!$this->Institution->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!empty($this->request->data['ContactPerson'])){
				$contact_res = Hash::extract($this->request->data['ContactPerson'], '{n}.id');
				$condition = array('institution_id' => $this->Institution->id, 'NOT' => array('ContactPerson.id' => $contact_res));
				$this->ContactPerson->deleteAll($condition,false);
			
			}else{
				$condition = array('institution_id' => $this->Applicant->id);
				$this->ContactPerson->deleteAll($condition,false);
			}
			
			if(!empty($this->request->data['UploadDocument'])){
				$upload_res = Hash::extract($this->request->data['UploadDocument'], '{n}.id');
				$condition = array('target_id' => $this->Institution->id, 'type' => 'Institution', 'NOT' => array('UploadDocument.id' => $upload_res));
				$this->UploadDocument->deleteAll($condition,false);
				foreach ($this->request->data['UploadDocument'] as $key => $val) {
					if (empty($val['document']['name'])) {
						unset($this->request->data['UploadDocument'][$key]);
					}
				}
			}else{
				$condition = array('target_id' => $this->Institution->id, 'type' => 'Institution');
				$this->UploadDocument->deleteAll($condition,false);
			}
			
			if ($this->Institution->saveAssociated($this->request->data)) {
				$this->Session->setFlash('保存しました。');
				return $this->redirect(array('action' => 'view', $this->Institution->id));
			}
			$this->Session->setFlash('保存できませんでした。もう一度試してください。');
		} else {
			$this->request->data = $this->Institution->read(null, $id);
		}
	}

	public function view($id = null) {
		$this->Institution->id = $id;
	
		if (!$this->Institution->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('institution', $this->Institution->read(null, $id));
	}
	/**
	 * CSV DATA DOWNLOAD (ONLY ALLOW TO ADMIN)
	 */
	public function export() {
		if(AuthComponent::user('role') != 'admin') return $this->redirect(array('action' => 'index'));
		$institutions = $this->Institution->find('all');
		$_serialize = 'institutions';
		$_header = array(
				'ID', '法人名', 'ふりがな', '名称', 'ふりがな', 
				'〒', '都道府県', '住所', '最寄駅', 'TEL', 'FAX', 'Email', 'URL',
				'区分', '科目', '病床数', '看護基準', '利用者数', '想定年収', 
				'契約締結年月', '契約パーセンテージ', '返金規定', '書類関係', '面接情報', '備考',
				'登録日時', '最終更新日時');
		$_extract = array(
				'Institution.id', 
				'Institution.corporate_name',
				'Institution.corporate_furigana',
				'Institution.name',
				'Institution.furigana',
				'Institution.postalcode',
				'Prefecture.prefecture_name',
				'Institution.address',
				'Institution.nearest_station',
				'Institution.tel',
				'Institution.fax',
				'Institution.email',
				'Institution.url',
				'Institution.classification',
				'Institution.clinical_departments',
				'Institution.number_of_beds',
				'Institution.nursing_standards',
				'Institution.number_of_users',
				'Institution.expected_annual_income',
				'Institution.agreement_date',
				'Institution.contract_percentage',
				'Institution.contract_refund_policy',
				'Institution.contract_document',
				'Institution.interview_information',
				'Institution.other',
				'Institution.created_at',
				'Institution.updated_at');
		$_enclosure = '"';
		$_null = '';
		$_delimiter = chr(9); //tab
		$this->viewClass = 'CsvView.Csv';
		$this->set(compact('institutions', '_serialize', '_header', '_extract', '_enclosure', '_null', '_delimiter'));
	}
	
	public function delete($id = null) {
		$this->Institution->id = $id;
		if (!$this->Institution->exists()) {
			throw new NotFoundException(__('削除権限ありません'));
		}
		if(AuthComponent::user('role') == 'admin'){
			if ($this->Institution->saveField('deleted', true)) {
				$this->Session->setFlash("登録情報を削除しました");
				return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash('削除出来ませんでした。');
		return $this->redirect(array('action' => 'index'));
	}	

}
?>