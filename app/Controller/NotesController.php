<?php
App::uses('AppController', 'Controller');
 
class NotesController extends AppController {

	public $uses = array('Note','Institution', 'User');		
	
	public function beforeFilter() {
		parent::beforeFilter();		 
		$lists = Cache::read('lists','institution');
		if (!$lists) {
			$lists = $this->Institution->find('list',array('fields' => array('id', 'name')));
			Cache::write('lists', $lists, 'institution');
		}
		$this->set('institution_lists', $lists);
				 
		 
		$user = Cache::read('lists','user');
		if (!$user) {
			$user = $this->User->find('list',array('fields' => array('id', 'name')));
			Cache::write('lists', $user, 'user');
		}
		$this->set('users', $user);
		 
	}
	
	
	public function index() {				
		
	}

		
	public function add($target_id = null, $type = null) {
		
		if($target_id == null || $type == null) return;
		$this->set('target_id', $target_id);
		$this->set('type', $type);
		$this->Note->recursive = -1;
		$result =  $this->Note->find('all', array(
				'conditions' => array('target_id' => $target_id, 'type' => $type, 'Note.deleted' => false), 
				'order' => array('Note.date_time' => 'DESC')));
		
		$notes = $result = Hash::map($result, "{n}.Note", array($this, 'noop'));
		$this->set('notes',$notes);
		
		if ($this->request->is('post')) {
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('メモを保存しました。'));
				return $this->redirect($this->referer());
			}
			$this->Session->setFlash('保存できませんでした。もう一度試してください。');
		}
		
	}

	function noop($array) {
		//do stuff to array and return the result
		return $array;
	}
	public function edit($id = null) {		
		$this->Note->id = $id;		
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Note->save($this->request->data)) {				
				$this->Session->setFlash('保存しました。');
				return $this->redirect($this->referer());
			}
			$this->Session->setFlash('保存できませんでした。もう一度試してください。');
		} else {
			$this->request->data = $this->Note->read(null, $id);
		}
	}	
	
	public function delete($id = null) {

		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('削除権限ありません'));
		}
		if ($this->Note->saveField('deleted', true)) {
			$this->Session->setFlash("削除しました");
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('削除出来ませんでした。');
		return $this->redirect(array('action' => 'index'));
	}	

}
?>