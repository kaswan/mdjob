
<div class="actions">
  <?php echo $this->html->link('一覧へ', array('controller' => 'applicants', 'action' => 'index'), array('class' => 'btn btn-success btn-lg')); ?>
</div>
<div class="users form">

<?php echo $this->Form->create('Applicant'); ?>

        <legend><?php echo __('Add User'); ?></legend>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-6">
                    <?php echo $this->Form->input('work_type_id', array('class' => 'form-control', 'options' => $work_types)); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                   <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-6">
                   <?php echo $this->Form->input('furigana', array('class' => 'form-control')); ?>
                </div>                        
            </div>
            <div class="row">
              <div class="col-xs-6">
                 <?php
                   echo $this->Form->input('gender', array('type' => 'radio', 'div' => false, 'class' => '',           
                                           'options' => array('男' => '男', '女' => '女')            
                                          ));
                 ?>
               </div> 
               <div class="col-xs-6 date-selects">
                 <fieldset>
	               <legend>生年月日</legend>
                   <?php        
                       echo $this->Form->input('date_of_birth', array(
                                                               'label' => false,  
                                                               'class' => 'date  ',
                                                               'dateFormat' => 'YMD',
                                                               'minYear' => date('Y') - 70,
                                                               'maxYear' => date('Y') ,
                                                               'monthNames'=>false,
                                                               'empty'=>array(0=>''),
                                                               'selected'=>array(
                                                                           'year'=>0,
                                                                           'month'=>0,
                                                                           'day'=>0
                                                               )
                                              )); ?>
                  <fieldset>              
               </div> 
            </div>
            
            <div class="row">
                <div class="col-xs-3">
                  <?php echo $this->Form->input('postalcode', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-3">
                  <?php echo $this->Form->input('prefecture_id', array('class' => 'form-control','options' => array_merge(array('0' => '選択してください'),$prefectures))); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('address', array('class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-6">
                  <?php echo $this->Form->input('tel', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                <?php echo $this->Form->input('contact_time', array(
                              'type' => 'radio', 'div' => false,
                              'options' => array('9:00〜12:00' => '9:00〜12:00', 
                                                 '12:00〜15:00' => '12:00〜15:00',
                                                 '15:00〜18:00' => '15:00〜18:00',
                                                 '18:00〜21:00' => '18:00〜21:00',
                                                 '21:00以降' => '21:00以降')));?>
                </div>
            </div>
            
            <div class="row">
               <div class="col-xs-6">
                 <fieldset>
	               <legend>year_of_experience</legend>
                   <?php echo $this->Form->input('year_of_experience', array(
                              'div' => false, 'label' => false, 'class' => 'form-control',
                              'options' => array("" => "選択してください",
                                                 "経験無し" => "経験無し",
                                                 "1年未満" => "1年未満",
                                                 "1〜3年未満" => "1〜3年未満",
                                                 "3〜5年未満" => "3〜5年未満",
                                                 "5〜10年未満" => "5〜10年未満",
                                                 "10年以上" => "10年以上"))); ?>
                 </fieldset>
               </div>
               <div class="col-xs-6">
                  
                 <fieldset>
	               <legend>desired_joining_time</legend>
                   <?php echo $this->Form->input('desired_joining_time', array(
                             'div' => false, 'label' => false, 'class' => 'form-control',
                             'options' => array(
								               "" => "選択してください",
								               "1ヶ月以内" => "1ヶ月以内",
								               "2ヶ月以内" => "2ヶ月以内",
								               "3ヶ月以内" => "3ヶ月以内",
								               "6ヶ月以内" => "6ヶ月以内",
								               "9ヶ月以内" => "9ヶ月以内",
								               "12ヶ月以内" => "12ヶ月以内"))); ?>
                  </fieldset>								               
               </div>
            </div>
            
            <div class="row">
               <div class="col-xs-5">
               <?php echo $this->Form->input('employment_pattern', array(
                            'type' => 'radio', 'div' => false, 'class' => '',
                            'options' => array("常勤" => "常勤", "非常勤" => "非常勤", "こだわらない" => "こだわらない"))); ?>
               </div>
               <div class="col-xs-7">
                  <?php echo $this->Form->input('employment_status', array(
                            'type' => 'radio', 'div' => false, 
                            'options' => array("在職中（退職時期未定）" => "在職中（退職時期未定）", 
                                               "在職中（退職時期確定済み）" => "在職中（退職時期確定済み）", 
                                               "離職中" => "離職中")));
                                               ?>
               </div>
            </div>
            
            <div class="row">
               <div class="col-xs-6">
                 <fieldset>
	               <legend>desired_location_first</legend>
                   <?php echo $this->Form->input('desired_location_first_id', array('class' => 'form-control', 'label' => false, 'options' => array_merge(array('0' => '選択してください'),$prefectures))); ?>
                 </fieldset>  
               </div>
               <div class="col-xs-6">
                 <fieldset>
	               <legend>desired_location_second</legend>
                   <?php echo $this->Form->input('desired_location_second_id', array('class' => 'form-control', 'label' => false,'options' => array_merge(array('0' => '選択してください'),$prefectures))); ?>
                 </fieldset>               
               </div>
            </div>
            
            <div class="row">
              <div class="col-xs-12">
	            <fieldset>
	              <legend>Desired Jobs</legend>
	              <?php foreach($businesses as $id => $val){?>
	       
	              <span style="width:25%;float:left; margin-top:10px;">
	                <input id = "<?php echo $id?>" name='data[DesiredJob][]' value="<?php echo $id?>" class='checkbox ' type="checkbox" <?php if(!empty($desired_jobs) && in_array($id,array_values($desired_jobs))) echo "checked";?>/>
	                <label for="<?php echo $id?>">                                  
	                <b><?php echo $val; ?></b>
	                </label>
	              </span> 
	       
	                <?php if($id % 4 == 0) echo "<br><br>"; ?>            
	              <?php }?>
	            </fieldset> 
	          </div>
            </div>
            
            <div class="row">
               <div class="col-xs-6">
                 <fieldset>
	               <legend>qualification_year</legend>
                   <?php
	                 $years = array('' => "選択してください");
	                 foreach (range(date('Y'), 1935) as $number) $years[$number] = $number; 
	                    echo $this->Form->input('qualification_year', array('class' => 'form-control', 'label' => false,'type' => 'select',
	                                                                        'options' => $years 
	                ));?> 
                 </fieldset>  
               </div>
            </div>   
            <div class="row">   
               <div class="col-xs-12">
                 <fieldset>
	               <legend>Work History</legend>
	               <div class="row">
	               <div class="col-xs-2">職務履歴①</div> 
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.0.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '施設形態を選択してください'), $businesses))); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.0.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '勤務年数を選択してください'), $service_periods))); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴②</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.1.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '施設形態を選択してください'), $businesses))); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.1.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '勤務年数を選択してください'), $service_periods))); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴③</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.2.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '施設形態を選択してください'), $businesses))); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.2.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '勤務年数を選択してください'), $service_periods))); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴④</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.3.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '施設形態を選択してください'), $businesses))); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.3.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '勤務年数を選択してください'), $service_periods))); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴⑤</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.4.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '施設形態を選択してください'), $businesses))); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.4.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array_merge(array('' => '勤務年数を選択してください'), $service_periods))); ?></div>
	               </div>
	             </fieldset>               
               </div>
            </div>
            
            <div class="row">   
               <div class="col-xs-12">
                 <?php  echo $this->Form->input('remarks', array('class' => 'form-control'));  ?>
               </div>
            </div>   
	    </div>
		            
       
<?php echo $this->Form->end(__('Submit')); ?>
  </div>
</div>