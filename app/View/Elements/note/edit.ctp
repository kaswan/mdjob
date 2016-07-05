<?php echo $this->Html->css('chosen');?>
<?php echo $this->html->script('chosen.jquery'); ?>

<?php echo $this->Form->create('Note', array('controller' => 'Notes', 'action' => 'add/'.$target_id.'/'.$type)); ?>
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
    <?php echo $this->Form->hidden('target_id', array('value' => $target_id)); ?>
    <?php echo $this->Form->hidden('type', array('value' => $type)); ?>
    <?php echo $this->Form->hidden('user_id', array('value' => AuthComponent::user('id'))); ?>
<?php echo $this->Form->end('保存する'); ?>


<div style="max-height: 450px;overflow-y: scroll; background: ">
<?php foreach($notes as $id => $val){ ?>

	<kbd><?php echo $val['date_time'] ?></kbd> <em><?php if($val['user_id'] > 0) echo '記入者：　' . $users[$val['user_id']]?></em><br>
	<?php echo nl2br($val['remarks']) ?><br>
	<?php if(!empty($institution_lists) && !empty($val['select_institution_id']) && $type == 'Applicant') echo '<p class="bg-danger"><abbr title="法人施設名">' . $this->Html->link($institution_lists[$val['select_institution_id']], array('controller' => 'institutions', 'action' => 'view', $val['select_institution_id']), array('target' => '_blank', 'style' => 'text-decoration:none;')) . "</abbr></p>";?>

<?php } ?>
</div>	

<script>
//minDate:'-1970/01/01',//yesterday is minimum date(for today use 0 or -1970/01/01)
//maxDate:'+1970/12/31',//tommorow is maximum date calendar


$('#datetimepicker').datetimepicker({
    
    dayOfWeekStart: 1,
    step:5,
    maxDate: '-1970/01/01',
    
    i18n:{
              en:{ // English
                        months: [
                                "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                        ],
                        dayOfWeek: [
                                "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
                        ]
                },
               ja:{ // Japanese
                        months: [
                                "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"
                        ],
                        dayOfWeek: [
                                "日", "月", "火", "水", "木", "金", "土"
                        ]
                }, 
           },
     lang:'ja',
  }
);

</script>


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