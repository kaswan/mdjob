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
}
?>