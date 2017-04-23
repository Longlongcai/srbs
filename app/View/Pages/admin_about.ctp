<div class = "page-header"><h3>使用说明</h3></div>
<div class="col-sm-8 col-sm-offset-1">
<div class = "alert alert-success">
  1. 注册名、注册邮箱必须唯一，建议使用校园网netID和校园企业邮箱进行注册。<br><br>
  2. 管理员有效预约次数不受限制。<br><br>
  3. 请妥善保管好管理员密码。
</div>

<div id="myCarousel" class="carousel slide" data-interval="500" data-ride="carousel">
<!-- Carousel indicators -->
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>
</ol>
<!-- Carousel items -->
<div class="carousel-inner">
<div class="active item">
<img src="<?php echo $this->webroot; ?>img/gate.jpg" alt="校门牌坊" > 
<div class="carousel-caption">
<h6><b>校门牌坊</b></h6>
</div>
</div>
<div class="item">
<img src="<?php echo $this->webroot; ?>img/view1.jpg" alt="校园一角" > 
<div class="carousel-caption">
<h6><b>校园风光</b></h6>
</div>
</div>
<div class="item">
<img src="<?php echo $this->webroot; ?>img/view2.jpg" alt="校园一角" > 
<div class="carousel-caption">
<h6><b>校园风光 </b></h6>
</div>
</div>

</div>
<!-- Carousel nav -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>
<script>
    $('.carousel').carousel({
        interval: 10000
    })
</script>