
	<div class="box-body">
		<div class="row">
			<div class="col-xs-12">
                <legend><kbd>メモ</kbd></legend>
                 <?php  echo $this->Form->input('remarks', array('label' => false, 'id' => 'remarks', 'class' => 'form-control', 'cols' => '50'));  ?>
            </div>                        
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php echo $this->Form->input('date_time', array('type'=>'text', 'id'=> 'datetimepicker', 'placeholder' => '時間を選ぶ', "label" => false, 'data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"日付と時間を選択しおてください", 'class'=>"form-control"));?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              	<?php if(!empty($institution_lists) && $type == 'Applicant') echo $this->Form->input('select_institution_id', array('label' => false, 'class' => 'form-control chosen-select', 'data-placeholder'=> "施設を選ぶ",'options' => array('' => '法人施設を選ぶ・・・') + $institution_lists)); ?>
			</div>
        </div>
    </div>    
    <?php echo $this->Form->hidden('type', array('value' => $type)); ?>
    <?php echo $this->Form->hidden('user_id', array('value' => AuthComponent::user('id'))); ?>
    
    
    <?php echo $this->html->script('datetime.select.calendar'); ?>
    <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
</script>