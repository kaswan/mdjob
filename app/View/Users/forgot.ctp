<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="text-center">パスワードをお忘れになった場合</h1>
      <?php echo $this->html->link('ログイン', array('controller' => 'Users', 'action' => 'login'), array('class'=>"btn btn-warning", 'style' => 'float:right;'))?>
    </div>
    <div class="modal-body">
    	<?php echo $this->Session->flash(); ?>    
        <p>メールアドレスを入力してパスワードをリセットします。迷惑メールのフォルダに<br>info@medical-jobs.co.jpがないか確認してください。</p>  
        
           <?php echo $this->Form->create('User');?>
           <div class="modal-body">
              <?php
			     echo $this->Form->input('email', array('placeholder' => __('Email'), 'class'=>'form-control', 'data-rule'=>'email'));
	          ?>
           </div>
           <div class="modal-footer" >
              <?php echo $this->Form->button(__('リクエスト送信')." ".$this->Html->tag('i', '', array('class' => 'fa fa-arrow-circle-right fa-1x ')), 
			             array(
				             'div' => false,
				             'class' => 'btn btn-success ',				
				             'escape' => false,
				             'id' => "submit-btn",
				             'data-loading-text' => "Submit...",
			  )); ?>
              
           </div>
           <?php echo $this->Form->end(); ?>
		</div>
		</div>
	</div>
</div>
<script>

    jQuery(function($) {
      $('#MemberLoginForm').submit(function(e) {
                     $('#submit-btn').hide();
                     $('#upload_frame').show();
      });
     });
 
</script>