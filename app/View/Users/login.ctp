
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="text-center">Login</h1>
    </div>
    <div class="modal-body">    
      
      <?php echo $this->Form->create('User',array('class'=>"form col-md-12 center-block")); ?>
        <div class="form-group">          
          <?php echo $this->Form->input('username', array('label' => 'ユーザID', 'class' => "form-control input-lg", 'placeholder' => 'ユーザIDを入力してください')); ?>
        </div>
        <div class="form-group">          
          <?php echo $this->Form->input('password', array('label' => 'パスワード', 'class' => "form-control input-lg", 'placeholder' => 'パスワード')); ?>
        </div>
        <div class="form-group">
          <?php echo $this->Form->submit(__('ログイン'), array('class'=>"btn btn-success", 'div' => false)); ?>
          
          <?php echo $this->html->link('パスワードをお忘れの方は こちら', array('controller' => 'Users', 'action' => 'forgot'), array('class'=>"btn btn-warning", 'style' => 'float:right'))?>
          
        </div>
      <?php echo $this->Form->end(); ?>
    </div>
     <div class="modal-footer">
      
     </div>
  
   </div>
  </div>
</div>  