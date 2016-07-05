<?php 
App::uses('AppModel', 'Model');

class EntryPost extends AppModel {
	var $belongsTo = array('Post');
}

?>