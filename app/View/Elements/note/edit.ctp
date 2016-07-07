<?php echo $this->Html->css('chosen');?>
<?php echo $this->html->script('chosen.jquery'); ?>
<?php echo $this->Form->create('Note', array('controller' => 'Notes', 'action' => 'add/'.$target_id.'/'.$type)); ?>
<?php echo $this->element('note/form', array('type' => $type)); ?>
<?php echo $this->Form->hidden('target_id', array('value' => $target_id)); ?>
<?php echo $this->Form->end('保存する'); ?>

<div style="max-height: 450px;overflow-y: scroll; background: ">
<?php foreach($notes as $id => $val){ ?>

	<kbd><?php echo $val['date_time'] ?></kbd> <em><?php if($val['user_id'] > 0) echo '記入者：　' . $users[$val['user_id']]?></em>
	<?php
        $this->Fancybox->setProperties( array( 
  			       'class' => 'fancybox1 btn btn-default btn-xs',
  			       'className' => 'fancybox.ajax',
  			       'title'=>'メモを編集',
  			       'ajaxUrl'=>'/notes/edit/' . $val['id'] . '/Applicant'
  			    )
				);
            $this->Fancybox->setPreviewContent('<i class="glyphicon glyphicon-pencil"></i>'); // the link which will trigger fancybox on click
            echo $this->Fancybox->output();		
  ?>  
  <?php echo $this->html->link('<i class="glyphicon glyphicon-remove"></i>', array('controller' => 'notes', 'action' => 'delete', $val['id']), array('escape' => false, 'class' => 'btn btn-danger btn-xs', 'confirm' =>'削除してもよろしいですか？'))?>
	<br>
	<?php echo nl2br($val['remarks']) ?><br>
	<?php if(!empty($institution_lists) && !empty($val['select_institution_id']) && $type == 'Applicant') echo '<p class="bg-danger"><abbr title="法人施設名">' . $this->Html->link($institution_lists[$val['select_institution_id']], array('controller' => 'institutions', 'action' => 'view', $val['select_institution_id']), array('target' => '_blank', 'style' => 'text-decoration:none;')) . "</abbr></p>";?>

<?php } ?>
</div>	

