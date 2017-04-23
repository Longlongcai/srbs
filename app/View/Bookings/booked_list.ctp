
<?php if(empty($my_bookings)):?>
	<div class = "page-header"><h3>  <?php echo $username['User']['username']?>还没有预订记录！</h3> </div>
<?php else:?>
	<div class = "page-header"><h3> <?php echo $username['User']['username'] ?> 的预约列表 </h3> </div>
	<table class = "table  table-bordered table-striped">
		<thead>
			<tr class = "info">
				
				<th ><?php echo $this->Paginator->sort('booking_date',"日期");?> </th>
				<th > <?php echo $this->Paginator->sort('timeslot',"时段");?> </th>
				<th > <?php echo $this->Paginator->sort('roomname',"房间");?> </th>
				<th > <?php echo $this->Paginator->sort('created',"预约于");?> </th>
				<th ></th>
			</tr>
		</thead>
		<tbody>	
		<?php $now = date("Y-m-d H:i:s");?>
		<?php foreach ($my_bookings as $my_booking):?>
		<?php $booked_end_time = 
                    $my_booking['Booking']['booking_date'].' '.substr($my_booking['Booking']['timeslot'], 6,5).':00';?>
			<tr >
				<td > <?php echo $my_booking['Booking']['booking_date'];?> </td>
				<td > <?php echo $my_booking['Booking']['timeslot']; ?> </td>
				<td > <?php echo $my_booking['Room']['roomname'];?> </td>
				<td > <?php echo $this->Time->nice($my_booking['Booking']['created']); ?>
					<!--<?php echo date('M j Y, h:i', strtotime($my_booking['Booking']['created']));?><-->					
				</td>
				<?php if($booked_end_time > $now):?>
				<td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-minus-sign')). ' 取消',array('action' => 'cancel','admin'=>false,$my_booking['Booking']['id']),array('escape'=>false,'class'=>'btn  btn-danger btn-sm btn-block'),
				    	"确定要取消吗");?> </td>
				  <?php else:?>
				  <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')). ' 过期删除',array('action' => 'cancel','admin'=>false,$my_booking['Booking']['id']),array('escape'=>false,'class'=>'btn  btn-default btn-sm btn-block'),
				    	"确定要删除吗");?> </td>
				 <?php endif;?>
			</tr>	
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->element('pagination');?>

<?php endif;?>

