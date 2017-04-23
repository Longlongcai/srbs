<?php if(empty($all_users)):?>
    <div class = "page-header"><h3> 还没有用户记录！</h3> </div>
<?php else:?>
    <div class = "page-header"><h3> 当前的用户列表 </h3> </div>
    <table class = "table  table-bordered table-striped">
        <thead>
            <tr class = "info">
                
                <th ><?php echo $this->Paginator->sort('username',"用户名");?> </th>
                <th > <?php echo $this->Paginator->sort('email',"邮箱");?> </th>
                <th > <?php echo $this->Paginator->sort('created',"注册于");?> </th>
                <th > <?php echo $this->Paginator->sort('modified',"修改于");?> </th>
                <th > </th>
                <th> </th>
                <th></th>
            </tr>
        </thead>
        <tbody> 
        <?php foreach ($all_users as $user):?>
        
            <tr >
                <td > <?php echo $user['User']['username'];?> </td>
                <td > <?php echo $user['User']['email']; ?> </td>
                <td > <?php echo $this->Time->nice($user['User']['created']);?> </td>
                <td>  <?php echo $this->Time->nice($user['User']['modified']);?></td>
                <?php if($user['User']['is_active'] == 1):?>
                <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-remove-sign')). ' 冻结',array('controller'=>'users','action' => 'deactivate','admin'=>true,$user['User']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-warning btn-block'),
                        "冻结后该用户将无法登陆");?> </td>
                <?php else:?>
                <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-ok-sign')). ' 激活',array('controller'=>'users','action' => 'activate','admin'=>true,$user['User']['id']),array('escape'=>false,'class'=>'btn btn-sm btn-success btn-block'),
                        "激活后该用户可以正常使用");?> </td>
               <?php endif; ?>
               <!--  <td > <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-lock')). ' 密码重置',array('controller'=>'users','action' => 'reset_password','admin'=>true,$user['User']['id']),array('escape'=>false,'class'=>'btn  btn-primary btn-block'));?> </td> -->
               <!--  <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-lock')). ' 密码重置',array('controller'=>'users','action' => 'reset_password','admin'=>true,$user['User']['id']),array('escape'=>false,'class'=>'btn  btn-success btn-block'));?> </td> -->
                <td>  <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-lock')).' 密码重置',array('controller'=>'users','action' => 'reset_password','admin'=>true,$user['User']['id']),array('escape'=>false,'class'=>'btn  btn-sm btn-primary btn-block'));?></td>
                <td > <?php echo $this->Form->postLink($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-ok-trash')). ' 删除',array('controller'=>'users','action' => 'delete','admin'=>true,$user['User']['id']),array('escape'=>false,'class'=>'btn btn-sm btn-danger btn-block'),
                        "该用户所有数据都将被删除");?> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination');?>

<?php endif;?>

