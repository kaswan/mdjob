
<?php echo $this->html->link('求職者一覧へ', array('controller' => 'applicants', 'action' => 'index'), array('class' => 'btn btn-success')); ?>

<div class="users form">
  <legend><kbd>新規登録</kbd></legend>
  <?php echo $this->element('applicant/form'); ?>
</div>