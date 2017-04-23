 <?php echo $this->Session->flash(); ?>
	
    <div class = "page-header"><h3>中山大学研讨室预约系统</h3></div>
    <?php echo $this->Form->create('Booking'); ?>
		<?php echo $this->Form->input('booking_date',array('class'=>'easyui-datebox','type' =>'text','style' => 'width:140px','label' => 'Date'));?>
		<?php echo $this->Form->input('room_id',array('type'=>'select','value'=>$rooms));?> <br>
	
	<?php echo $this->Form->end('查询');?>
     



