<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="text-center">パスワードをお忘れになった場合</h1>
    </div>
    <div class="modal-body">
  
   <?php echo $this->Session->flash(); ?>              
     <!-- content -->                     
     
              
        <p><?php echo '新しいパスワードを入力してください。'; ?></p>  
        <div class="modal-content">
           <?php echo $this->Form->create('User');?>
           <div class="modal-body">
              <?php
			     echo $this->Form->input('password', array('placeholder' => __('New password'), 'class'=>'form-control', 'data-rule'=>'password'));
			     echo $this->Form->input('retype_password', array('type' => 'password','placeholder' => __('Retype password'), 'label' => __('Retype password'), 'class'=>'form-control', 'data-rule'=>'password'));
	          ?>
           </div>
           <div class="modal-footer" >
              <?php echo $this->Form->button(__('Submit')." ".$this->Html->tag('i', '', array('class' => 'fa fa-arrow-circle-right fa-1x ')), 
			             array(
				             'div' => false,
				             'class' => 'btn btn-success ',				
				             'escape' => false,
				             'id' => "submit-btn",
				             'data-loading-text' => "Submit...",
			  )); ?>
              <span id="upload_frame" style="float:right;display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i> Submit..... </div>
           </div>
           <?php echo $this->Form->end(); ?>
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