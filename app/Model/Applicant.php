<?php 
App::uses('AppModel', 'Model');

class Applicant extends AppModel {
	
	
	public $belongsTo = array('Prefecture', 'ProgressStatus', 'WorkType', 'Institution' => array('counterCache' => true), 'User' => array('counterCache' => true));
	public $hasMany = array('WorkHistory', 'QualificationHistory',
			                'Note' => array(
					           'className' => 'Note',
					           'foreignKey' => 'target_id',
					           'conditions' => array('Note.type' => 'Applicant'),
			                ),
							'UploadDocument' => array(
					           'className' => 'UploadDocument',
					           'foreignKey' => 'target_id',
					           'conditions' => array('UploadDocument.type' => 'Applicant'),
			                ), 
			);
	
	public $virtualFields = array(
			'age' => "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(Applicant.date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(Applicant.date_of_birth, '00-%m-%d'))",
			);
	
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'お名前が入力されていません。'
            )
        ),
//     	'date_of_birth' => array(
//     		'required' => array(
//     			'rule' => array('notEmpty'),
//     			'message' => '生年月日が選択されていません。'
//     		)
//     	),
//         'postalcode' => array(
//     		'required' => array(
//     			'rule' => array('notEmpty'),
//     			'message' => '郵便番号が入力されていません。'
//     		)
//     	),
//     	'prefecture_id' => array(
//     		'required' => array(
//     			'rule' => array('notEmpty'),
//     			'message' => '都道府県が選択されていません。'
//     		)
//     	),
//     	'address' => array(
//     		'required' => array(
//     			'rule' => array('notEmpty'),
//     			'message' => 'が入力されていません。'
//     		)
//     	),
//     	'tel' => array(
//     		'required' => array(
//     			'rule' => array('notEmpty'),
//     			'message' => '携帯番号が入力されていません。'
//     		)
//     	),
//     	'email' => array(
//     		'required' => array(
//     			'rule' => array('notEmpty'),
//     			'message' => 'メールアドレスが入力されていません。'
//     		)
//     	),
    		
    );
    
    public function beforeSave($options = array()) {
    	if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey])){
    		$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
    	}
    	
    	$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
    	return true;
    }
    
    
}

?>