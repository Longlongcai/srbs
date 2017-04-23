<div class = "col-sm-6">
  <div class = "page-header"><h3> 编辑研讨室基本信息</h3> </div>
    <?php
        echo $this->Form->create('Room');
        echo $this->Form->input('roomname',array('label' => '房间号','style' => 'width:140px'));
        echo $this->Form->input('seat_nums',array('label' => '座位数','style' => 'width:140px'));
        echo $this->Form->input('has_network',array('label' => '网络','options'=>array('1'=>'有','0'=>'无')));
         echo $this->Form->input('is_available',array('label' => '可用','options'=>array('1'=>'是','0'=>'否')));
        echo $this->Form->input('extra', array('rows' => '3','label' => '其他说明'));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->end('更新');
    ?>
</div>
<div class = "col-sm-6">
    <div class = "page-header"><h3> 更新设备信息</h3> </div>
     <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')).' 添加',array('controller' => 'devices','action' =>'add','admin'=>true,$room_id),array('escape'=>false,'class'=>'btn  btn-sm btn-primary'));?><br><br>
    <?php if(empty($my_devices)):?>
        <p>没有设备信息。</p>
    <?php else:?>
        
        <div class="row">
        <?php foreach ($my_devices as $device):?>        
        <div class="col-sm-6 col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading"> 设备名：<?php echo $device['Device']['devicename'];?> </div>
                <div class="panel-body">
                    功能描述：<?php echo $device['Device']['function']; ?> <br/>
                    生产日期： <?php echo $device['Device']['produced_date'];?> <br/>
                    引进日期： <?php echo $device['Device']['introduced_date'];?> <br/>
                    其他说明： <?php echo empty($device['Device']['extra'])? '无': $device['Device']['extra'];?><br/> 
                </div>
                <div class="panel-footer">
                    <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-edit')).' 编辑',array('controller' => 'devices','action' =>'edit','admin'=>true,$device['Device']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-success'));?>
                      <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')).' 删除',array('controller' => 'devices','action' =>'delete','admin'=>true,$device['Device']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-danger'),"确定要删除该设备吗");?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php echo $this->element("pagination");?>
    <?php endif;?>
</div>