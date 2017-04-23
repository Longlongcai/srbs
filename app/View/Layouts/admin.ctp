<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
	<title>
		研讨室预约系统
	</title>
	<?php
		echo $this->Html->meta('favicon.ico','favicon.ico',array('type' => 'icon'));

		echo $this->Html->css(array('jquery-easyui-1.4.2/themes/default/easyui','cake.generic','bootstrap.min.css','style'));
		echo $this->Html->script(array('jquery.min','jquery.easyui.min','easyui-lang-zh_CN','bootstrap.min'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<style>

        body {

          padding-top: 50px;
         
		}

    </style>
</head>
<body>
    <?php echo $this->element('admin_navigation');?>
    <div class="row">
        <div class="col-sm-offset-2 col-lg-offset-2 col-lg-8 col-md-8 ">
	       <div id="container">
		      <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
		      </div>
            <hr>
		       <footer class="footer">
                <div class="container">
                    <p class="text-muted">  &copy;Developed by Jinqia Zhou</p>
                </div>
                </footer>
	       </div>
        </div>
    </div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
