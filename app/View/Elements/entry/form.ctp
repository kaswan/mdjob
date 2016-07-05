<div class="users form">
<?php echo $this->Form->create('Applicant'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
        echo $this->Form->input('name');
        echo $this->Form->input('furigana');
        echo $this->Form->input('gender', array(
            'options' => array('男' => '男', '女' => '女')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>