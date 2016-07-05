<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array(
			'Session','Form', 'Html', 'Js', 'Time', 'Fancybox.Fancybox','InPlaceEditing.InPlaceEditing'
			
	);
	public $components = array(
			'RequestHandler',
			'Session',
			'Auth' => array(
					'loginRedirect' => array(
							'controller' => 'applicants',
							'action' => 'index'
					),
					'logoutRedirect' => array(
							'controller' => 'users',
							'action' => 'login'
							
					),
					'authenticate' => array(
							'Form' => array(
									'passwordHasher' => 'Blowfish'
							)
					),
					'authorize' => array('Controller') // Added this line
			)
	);
	
	public function beforeFilter() {
		Configure::write('Config.language', 'ja');
		$this->Auth->allow(array('index', 'view', 'migration'));
		if (!$this->Auth->loggedIn() && $this->action != 'login' && $this->action != 'forgot' && $this->action != 'password_reset') {
			$this->redirect($this->Auth->logoutRedirect);
		}
		
	}
	
	public function isAuthorized($user) {
		return true;
		// Admin can access every action
// 		if (isset($user['role']) && $user['role'] === 'admin') {
// 			return true;
// 		}
	
		// Default deny
		//return false;
	}
}
