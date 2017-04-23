<?php if(empty($all_rooms)):?>
    <div class = "page-header"><h3> 没有研讨室信息记录！</h3> </div>
    <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')).' 添加',array('controller' => 'rooms','action' =>'add','admin'=>true),array('escape'=>false,'class'=>'btn  btn-primary'));?>

<?php else:?>
    <div class = "page-header"><h3>  研讨室信息列表 </h3> </div>
    <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')).' 添加',array('controller' => 'rooms','action' =>'add','admin'=>true),array('escape'=>false,'class'=>'btn  btn-primary'));?><br><br>
    
    <table class = "table table-bordered table-striped">
        <thead>
            <tr class = "info">
                
                <th > <?php echo $this->Paginator->sort('roomname',"房间号");?></th>
                <th > <?php echo $this->Paginator->sort('seat_nums',"座位数");?> </th>
                <th > <?php echo $this->Paginator->sort('has_network',"网络");?> </th>
                <th > <?php echo $this->Paginator->sort('is_available',"状态");?> </th>
                <th > </th>
                <th > </th>
            </tr>
        </thead>
        <tbody> 
        <?php foreach ($all_rooms as $room):?>
        
            <tr >
                <td > <?php echo $room['Room']['roomname'];?> </td>
                <td > <?php echo $room['Room']['seat_nums']; ?> </td>
                <td > <?php echo $room['Room']['has_network'] == 0 ? '无' : '有';?> </td>
                <td > <?php echo $room['Room']['is_available'] == 0 ? '不可用': '可用';?> </td>
                <td>  <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-edit')).' 编辑',array('controller'=>'rooms','action' => 'edit','admin'=>true,$room['Room']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-info '));?></td>
                <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')).' 删除',array('controller'=>'rooms','action' => 'delete','admin'=>true,$room['Room']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-danger '),
                            "确定要删除吗");?> </td>
               </tr>
            <!--  <?php if(!empty($room['Room']['extra'])):?>
                <tr class='warning'> <td>其他情况</td><td colspan='6' class='warning'><p class='text-left'><?php echo $room['Room']['extra'];?></p></td> </tr>
                 <tr><td colspan='7'></td></tr>
                <?php endif; ?>
            -->
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element("pagination");?>
<?php endif;?>
