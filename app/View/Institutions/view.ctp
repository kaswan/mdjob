<div class="row">
	<div class="col-xs-1">
  		<?php echo $this->html->link('施設一覧へ', array('controller' => 'institutions', 'action' => 'index'), array('class' => 'btn btn-success')); ?><br><br>
  		<?php echo $this->html->link('編集する', array('controller' => 'institutions', 'action' => 'edit', !empty($institution) ? $institution['Institution']['id']: ''), array('class' => 'btn btn-warning')); ?>
     
	</div>
	<div class="col-xs-7">
		<div class="users form">
			<?php echo $this->element('institution/show',array('institution' => $institution)); ?>
		</div>
	</div>
	
	<div class="col-xs-4">	    
   		<pre>コンタクト履歴</pre>
   		<?php echo $this->element('note/edit', array('notes' => Hash::sort($institution['Note'], '{n}.note.date_time', 'DESC'), 'target_id' => $institution['Institution']['id'], 'type' => 'Institution')); ?>        
  	</div>
</div>