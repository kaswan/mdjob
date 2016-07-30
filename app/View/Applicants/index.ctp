<?php echo $this->Html->script('jquery.jeditable') ?>
    
<div class="box-body">
   <?php echo $this->Form->create('Applicant',array('action'=>'index', 'method' => 'GET')); ?>
   <div class="row">
      <div class="col-xs-6">
         <?php echo $this->Form->input('freeword', array('label' => false, 'placeholder' => 'フリーワードで検索する', 'class' => 'form-control')); ?>
      </div>     
      <div class="col-xs-2"></div>
      <div class="col-xs-2">
         <?php echo $this->html->link('<i class="icon-large icon-user"> </i>新規登録', array('controller' => 'applicants', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-danger ', 'style' => 'width:170px;text-decoration:none;'));?>
      </div>
      
      <div class="col-xs-2">
         <?php echo $this->html->link('メールマガジン配信へ', array('controller' => 'mail_magazine', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-info ', 'style' => 'width:170px;text-decoration:none;'));?>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-2">
         <?php echo $this->Form->input('gender', array('label' => false, 'class' => 'form-control', 'options' => array('' => '', '男' => '男', '女' => '女' ))); ?>
      </div>   
      <div class="col-xs-2">
         <?php echo $this->Form->input('qualification', array('label' => false, 'class' => 'form-control', 'options' => array('' => '資格を選んでください') + $qualifications )); ?>
      </div>
      
      <div class="col-xs-2">
         <?php echo $this->Form->input('employment_pattern', array('label' => false, 'class' => 'form-control', 
               'options' => 
                 array('' => '雇用形態を選んでください', 
                    "常勤（夜勤有）" => "常勤（夜勤有）", 
										"常勤（夜勤無）" => "常勤（夜勤無）", 
										"非常勤" => "非常勤",
										"夜勤常勤" => "夜勤常勤",
										"夜勤アルバイト" => "夜勤アルバイト",
										"派遣" => "派遣",
										"応援" => "応援",
										"その他" => "その他") )); ?>
      </div>
      
      <div class="col-xs-2">
         <?php echo $this->Form->input('prefecture', array('label' => false, 'class' => 'form-control', 'options' => array('' => '都道府県') + $prefectures )); ?>
      </div>
            
      <?php for($i=15;$i <= 60; $i=$i+5) $age_range[$i] = $i . "歳" . "～". ($i + 5) ."歳"; ?> 
      <div class="col-xs-2">
         <?php echo $this->Form->input('age', array('label' => false, 'class' => 'form-control', 'options' => array('' => '年齢') + $age_range )) ; ?>
      </div>
  
      <div class="col-xs-2">
         <?php     
            echo $this->Form->input('progress_status_id', array('label' => false, 'class' => 'form-control','options' => array('' => 'ステータス') + $statuses)); 
         ?>                                                 
      </div>
                
      
   </div>
   <div class="row">
      <div class="col-xs-5"></div>
      <div class="col-xs-7">
         <?php echo $this->Form->button('<i class="icon-large icon-search"> </i>検索', array('escape' => false, 'class' => 'btn btn-success', 'style' => 'width:170px;', 'label' => 'Search')); ?>
      </div>
      
   </div>   
   
   <?php echo $this->Form->end(); ?>
</div>

<?php $url_params = ""; foreach($this->params['named'] as $index => $val){$url_params .= $index.':'.$val . '/';}?>
<br> 
<div class="users">
<?php if(!empty($applicants)) { ?>
<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
  <table>
    <thead>
      <tr>
        <th><?php echo $this->Paginator->sort('id', 'No.'); ?></th>
        <th><?php echo $this->Paginator->sort('name', 'お名前'); ?></th>
        <th>性別</th>
        <th>資格</th>
        <th><?php echo $this->Paginator->sort('age', '年齢'); ?></th>
        <th><?php echo $this->Paginator->sort('prefecture_id', '都道府県'); ?></th>
        <th><?php echo $this->Paginator->sort('progress_status_id', 'ステータス'); ?></th>
        <th><?php echo $this->Paginator->sort('employment_pattern', '雇用形態'); ?></th>
        <th><?php echo $this->Paginator->sort('user_id', '担当者'); ?></th>
        <th><?php echo $this->Paginator->sort('user_id', 'メルマガ'); ?></th>
        <th><?php echo $this->Paginator->sort('created_at', '作成日'); ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <?php foreach($applicants as $id => $val){ ?>
        <tr class="<?php echo $val['Applicant']['status'];?>">
          <td class="<?php echo $val['Applicant']['status'];?>">
             <?php echo $this->html->link('<i class="icon-small icon-arrow-up"></i>', 
                                     array('action' => 'modified_date_update', $val['Applicant']['id']), 
                                     array('escape' => false, 'class' => 'btn btn-default btn-xs', 'confirm' =>'新しい方に上げてもよろしいですか？'))?>
             <?php echo $val['Applicant']['id'];?>
          </td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php echo $val['Applicant']['name'];?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php echo $val['Applicant']['gender'];?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php if(isset($qualification_history[$val['Applicant']['id']]))echo $qualification_history[$val['Applicant']['id']]?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php if($val['Applicant']['age'] <= '100') echo $val['Applicant']['age'].'歳';?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php if($val['Applicant']['prefecture_id'] > 0 )echo $prefectures[$val['Applicant']['prefecture_id']];?></td>
          <td class="<?php echo $val['Applicant']['status'];?>">
          <?php
          			echo $this->inPlaceEditing->input('Applicant', 'progress_status_id', $val['Applicant']['id'],
        				array('value' => $val['ProgressStatus']['name'],
              				'actionName' => Router::url(array('controller' => 'Applicants', 'action' => 'in_place_editing')),
             		 		'type' => 'select',
             		 		'selectOptions' => json_encode(array('') + $statuses),
             		 		'selected' => $val['Applicant']['progress_status_id'],
              				'cancelText' => 'キャンセル',
              				'submitText' => '保存',
              				'toolTip' => 'クリックして編集する',
             			 	'containerType' => 'label',
             			 	'containerClass' => 'bg-warning ',
              			)
        			);
          ?>
          
          <?php //echo $val['ProgressStatus']['name'];?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php echo $val['Applicant']['employment_pattern'];?></td>
          <td >
          <?php
          		
          			echo $this->inPlaceEditing->input('Applicant', 'user_id', $val['Applicant']['id'],
        				array('value' => $val['User']['name'],
              				'actionName' => Router::url(array('controller' => 'Applicants', 'action' => 'in_place_editing')),
             		 		'type' => 'select',
             		 		'selectOptions' => json_encode(array('') + $users),
             		 		'selected' => $val['Applicant']['user_id'],
              				'cancelText' => 'キャンセル',
              				'submitText' => '保存',
              				'toolTip' => 'クリックして編集する',
             			 	'containerType' => 'label',
             			 	'containerClass' => 'bg-danger',
              			)
        			);
				
          ?>
          </td>
          
          <td >
          <?php
          		
          			echo $this->inPlaceEditing->input('Applicant', 'mail_magazine_subscription', $val['Applicant']['id'],
        				array('value' => $val['Applicant']['mail_magazine_subscription'] ? '希望する' : '希望しない',
              				'actionName' => Router::url(array('controller' => 'Applicants', 'action' => 'in_place_editing')),
             		 		'type' => 'select',
             		 		'selectOptions' => json_encode(array('1' => '希望する', '0' => '希望しない')),
             		 		'selected' => $val['Applicant']['mail_magazine_subscription'],
              				'cancelText' => 'キャンセル',
              				'submitText' => '保存',
              				'toolTip' => 'クリックして編集する',
             			 	'containerType' => 'label',
             			 	'containerClass' => 'bg-info',
              			)
        			);
				
          ?>
          </td>
          
          <td class="<?php echo $val['Applicant']['status'];?>"><?php echo $val['Applicant']['created_at'];?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php echo $this->html->link('<i class="icon-large  icon-pencil"></i>', array('controller' => 'applicants', 'action' => 'edit', $val['Applicant']['id']), array('escape' => false, 'class' => 'btn btn-success btn-sm', 'role' => "button"))?></td>
          <td class="<?php echo $val['Applicant']['status'];?>"><?php echo $this->html->link('詳細', array('controller' => 'applicants', 'action' => 'view', $val['Applicant']['id']), array('class' => 'btn btn-info btn-sm','escape' => false))?></td>
         
          <?php if(AuthComponent::user('role') == 'admin'){ ?>
          	<td class="<?php echo $val['Applicant']['status'];?>"><?php echo $this->html->link('<i class="icon-large  icon-trash"></i>', array('controller' => 'applicants', 'action' => 'delete', $val['Applicant']['id']), array('escape' => false, 'class' => 'btn btn-danger btn-sm', 'confirm' =>'削除してもよろしいですか？'))?></td>
          <?php } ?>	
          <td class="<?php echo $val['Applicant']['status'];?>">
                  <div id='inline-example'>	
                     <?php
                        $this->Fancybox->setProperties( array( 
  			  		        'class' => 'fancybox1 btn btn-warning',
  			  		        'className' => 'fancybox.ajax',
  			  		        'title'=>'メモを書く',
  			  		        'ajaxUrl'=>'/notes/add/' . $val['Applicant']['id'] . '/Applicant'
  					      )
				       );
                       $this->Fancybox->setPreviewContent('<i class="glyphicon glyphicon-edit"></i>'); // the link which will trigger fancybox on click
                       echo $this->Fancybox->output();		

                    ?>
                  </div>
          </td>
        </tr>
      <?php } ?>
    </thead>
  </table>
<?php } ?>


</div>
<?php echo $this->Js->writeBuffer(); ?>
