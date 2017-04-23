<?php
echo $this->Form->create('User',array('action'=>'login'));
echo $this->Form->inputs(array(
    'legend' => '登陆',
    'username' => array('style' => 'width:280px'),
    'password' => array('style' => 'width:280px'),
    'rememberMe' => array('type' => 'checkbox', 'label' =>'Remember me')
    ));
echo $this->Form->end('提交');
?>