<div class="row">
	<div class="col-xs-1">
	  <?php echo $this->html->link('求職者一覧へ', array('controller' => 'applicants', 'action' => 'index'), array('class' => 'btn btn-success ')); ?><br><br>
	  <?php echo $this->html->link('施設一覧へ', array('controller' => 'institutions', 'action' => 'index'), array('class' => 'btn btn-success ')); ?><br><br>
	  <?php echo $this->html->link('管理者一覧へ', array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-info ')); ?>
	</div>  
	<div class="col-xs-10">
		<div class="users form">
  			<legend><kbd>新規ユーザ登録</kbd></legend>
  			<?php echo $this->element('user/form'); ?>
		</div>
	</div>
</div>		