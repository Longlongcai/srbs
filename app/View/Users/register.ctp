<?php
echo $this->Form->create('User',array('action'=>'register'));
echo $this->Form->inputs(array(
    'legend' => '注册',
    'username'=>array('label'=>'用户名') ,
    'email'=>array('label'=>'邮箱'),
    'password'=>array('label'=>'密码'),
    'confirm_password'=>array('type' => 'password','label'=>'确认密码')
    ));
echo $this->Form->end('提交');
?>