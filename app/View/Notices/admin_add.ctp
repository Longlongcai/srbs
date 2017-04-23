<div class = "page-header"><h3>发布公告</h3></div>
<?php
    echo $this->Form->create('Notice');
    echo $this->Form->input('title',array('rows' => '1','label' => '标题 '));
    echo $this->Form->input('content', array('rows' => '5','label' => '内容 '));
    
    echo $this->Form->end('提交');
?>