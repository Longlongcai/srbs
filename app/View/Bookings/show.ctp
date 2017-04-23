<?php if($query_date&&$query_room):?>
			<div class = "page-header">
				<h3> <?php echo $query_room['Room']['roomname']."号研讨室在".$query_date."日的预约列表"?> </h3> 
			</div>
		<div class = "col-sm-8 col-sm-offset-1">
			<table class="table table-striped table-bordered">
				<thead >
					<tr class = "info">
						<th> 时段</th>
						<th> 点击预约 </th>
					</tr>
				</thead>
				<tbody>
			<?php $now = date("Y-m-d H:i:s");?>
			<?php foreach ($timeslots as $timeslot):?>
			<?php $booking__end_time = 
                    $query_date.' '.substr($timeslot, 6,5).':00';?>
                <?php if($booking__end_time <= $now):?>
				<tr class="defalut">
					
					<td> <?php echo $timeslot; ?> </td>
					<td> 
						
						<form><a herf='#' class="btn btn-lg btn-defalut btn-block"><span class="glyphicon glyphicon-alert"></span>&nbsp;已过期</a></form></td>  
					
				<?php elseif(in_array($timeslot,$timeslots_booked)):?>
				
				
				<tr class="warning">
					
					<td> <?php echo $timeslot; ?> </td>
					<td> 
						
						<form><a herf='#' class="btn btn-lg btn-warning btn-block"><span class="glyphicon glyphicon-alert"></span>&nbsp;已被预约</a></form></td>  

				<?php else:?>
				<tr class="active">
					<td> <?php echo $timeslot; ?> </td>
					<td> 
						<?php	echo $this->Form->create('Booking',array('controller' => 'bookings','action' => 'add'));
							echo $this->Form->input('room_id', array('type' => 'hidden','value' => $query_room_id));
							echo $this->Form->input('booking_date', array('type' => 'hidden','value' => $query_date));
							echo $this->Form->input('timeslot',array('type' => 'hidden' ,'value' =>$timeslot));
						?>
							<button class="btn btn-lg btn-success btn-block" type="submit"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;预约</button>
							<?php echo $this->Form->end();?>
					</td>

				</tr>
			<?php endif;?>
			<?php endforeach;?>
			</tbody>
		</table>
	</div>
<?php endif;?>		

