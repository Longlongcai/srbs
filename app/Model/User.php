<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => '请输入用户名'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => '用户名已被使用'
			)
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notEmpty','email'),
				'message' => '请输入邮件地址'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => '邮箱已被使用'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '请输入密码'
			),
			'passwordDiff' => array(
				'rule' => 'checkPasswords',
				'message' => '密码不一致'
			)
		),
		'confirm_password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '重新输入密码'
			)
		),
		'current_password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '输入当前密码'
			)
		),

		'new_password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '请输入新密码'
			),
		
		),
		'confirm_new_password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '重新输入密码'
			)
		),
		

		
	);
	public $hasMany = array(
        'Booking'=>array(
            'className' =>'Booking',
            'foreignkey' => 'user_id',
            'dependent' => true
            ),
         'Notice'=>array(
            'className' =>'Notice',
            'foreignkey' => 'user_id',
            'dependent' => true
            )
        );
	public function checkPasswords($data) {
		if($data['password'] == $this->data['User']['confirm_password'])
			return true;
		return false;
	}
	

	
	public function beforeSave($options = array()) {
		if (!parent::beforeSave($options)) {
			return false;
		}
		if (isset($this->data[$this->alias]['password'])) {
			$hasher = new SimplePasswordHasher();
				$this->data[$this->alias]['password'] = 
					$hasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
}