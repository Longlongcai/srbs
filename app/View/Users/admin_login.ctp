<?php
echo $this->Form->create('User',array('action'=>'login','admin'=>true));
echo $this->Form->inputs(array(
    'legend' => '管理员登陆',
    'username' => array('style' => 'width:280px'),
    'password' => array('style' => 'width:280px')
    ));
echo $this->Form->end('提交');
?>