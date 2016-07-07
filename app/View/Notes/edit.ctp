<?php echo $this->Html->css('chosen');?>
<?php echo $this->html->script('chosen.jquery'); ?>
<?php echo $this->Form->create('Note', array('controller' => 'Notes', 'action' => 'edit/'.$id.'/'.$type)); ?>
<?php echo $this->element('note/form'); ?>
<?php echo $this->Form->end('保存する'); ?>
