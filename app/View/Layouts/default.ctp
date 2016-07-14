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

$cakeDescription = __d('cake_dev', 'MEDICAL JOBS（求職者管理）');

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">    
        
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    
    
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->script(array(
    		'//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js',
    		'//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js'
		));
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery.datetimepicker');
    echo $this->Html->css('jquery.datetimepicker');
        
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, '/'); ?>
			<span class="logout" style="position:inline;margin-top:-20px;">
			   <?php echo $this->html->link('<span class="glyphicon glyphicon-home"></span>施設一覧','/institutions', array('class' => 'btn btn-success','escape' => false))?>
			   <?php echo $this->html->link('<span class="glyphicon glyphicon-cog"></span>', '/users/index', array('class' => 'btn btn-info','escape' => false)) ?>
               <?php echo $this->html->link('ログアウト','/users/logout', array('class' => 'btn btn-danger'))?>
			</span> 
			
			</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright © 2015 MEDICAL JOBS All Rights Reserved.
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
