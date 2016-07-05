<?php echo $this->Form->create('Applicant', array('action' => 'entry_sheet/'.$id, 'target' => '_blank')); ?>
   <div class="box-body">            
            <div class="row">
                <div class="col-xs-12">
                <legend>備考（エントリシート用）</legend>
                 <?php  echo $this->Form->input('entry_sheet_remarks', array('label' => false, 'class' => 'form-control', 'cols' => '60'));  ?>
                </div>                        
            </div>
            
    </div>
<?php echo $this->Form->end(__('PDF出力へ')); ?>