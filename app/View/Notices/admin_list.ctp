<?php if(empty($all_notices)):?>
    <div class = "page-header">  <h3>没有公告记录！</h3></div>
    <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')).' 添加',array('controller' => 'notices','action' =>'add','admin'=>true),array('escape'=>false,'class'=>'btn  btn-primary'));?>

<?php else:?>
    <div class = "page-header">  <h3> 公告列表 </h3> </div>
    <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')).' 添加',array('controller' => 'notices','action' =>'add','admin'=>true),array('escape'=>false,'class'=>'btn  btn-primary'));?><br><br>
    
    <table class = "table table-bordered table-striped">
        <thead>
            <tr class = "info">
                
                <th > <?php echo $this->Paginator->sort('modified',"发布时间");?></th>
                <th > <?php echo $this->Paginator->sort('title',"题目");?> </th>
                <th > </th>
                <th > </th>
            </tr>
        </thead>
        <tbody> 
        <?php foreach ($all_notices as $notice):?>
        
            <tr >
                <td > <?php echo $this->Time->nice($notice['Notice']['modified']);?> </td>
                <td > <?php echo $notice['Notice']['title']; ?> </td>
                <td>  <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-edit')).' 编辑',array('controller'=>'notices','action' => 'edit','admin'=>true,$notice['Notice']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-info '));?></td>
                <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')).' 删除',array('controller'=>'notices','action' => 'delete','admin'=>true,$notice['Notice']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-danger '),
                            "确定要删除吗");?> </td>
               </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element("pagination");?>
<?php endif;?>
