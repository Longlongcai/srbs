<?php if(empty($all_notices)):?>
    <div class = "page-header"><h3>  没有公告记录！</h3> </div>
<?php else:?>
    <div class = "page-header"><h3> 公告列表 </h3> </div>
       <?php foreach ($all_notices as $notice):?>
       <div class = "row jumbotron">
            <div class="col-xs-12 col-lg-11"> 
                <h3 class="text-center"> <?php echo $notice['Notice']['title'];?> </h3>
                <p class="text-right"><small><?php echo $this->Time->nice($notice['Notice']['modified']);?></small></p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $notice['Notice']['content'];?></p>
               
                    
            </div>
        </div>
            <?php endforeach; ?>
    <?php echo $this->element("pagination");?>
<?php endif;?>
