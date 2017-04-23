<?php
echo $this->Form->create('User');
echo $this->Form->inputs(array(
    'legend' => '重置密码',
    'new_password'=>array('type' => 'password','label' => '新密码'),
    'confirm_new_password'=>array('type' => 'password','label' => '确认'),
    'id'=>array('type' => 'hidden')
    ));
 
echo $this->Form->end('提交');
?>