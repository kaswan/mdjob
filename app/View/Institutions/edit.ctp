<?php echo $this->html->link('施設者一覧へ', array('controller' => 'institutions', 'action' => 'index'), array('class' => 'btn btn-success')); ?>
<div class="users form">
  <pre><b>編集画面</b></pre>
  <?php echo $this->element('institution/form'); ?>
</div>