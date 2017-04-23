<nav role="navigation" class="navbar-custom navbar-default navbar-fixed-top " >

        <div class="row">
        <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-2">    
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" 
           data-target="#my-navbar-collapse">
           <span class="sr-only">切换导航</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
          </button>
          
          <strong><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-home')). " SRBS", array('controller'=>'bookings','action'=>'index','admin' => false),array('class'=>'navbar-brand','escape'=>false)); ?></strong>


        </div>

        <div class="navbar-collapse collapse" id="my-navbar-collapse">
        <?php if($loggedIn): ?>
          <ul class="nav navbar-nav">
           <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-blackboard')). ' 公告栏',array('controller' => 'notices','action' =>'index','admin'=>false),array('escape'=>false));?></li>
            <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-th-list')). ' 研讨室概况',array('controller' => 'rooms','action' =>'index','admin'=>false),array('escape'=>false));?></li>
            <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-tag')).' 我的预约',array('controller' => 'bookings','action' =>'booked_list','admin'=>false),array('escape'=>false));?></li>
             <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-exclamation-sign')).' 关于',array('controller' => 'pages','action' =>'about','admin'=>false),array('escape'=>false));?></li>
            <li class = "dropdown">
               <a href="#" data-toggle="dropdown" class="dropdown-toggle" ><span class="glyphicon glyphicon-user"> </span>&nbsp;<?php echo $loggedIn_user?>
                <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-log-out')).' 退出', array('controller'=> 'users', 'action' => 'logout','admin'=>false),array('escape'=>false)); ?></li>
                  <li> <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-lock')).' 修改密码', array('controller' => 'users','action'=>'change_password','admin' =>false),array('escape'=>false));?></li>
                  <li> <a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<?php echo $loggedIn_email ?></a></li>
                </ul>
            </li>
          </ul>
        
            <?php else: ?>
            
            <div class="col-sm-offset-2">
              <ul class="nav navbar-nav">
              <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-exclamation-sign')).' 关于',array('controller' => 'pages','action' =>'about','admin'=>false),array('escape'=>false));?></li>
              <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-log-in')). ' 登陆', array('controller'=> 'users', 'action' => 'login','admin'=>false),array('escape'=>false)); ?></li>
               <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-log-in')). ' 管理员', array('controller'=> 'users', 'action' => 'login','admin'=>true),array('escape'=>false)); ?></li>
              <li><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-pencil')). ' 注册', array('controller' => 'users', 'action' => 'register','admin' => false),array('escape'=>false)); ?> </li>
            </div>

            <?php endif;?>

          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>

</nav>

