
<?php echo $this->Form->create('User'); ?>

        
        <?php 
        echo $this->Form->input('employee_number', array('class' => 'form-control', 'label' => '社員番号'));
        echo $this->Form->input('name', array('class' => 'form-control', 'label' => '名前'));
        echo $this->Form->input('email', array('class' => 'form-control', 'label' => 'メールアドレス'));
        echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'ユーザID'));
        echo $this->Form->input('new_password', array('type' => 'password', 'class' => 'form-control', 'label' => 'パスワード'));
        
        if(AuthComponent::user('role') == 'admin') {
        	echo $this->Form->radio('role', array(
                   'admin' => '管理者', 'member' => '一般メンバー'),
        			array('label' => '権限','div' => false));
        }
    ?>
<?php echo $this->Form->end(__('登録する')); ?>
</div>