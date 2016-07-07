<?php 
App::uses('AppModel', 'Model');

class Note extends AppModel {
	var $belongsTo = array(
		'User',
        'Applicant' => array(
            'foreignKey' => 'target_id',
            'conditions' => array('Note.type' => 'Applicant'),
        	'counterCache' => 'note_count',  
            'counterScope' => array(
        	  'Note.type' => 'Applicant', 'Note.deleted' => false
        	)
        ),
        'Institution' => array(
            'foreignKey' => 'target_id',
            'conditions' => array('Note.type' => 'Institution'),
        	'counterCache' => 'note_count',
        	'counterScope' => array(
        	  'Note.type' => 'Institution', 'Note.deleted' => false
        	)
        ),
		'SelectInstitution' => array(
			'className' => 'Institution',
			'foreignKey' => 'select_institution_id',
		)
    );
	
	public $validate = array(
			'remarks' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'メモが入力されていません。'
					)
			),
    );
    

    public function beforeSave($options = array()) {
    	if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey])){
    		$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
    	}
    	if(empty($this->data[$this->alias]['date_time'])) $this->data[$this->alias]['date_time'] = date("Y-m-d H:i:s");
    	$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
    	return true;
    }    
    
    
}

?>