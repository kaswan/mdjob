<?php 
App::uses('AppModel', 'Model');

class QualificationHistory extends AppModel {
	
	public $belongsTo = array('Applicant');
	
	public function beforeSave($options = array()) {
		if(!$this->id && !isset($this->data[$this->alias][$this->primaryKey]))$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
		$this->data[$this->alias]['created_at'] = date("Y-m-d H:i:s");
		$this->data[$this->alias]['updated_at'] = date("Y-m-d H:i:s");
		$this->data[$this->alias]['other_name'] = $this->trim_emspace($this->data[$this->alias]['other_name']);
		if($this->data[$this->alias]['name'] == 'その他' && !empty($this->data[$this->alias]['other_name'])){
			$this->data[$this->alias]['name'] = $this->data[$this->alias]['other_name'];
			ClassRegistry::init('Qualification');
			
			$qualification = new Qualification();
			if(!$qualification->findByName($this->data[$this->alias]['other_name'])){			
				$qualification->create();
                $qualification->save(array('name' => $this->data[$this->alias]['other_name']));
			}
			
			
		}
		
		return true;
	}
    
	
	function trim_emspace ($str) {
		// 先頭の半角、全角スペースを、空文字に置き換える
		$str = preg_replace('/^[　]+/u', '', $str);
		// 最後の半角、全角スペースを、空文字に置き換える
		$str = preg_replace('/[ ]+$/u', '', $str);
		$str = trim(mb_convert_kana( $str, '&quot;s&quot;'));
		return $str;
	}
}

?>