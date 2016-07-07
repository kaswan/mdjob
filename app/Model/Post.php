<?php 
App::uses('AppModel', 'Model');

class Post extends AppModel {
	var $hasMany = array('EntryPost');
	
	public function data_read($data, $prefectures){
		$arr= array();
		$arr['zip1'] = '';$arr['zip2'] = '';
		
		foreach ($data['EntryPost'] as $key => $val){
			$arr['post_id'] = $val['post_id'];
			$arr['created_at'] = $val['post_date'];
			$arr['sort_modified_date'] = $val['post_date'];
			switch ($val['meta_key']) {
				case 'uname':
					$arr['name'] = $val['meta_value'];
				break;
				case 'kana':
					$arr['furigana'] = $val['meta_value'];
					break;
				case 'sex':
					$arr['gender'] = $val['meta_value'];
					break;
				case 'birth':
					$arr['date_of_birth'] = preg_replace(array('/年/','/月/','/日/'), array('-','-',''), $val['meta_value']);;
					break;
				case 'address1':
					$arr['prefecture_id'] = $prefectures[$val['meta_value']];
					break;
				case 'address2':
					$arr['address'] = $val['meta_value'];
					break;
				case 'address3':
					$arr['house_address'] = $val['meta_value'];
					break;
				case 'zip1':
					$arr['zip1'] = $val['meta_value'];
					$arr['postalcode'] = $arr['zip1'] . $arr['zip2']; 
					break;
				case 'zip2':
					$arr['zip2'] = $val['meta_value'];
					$arr['postalcode'] = $arr['zip1'] . $arr['zip2'];
					break;
				case 'htel':
					$arr['tel_home'] = $val['meta_value'];
					break;
				case 'mtel':
					$arr['tel'] = $val['meta_value'];
					break;
				case 'pmail':
					$arr['email'] = $val['meta_value'];
					break;
				case 'mmail':
					$arr['email_mobile'] = $val['meta_value'];
					break;
				case 'koyo':
					$pattern = explode(",", $val['meta_value']);
					$arr['employment_pattern'] = is_array($pattern) ? $pattern['0'] : $pattern;
					$arr['employment_pattern_remarks'] = $val['meta_value'];
					break;
				case 'time':
					$arr['desired_joining_time'] = $val['meta_value'];
					break;
				case 'other':
					$arr['remarks'] = $val['meta_value'];
					break;
					
				case 'shikaku':
					foreach (explode(",", $val['meta_value']) as $name){
						$arr['QualificationHistory'][] = array('name' => $name);
					}
					break;
				default:
					;
				break;
			}
		}
		
		return $arr;
		
	}
    
}

?>