<div class="page-header"><h3>编辑设备</h3></div>
<?php
    echo $this->Form->create('Device');
    echo $this->Form->input('devicename',array('rows' => '1','label' => '设备名 '));
    echo $this->Form->input('function', array('rows' => '3','label' => '功能描述 '));
    echo $this->Form->input('extra', array('rows' => '3','label' => '其他说明 '));
    echo $this->Form->input('produced_date', array('label' => '生产日期 '));
    echo $this->Form->input('introduced_date', array('label' => '引进日期 '));
    echo $this->Form->end('更新');
