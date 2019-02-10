<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

	public $uses = array('User','UserGroup','Privilege');

	function login(){
		$this->autoRender = false;
        $this->layout = "";
        if (isset($this->data['username']) && isset($this->data['password'])) {
            $login_detail = $this->User->find('first', array( 'conditions' => array('name' => strtolower($this->data['username']),'password' =>md5($this->data['password']))));
        }
        if(empty($login_detail)) {
            $this->Session->setFlash('<h3 class="well text-danger">Please enter correct login or password</h3>');
            $this->redirect( ABSOLUTE_URL );
        }else if($login_detail['User']){
            $data= $login_detail['User'];
            $this->Session->write('User',$data);
            $this->redirect( ABSOLUTE_URL.'/users/dashboard' );
        }
	}
	function logout(){
		$this->Session->write('User',"");
        $this->Session->destroy();
        $this->redirect( ABSOLUTE_URL);
	}
	function checkLogin(){
		$userInfo = $this->Session->read('User');
		if ($userInfo && $userInfo['id']) {
			return true;
		}else{
			 $this->redirect( ABSOLUTE_URL );
		}
	}
	function dashboard(){
		$this->checkLogin();
		$userInfo = $this->Session->read('User');
	}
	function createUsers(){
		$this->checkLogin();
		if(!$this->data){
			$usersList = $this->User->find('list', array('fields'=>array('id','name')));
			$groupList = $this->UserGroup->find('list', array('fields'=>array('id','name')));
			$privilegeList = $this->Privilege->find('list', array('fields'=>array('id','name')));
			$this->set('usersList',$usersList);
			$this->set('groupList',$groupList);
			$this->set('privilegeList',$privilegeList);
		}else{
			$data = $this->data;
			$data['reporting_manager_ids'] = implode(",", $this->data['reporting_manager_ids']);
			$data['user_group_id'] = implode(",", $this->data['user_group_id']);
			$data['password'] = md5($this->data['password']);
			$this->User->save($data);
			$this->Session->setFlash("<h3>User Created Successfully</h3>");
			$this->redirect( ABSOLUTE_URL.'/users/dashboard' );
		}
	}
	function createUserGroup(){
		$this->checkLogin();
		if(!$this->data){
			$privilegeList = $this->Privilege->find('list', array('fields'=>array('id','name')));
			$this->set('privilegeList',$privilegeList);
		}else{
			$data = $this->data;
			$data['privilege_ids'] = implode(",", $this->data['privilege_ids']);
			if($data['privilege_ids']){
				$this->UserGroup->save($data);
				$this->redirect( ABSOLUTE_URL.'/users/dashboard' );
			}
			$this->Session->setFlash("<h3>User Group Created Successfully</h3>");
		}
	}
	function createPrivileges(){
		$this->checkLogin();
		if($this->data){
			$data = $this->data;
			$this->Privilege->save($data);
			$this->redirect( ABSOLUTE_URL.'/users/dashboard' );
			$this->Session->setFlash("<h3>Privilege Created Successfully</h3>");
		}
	}
	function reportingUsers(){
		$this->checkLogin();
		$userInfo = $this->Session->read('User');
		$usersList = $this->User->find('all', array('conditions'=>array('FIND_IN_SET('.$userInfo['id'].',reporting_manager_ids)')));
		$groupList = $this->UserGroup->find('list', array('fields'=>array('id','name')));
		$data = array();

		foreach ($usersList as $key => $value) {
			$data[$key] = $value['User'];
			if(isset($value['User']['user_group_id']) && $value['User']['user_group_id']){
				$ids = explode(",", $value['User']['user_group_id']);
				foreach ($ids as $k => $v) {
					$data[$key]['groups'][] = $groupList[$v];
				}
			}
		}
		$this->set('title','Users Reporting to '.$userInfo['name']);
		$this->set('reporters',$data);
	}
	function listToReportUsers(){
		$this->checkLogin();
		$this->autoRender = false;
		$userInfo = $this->Session->read('User');
		$usersList = $this->User->find('all', array('conditions' =>array('id' => explode(",", $userInfo['reporting_manager_ids']))));
		$groupList = $this->UserGroup->find('list', array('fields'=>array('id','name')));
		$data = array();
		foreach ($usersList as $key => $value) {
			$data[$key] = $value['User'];
			if(isset($value['User']['user_group_id']) && $value['User']['user_group_id']){
				$ids = explode(",", $value['User']['user_group_id']);
				foreach ($ids as $k => $v) {
					$data[$key]['groups'][] = $groupList[$v];
				}
			}
		}
		$this->set('title','Users Reported By '.$userInfo['name']);
		$this->set('reporters',$data);
		$this->render('reporting_users');
	}
	function listUserGroup(){
		$this->checkLogin();
		$groupList = $this->UserGroup->find('all');
		$this->set('title','Available User Groups');
		$this->set('list',$groupList);
	}
	function listPrivileges(){
		$this->checkLogin();
		$groupList = $this->Privilege->find('all');
		$this->set('title','Available Privileges');
		$this->set('list',$groupList);
	}
}
