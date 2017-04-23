<?php if(empty($all_bookings)):?>
    <div class = "page-header"><h3> 还没有预订记录！</h3> </div>
<?php else:?>
    <div class = "page-header"><h3> 当前的预订列表 </h3> </div>
    <table class = "table  table-bordered table-striped ">
        <thead>
            <tr class = "info">
                
                <th ><?php echo $this->Paginator->sort('booking_date',"日期");?> </th>
                <th > <?php echo $this->Paginator->sort('timeslot',"时段");?> </th>
                <th > <?php echo $this->Paginator->sort('roomname',"房间号");?> </th>
                <th > <?php echo $this->Paginator->sort('username',"用户");?> </th>
                <th > <?php echo $this->Paginator->sort('created',"预约于");?> </th>
                <th ></th>
            </tr>
        </thead>
        <tbody> 
        <?php $now = date("Y-m-d H:i:s");?>
        <?php foreach ($all_bookings as $booking):?>
        <?php $booked_end_time = 
                    $booking['Booking']['booking_date'].' '.substr($booking['Booking']['timeslot'], 6,5).':00';?>
            <tr >
                <td > <?php echo $booking['Booking']['booking_date'];?> </td>
                <td > <?php echo $booking['Booking']['timeslot']; ?> </td>
                <td > <?php echo $booking['Room']['roomname'];?> </td>
                <td>  <?php echo $booking['User']['username'];?></td>
                <td > <?php echo $this->Time->nice($booking['Booking']['created']); ?>
                    <!--<?php echo date('M j Y, h:i', strtotime($my_booking['Booking']['created']));?><-->                  
                </td>
                <?php if($booked_end_time > $now):?>
                <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-minus-sign')). ' 取消',array('action' => 'delete','admin'=>true,$booking['Booking']['id']),array('escape'=>false,'class'=>'btn  btn-danger btn-block'),
                        "确定要取消吗");?> </td>
                <?php else:?>
                 <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')). ' 过期删除',array('action' => 'delete','admin'=>true,$booking['Booking']['id']),array('escape'=>false,'class'=>'btn  btn-default btn-block'),
                        "确定要删除吗");?> </td>
            <?php endif;?>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination');?>

<?php endif;?>

