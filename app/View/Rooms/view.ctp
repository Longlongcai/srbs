<div class="container">
    <div class ="row">
        <div class = "page-header"><h3> 研讨室基本信息</h3> </div>
        <div class = "col-sm-4  col-xs-12">
          
            <div class="panel panel-success">
                        <div class="panel-heading"> 房间号：<?php echo $room['Room']['roomname'];?> </div>
                        <div class="panel-body">
                            座位数：<?php echo $room['Room']['seat_nums']; ?> <br/><br/>
                            网络： <?php echo $room['Room']['has_network'] == 0 ? '无' : '有';?> <br/><br/>
                            状态： <?php echo $room['Room']['is_available'] == 0 ? '不可用': '可用';?><br/><br/> 
                            其他说明： <?php echo empty($room['Room']['extra'])? '无': $room['Room']['extra'];?><br/><br/>
                        </div>
            </div>
        </div>
    </div>

    <div class = "row">
        <div class = "page-header"><h3> 设备信息</h3> </div>
            <?php if(empty($my_devices)):?>
                <p>没有设备信息。</p>
            <?php else:?>
                <?php foreach ($my_devices as $device):?>        
                    <div class="col-sm-3 col-xs-12">
                        <div class="panel panel-success">
                            <div class="panel-heading"> 设备名：<?php echo $device['Device']['devicename'];?> </div>
                            <div class="panel-body">
                                功能描述：<?php echo $device['Device']['function']; ?> <br/>
                                生产日期： <?php echo $device['Device']['produced_date'];?> <br/>
                                引进日期： <?php echo $device['Device']['introduced_date'];?> <br/>
                                其他说明： <?php echo empty($device['Device']['extra'])? '无': $device['Device']['extra'];?><br/> 
                            </div>
            
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
        <?php echo $this->element("pagination");?>
</div>
