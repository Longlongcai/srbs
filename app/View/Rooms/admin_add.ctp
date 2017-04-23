<div class = "page-header"><h3>添加研讨室</h3></div>
<?php
    echo $this->Form->create('Room');
    echo $this->Form->input('roomname',array('label' => '房间号 ','style' => 'width:140px'));
    echo $this->Form->input('seat_nums',array('label' => '座位数 ','style' => 'width:140px'));
    echo $this->Form->input('has_network',array('label' => '网络 ','options'=>array('1'=>'有','0'=>'无')));
     echo $this->Form->input('is_available',array('label' => '可用 ','options'=>array('1'=>'是','0'=>'否')));
    echo $this->Form->input('extra', array('rows' => '3','label' => '其他说明 '));
    echo $this->Form->end('提交');
?>