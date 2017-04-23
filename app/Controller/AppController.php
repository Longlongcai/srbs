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
	public $components = array(
		'Session',
		 'Cookie',
		 'Auth' ,
		'DebugKit.Toolbar'
	);
    public $helpers = array('Form','Html');
	function beforeFilter(){
        $this->_setUpAuth();
        $this->setUpCookie();
        $this->set('loggedIn', $this->Auth->user('id'));
		$this->set('loggedIn_user', $this->Auth->user('username'));
        $this->set('loggedIn_email', $this->Auth->user('email'));
	}

    private function _setUpAuth()
    {
        if (empty($this->request->params['admin'])) {
            $this->Auth->authenticate = array(
                'Form' => array(
                    'scope' => array(
                        'User.is_admin' => 0
                    )
                )
            );
            //$this->Auth->userScope = array('User.is_active' => 1);
            $this->Auth->loginAction = array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false
            );
            // $this->Auth->loginRedirect = array(
            //     'controller' => 'bookings',
            //     'action' => 'index',
            //     'admin' => false
            // );
            $this->Auth->unauthorizedRedirect = array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false
            );
        }

        // Only admins can access admin functions
        if (isset($this->request->params['admin'])) {
            
            $this->Auth->authenticate = array(
                'Form' => array(
                    'scope' => array(
                        'User.is_admin' => 1 
                    )
                )
            );

            $this->Auth->userScope = array('User.is_active' => 1);
            
            $this->Auth->loginAction = array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => true
            );

            // $this->Auth->loginRedirect = array(
            //     'controller' => 'bookings',
            //     'action' => 'index',
            //     'admin' => true
            // );

            $this->Auth->unauthorizedRedirect = array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => true
            );
        }

        $this->Auth->authorize = array('Controller');
        $this->Auth->authError = '无权访问!';
    }

    public function isAuthorized($user = null)
    {

        // Any registered user can access public functions
        if (empty($this->request->params['admin'])) {
            return (bool)($user['is_admin'] == 0);
        }

        // Only admins can access admin functions
        if (isset($this->request->params['admin'])) {
            return (bool)($user['is_admin'] == 1);
        }

        // Default deny
        return false;
    }

    public function setUpCookie()
    {
         // set cookie options
        $this->Cookie->httpOnly = true;

        if (!$this->Auth->loggedIn() && $this->Cookie->read('rememberMe')) {
            $cookie = $this->Cookie->read('rememberMe');

             $this->loadModel('User'); // If the User model is not loaded already
             $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $cookie['username'],
                    'User.password' => $cookie['password']
                    )
                ));

             if ($user && !$this->Auth->login($user['User'])) {
                $this->redirect('/users/logout'); // destroy session & cookie
            }
        }
    }

}
