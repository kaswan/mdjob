<?php
App::uses('AppController', 'Controller');
 
class UsersController extends AppController {

	public $paginate = array(
			'conditions' => array('deleted' => false),
			'limit' => 20,
			'order' => array(
					'User.employee_number' => 'ASC',
					'User.created_at' => 'DESC'
			)
	);
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('logout', 'forgot', 'password_reset');
	}
	
	public function login() {
		$this->layout = 'user';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('ユーザIDまたはパスワードが正しくありません。'));
	    }
	}
	
	public function logout() {
		$this->Session->destroy();
	    return $this->redirect($this->Auth->logout());
	}

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('保存しました。'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
					__('保存できませんでした。もう一度試してください。')
			);
		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!empty($this->request->data['User']['new_password']))$this->request->data['User']['password']=$this->request->data['User']['new_password'];
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('保存しました。'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
					__('保存できませんでした。もう一度試してください。')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

	
	public function delete($id = null) {
		/*$this->request->onlyAllow('post');*/

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->Auth->user('id') == $id) {
			$this->Session->setFlash(__('自分自身のアカウント削除が出来ません'));
			return $this->redirect(array('action' => 'index'));
		}
		
		if ($this->User->delete()) {
			$this->Session->setFlash(__('削除しました'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('削除出来ませんでした。'));
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function forgot($token=null){
		$this->layout = 'user';
		if ($this->request->is('post')) {
			$this->User->recursive = -1;
			$member = $this->User->findByEmail($this->request->data['User']['email']);
			if($member){
				$token = sha1(rand());
				$token = substr($token, 0, 35);
				$this->User->id = $member['User']['id'];
				if($this->User->saveField('password_reset_token',$token)){
					$this->Session->setFlash("パスワードを再設定するためのURLを送信しました。メールをご確認いただき、パスワードの再設定をしてください。", 'default', array('class' => 'success'));
					$path = 'http://'.$_SERVER['SERVER_NAME']. Router::url('/') . 'Users/password_reset/'.$token;
					$Email = new CakeEmail();
					$Email->template("forgot_password",null)
					->emailFormat('text')
					->viewVars(array('path'=>$path, 'name' => $member['User']['name']))
					->from(array('info@medical-jobs.co.jp' => 'メディカルジョブズ - 社内システム'))
					->to("{$this->request->data['User']['email']}")
					->subject('【メディカルジョブズ 】ログイン用パスワード再設定URLのお知らせ')
					->send();
				}else{
					$this->Session->setFlash('パスワードの再発行失敗しました');
				}
	
			}else{
				$this->Session->setFlash('そのメール アドレスに該当するアカウントはありません。');
			}
		}
	}
	
	public function password_reset($token=null){
		$this->layout = 'user';
		if ($token) {
			$this->User->recursive = -1;
			$member = $this->User->findByPasswordResetToken($token);
			if($member){
				$this->set('email',$member['User']['email']);
				$this->set('token',$token);
			}else{
				return $this->redirect($this->Auth->redirect());
			}
	
			if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data['User']['password'])) {
				if($this->request->data['User']['password'] !== $this->request->data['User']['retype_password']){
					$this->Session->setFlash("パスワードが一致しません。もう一度入力してください。");
				}else{
					$this->User->id = $member['User']['id'];
					$this->request->data['User']['password_reset_token'] = null;
					if($this->User->saveField('password', $this->request->data['User']['password'])){
						$this->User->saveField('password_reset_token', null);
						$this->Session->setFlash(__("パスワードの再設定しました。再度ログインしてください"), 'default', array('class' => 'success'));
							
						$this->Auth->login();
						return $this->redirect(array('controller' => 'homes','action' => '/'));
					}else{
						$this->Session->setFlash('パスワードの再設定失敗しました');
					}
				}
			}else{
				$this->Session->setFlash("パスワードを入力してください");
			}
		}
	}

}
?>