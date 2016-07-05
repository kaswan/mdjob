<?php 
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $hasMany = array('Applicant');
    public $validate = array(
    	'name' => array(
    			'required' => array(
    					'rule' => array('notEmpty'),
    					'message' => '担当者名が入力されていません。'
    			)
        ),
        'username' => array(
        	'unique' => array(
        		'rule' => 'isUnique',
        		'required' => 'create',
        		'message' => '既に登録されています。'
        	),
        	'alphaNumeric' => array(
        		'rule'     => 'alphaNumeric',
        		'required' => true,
        		'message'  => 'ユーザ名英数字のみで入力してください。'
        	),
        	'between' => array(
        		'rule'    => array('between', 4, 15),
        		'message' => 'ユーザIDを4〜15文字の間で入力してください。'
        	),
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'ユーザ名が入力されていません。'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'パスワードが入力されていません。'
            ),
        	'between' => array(
        		'rule'    => array('between', 4, 15),
        		'message' => 'ユーザIDを4〜15文字の間で入力してください。'
        	),
        ),
    	'email' => array(
    		'unique' => array(
    			'rule' => 'isUnique',
    			'required' => 'create',
    			'message' => '既に登録されています。'
    		),
    		'required' => array(
    			'rule' => 'email',
    			'allowEmpty' => false,
    			'message' => 'メールアドレスが入力されていません。'
    		)
    	),
    		
    		'new_password' => array(
    				'between' => array(
    						'rule'    => array('between', 4, 15),
    						'allowEmpty' => true,
    						'message' => 'ユーザIDを4〜15文字の間で入力してください。'
    				),
    		),
    		
//         'role' => array(
//             'valid' => array(
//                 'rule' => array('inList', array('admin', 'member')),
//                 'message' => '権限を選んでください',
//                 'allowEmpty' => false
//             )
//         )
    );
    
        
    public function beforeSave($options = array()) {
    	if (isset($this->data[$this->alias]['password'])) {
    		$passwordHasher = new BlowfishPasswordHasher();
    		$this->data[$this->alias]['password'] = $passwordHasher->hash(
    				$this->data[$this->alias]['password']
    		);
    	}
    	if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey]))$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
    	$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
    	return true;
    }
    
    public function afterSave($created, $options = Array()){
    	return Cache::write('lists', $this->find('list',array('fields' => array('id', 'name'))),'user');
    }
    
}

?>