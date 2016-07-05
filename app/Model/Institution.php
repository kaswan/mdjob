<?php 
App::uses('AppModel', 'Model');

class Institution extends AppModel {
	public $actsAs = array('Containable');
	public $belongsTo = array('Prefecture');
	public $hasMany = array(
			'Applicant',
			'ContactPerson',
			'Note' => array(
				'className' => 'Note',
				'foreignKey' => 'target_id',
				'conditions' => array('Note.type' => 'Institution'),
			),
			'UploadDocument' => array(
					'className' => 'UploadDocument',
					'foreignKey' => 'target_id',
					'conditions' => array('UploadDocument.type' => 'Institution'),
			),
		);
	
	
	public $virtualFields = array(
			'freeword' => 'CONCAT(Institution.name, ",", Institution.furigana, ",", Institution.corporate_name, ",", Institution.corporate_furigana, ",", Institution.nearest_station, ",", Institution.other, Institution.id)',
			'phone' =>   'REPLACE(Institution.tel,"-","")',
	);
	
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'お名前が入力されていません。'
            )
        ),
    	'furigana' => array(
    		'required' => array(
    			'rule' => array('notEmpty'),
    			'message' => 'ふりがなが入力されていません。'
    		)
    	),
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
    	$this->data[$this->alias]['tel'] = str_replace('−','-',$this->data[$this->alias]['tel']);
    	$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
    	return true;
    }    
    
    
    public function afterSave($created, $options = Array()){
    	return Cache::write('lists', $this->find('list',array('fields' => array('id', 'name'))),'institution');
    }
}

?>