<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
    public $components = array('Paginator');
    public $helpers = array('Paginator','Time');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login','logout','admin_login','admin_logout','register');
	}
	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('注册成功'));
				return $this->redirect(array('action' => 'login'));
			}
			$this->Session->setFlash(__('注册失败，请重试'));
		}
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
                if ($this->Auth->user('is_active') == 0) {
                    $this->Auth->logout();
                    $this->Session->setFlash(__('该用户未激活'));
                    return $this->redirect($this->Auth->redirectUrl());
                }
				//set cookies
				if ($this->request->data['User']['rememberMe'] == 1) {
			        // After what time frame should the cookie expire
			        $cookieTime = "10 days"; 
			    	// remove "remember me checkbox"
			        unset($this->request->data['User']['rememberMe']);

			    	// hash the user's password
			        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);

			    	// write the cookie
			        $this->Cookie->write('rememberMe', $this->request->data['User'], true, $cookieTime);
			       
			    	}
			    	$this->Session->setFlash(__('登陆成功'));
            $this->layout = 'default';
            return $this->redirect(array('controller'=>'bookings','action'=>'index','admin'=>false));
			// return $this->redirect($this->Auth->redirectUrl());
		}
		$this->Session->setFlash(__('用户名或密码错误'));
		}
	}

	public function logout() {
		$this->Session->setFlash(__("退出成功"));
		$this->Cookie->delete('rememberMe');
		return $this->redirect($this->Auth->logout());
	}

	public function change_password() {

		if($this->request->is('post') || $this->request->is('put')) {

			if($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_new_password']) {
			
				$current_password_hashed=$this->Auth->password($this->request->data['User']['current_password']);
        		$new_password_hashed=$this->Auth->password($this->request->data['User']['new_password']);
        		
        		$this->User->unbindModel(array('hasMany' => array('Booking')));
        		$data = $this->User->find('first',array(
           				'fields' => 'User.password',
            			'conditions' => array('User.id' =>$this->Auth->user('id'))
            	));
				
        		if($current_password_hashed == $data['User']['password']) {

        			 $this->User->id = $this->Auth->user('id');
                     $this->User->saveField('password',$this->request->data['User']['new_password']);
                     $this->Session->setFlash(__('密码修改成功'));
				} else {
					$this->Session->setFlash(__('当前密码输入错误'));
				}
			} else {
				$this->Session->setFlash(__('确认密码不一致'));
			}
		}
        $this->request->data = null;
	}


	//functions for admin----------------------------------------------------------
	public function admin_login() {
		
	
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                 $this->layout = 'admin';
            	 $this->Session->setFlash(__('登陆成功'));
                return $this->redirect(array('controller'=>'bookings','action'=>'index','admin'=>true));

                // return $this->redirect($this->Auth->redirectUrl());
           
            } else {
                $this->Session->setFlash(__('用户名或密码错误'));
            }
        }
    }

    public function admin_logout() {
		$this->Session->setFlash("退出成功");
		return $this->redirect($this->Auth->logout());
	}

	public function admin_change_password() {
		$this->layout = 'admin';
		if($this->request->is('post') || $this->request->is('put')) {

			if($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_new_password']) {
			
				$current_password_hashed=$this->Auth->password($this->request->data['User']['current_password']);
        		$new_password_hashed=$this->Auth->password($this->request->data['User']['new_password']);
        		
        		$this->User->unbindModel(array('hasMany' => array('Booking')));
        		$data = $this->User->find('first',array(
           				'fields' => 'User.password',
            			'conditions' => array('User.id' =>$this->Auth->user('id'))
            	));
				
        		if($current_password_hashed == $data['User']['password']) {

        			 $this->User->id = $this->Auth->user('id');
                     $this->User->saveField('password',$this->request->data['User']['new_password']);
                     $this->Session->setFlash(__('密码修改成功'));
				} else {
					$this->Session->setFlash(__('当前密码输入错误'));
				}
			} else {
				$this->Session->setFlash(__('确认密码不一致'));
			}
		}
         $this->request->data = null;
	}
    public function admin_reset_password($id=null) {
        $this->layout = 'admin';
        if (!$id) {
            throw new NotFoundException(__('参数非法'));
        }
        $this->User->unbindModel(array('hasMany' => array('Booking')));
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('该用户不存在'));
        }
        if($this->request->is('post') || $this->request->is('put')) {

            if($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_new_password']) {
            
                    $this->User->id = $id;            
                    if($this->User->saveField('password',$this->request->data['User']['new_password'])){
                        $this->Session->setFlash(__('密码修改成功'));
                        return $this->redirect(array('action' => 'list','admin' => true));
                    } else {
                        $this->Session->setFlash(__('密码修改失败'));
                    }
                
            } else {
                $this->Session->setFlash(__('确认密码不一致'));
            }
        }
        
        // $this->request->data = null;
       // return $this->redirect(array('controller' =>'users','action'=>'list','admin'=>true));
    }
    public function admin_list() {
        $this->layout = 'admin';
        $this->User->unbindModel(array('hasMany' => array('Booking')));
        $this->Paginator->settings = array(
            'User' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'fields' => array('User.id','User.username','User.email','User.created','User.modified','User.is_active'),
                'conditions' => array('User.is_admin'=>0),
                'order' => array('User.username ASC')    

            ));

        $all_users = $this->Paginator->paginate('User');
        $this->set('all_users',$all_users);
    }

    public function admin_activate($id=null) {
         $this->layout = 'admin';  
          if (!$id) {
                throw new NotFoundException(__('该用户不存在'));
            }
            $this->User->unbindModel(array('hasMany' => array('Booking')));
            $user = $this->User->findById($id);
            if (!$user) {
                throw new NotFoundException(__('该用户不存在'));
            }
            $this->User->id = $id;
            if($this->User->saveField('is_active', '1')) {

                $this->Session->setFlash(__('激活成功'));
            } else {
                $this->Session->setFlash(__('激活失败'));

            }
            return $this->redirect(array('controller' =>'users','action'=>'list','admin'=>true));

    }
    

    public function admin_deactivate($id=null) {
          $this->layout = 'admin';  
          if (!$id) {
                throw new NotFoundException(__('该用户不存在'));
            }
            $this->User->unbindModel(array('hasMany' => array('Booking')));
            $user = $this->User->findById($id);
            if (!$user) {
                throw new NotFoundException(__('该用户不存在'));
            }
            $this->User->id = $id;
            if($this->User->saveField('is_active', '0')) {

                $this->Session->setFlash(__('冻结成功'));
            } else {
                $this->Session->setFlash(__('冻结失败'));

            }
            return $this->redirect(array('controller' =>'users','action'=>'list','admin'=>true));
    }
	public function admin_delete($id=null) {
          $this->layout = 'admin';  
          if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }
            $this->User->unbindModel(array('hasMany' => array('Booking')));
            $user = $this->User->findById($id);
            if (!$user) {
                throw new NotFoundException(__('该用户不存在'));
            }
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
            $this->User->recursive = 1;
            if ($this->User->delete($id)) {
                $this->Session->setFlash('删除成功！');
            } else {
                $this->Session->setFlash('删除失败！');
            }
             
            return $this->redirect(array('controller' =>'users','action'=>'list','admin'=>true));
    }

}