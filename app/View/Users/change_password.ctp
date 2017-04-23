<?php
echo $this->Form->create('User',array('action'=>'change_password'));
echo $this->Form->inputs(array(
    'legend' => '修改密码',
    'current_password'=>array('type' => 'password','label' => '当前密码'),
    'new_password'=>array('type' => 'password','label' => '新密码'),
    'confirm_new_password'=>array('type' => 'password','label' => '确认'),
    ));
echo $this->Form->end('提交');
?>