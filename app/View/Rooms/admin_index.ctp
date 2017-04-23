<?php if(empty($all_rooms)):?>
    <div class = "page-header"><h3>  没有研讨室信息记录！</h3> </div>
<?php else:?>
    <div class = "page-header"><h3>  研讨室基本情况 </h3> </div>
    <table class = "table table-striped table-bordered">
        <thead>
            <tr>
                
                <th > <?php echo $this->Paginator->sort('roomname',"房间号");?></th>
                <th > <?php echo $this->Paginator->sort('seat_nums',"座位数");?> </th>
                <th > <?php echo $this->Paginator->sort('has_network',"网络");?> </th>
                <th > <?php echo $this->Paginator->sort('is_available',"状态");?> </th>


            </tr>
        </thead>
    </table>
    <div class="row">
        <?php foreach ($all_rooms as $room):?>
        <div class="col-sm-3 col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading"> 房间号：<?php echo $room['Room']['roomname'];?> </div>
                <div class="panel-body">
                    座位数：<?php echo $room['Room']['seat_nums']; ?> <br/>
                    网络： <?php echo $room['Room']['has_network'] == 0 ? '无' : '有';?> <br/>
                    状态： <?php echo $room['Room']['is_available'] == 0 ? '不可用': '可用';?><br/>
                    设备：<?php if(empty($room['Device'])):?>
                            无<br><br><br>
                        <?php else:?>
                       
                        <?php foreach ($room['Device'] as $device) {
                            echo $device['devicename'].'&nbsp;&nbsp;';
                        }?>
                        
                        <?php endif;?> 
                </div>
                <div class="panel-footer">
                     <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-screenshot')).' 查看详情',array('controller' => 'rooms','action' =>'view','admin'=>true,$room['Room']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-success btn-block'));?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php echo $this->element("pagination");?>
<?php endif;?>