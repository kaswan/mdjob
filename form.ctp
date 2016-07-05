<?php echo $this->html->script('ajaxzip3'); ?>
<?php echo $this->Form->create('Applicant'); ?>

        
        <div class="box-body">
            <div class="row">
                <div class="col-xs-6">
                    <?php echo $this->Form->input('work_type_id', array('label' => false, 'class' => 'form-control', 'options' => $work_types)); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                <legend>基本情報</legend>
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-6">
                   <?php echo $this->Form->input('name', array('label' => 'お名前', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-6">
                   <?php echo $this->Form->input('furigana', array('label' => 'ふりがな', 'class' => 'form-control')); ?>
                </div>                        
            </div>
            <div class="row">
              <div class="col-xs-6">
                 
                 <?php
                   echo $this->Form->label('gender', '性別');
                   echo "&nbsp;&nbsp;";
                   echo $this->Form->radio('gender', array('男' => '&nbsp;男性&nbsp;&nbsp;&nbsp;', '女' => '&nbsp;女性&nbsp;'),  array('legend' => false, 'div' => false, ));           
                 ?>
               </div> 
               <div class="col-xs-6 date-selects">
                   <?php        
                       echo $this->Form->input('date_of_birth', array(
                                                               'label' => '生年月日&nbsp;',  
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
               </div> 
            </div>
            <div class="row">
                <div class="col-xs-12">
                <legend>ご連絡先</legend>
                </div>
            </div>    
            <div class="row">
                <div class="col-xs-3">
                  <?php echo $this->Form->input('postalcode', array('label' => '郵便番号', 'class' => 'form-control', 
                  'onkeyup'=>"AjaxZip3.zip2addr('data[Applicant][postalcode]','','data[Applicant][prefecture_id]','data[Applicant][address]')")); ?>
                </div>
                <div class="col-xs-3">
                 
                  <?php echo $this->Form->input('prefecture_id', array('label' => '都道府県', 'class' => 'form-control','options' => array('' => '選択してください') + $prefectures)); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('address', array('label' => 'ご住所', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3">
                  <?php echo $this->Form->input('nearest_station', array('label' => '最寄駅', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-3">
                  <?php echo $this->Form->input('tel', array('label' => '電話番号', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('email', array('label' => 'メールアドレス', 'class' => 'form-control')); ?>
                </div>
            </div>
                        
            <div class="row">
               <div class="col-xs-12">
	               <legend>最終学歴</legend>
	           </div>
	        </div>       
	        <div class="row">
               <div class="col-xs-12">
                  <?php 
                  echo $this->Form->radio('education',
			 
									array(
										"大学" => "大学", 
										"専門学校" => "専門学校", 
										"高校" => "高校",
										"その他" => "その他"), 
									array('legend' => false, 'div' => false)); ?>
               </div>
            </div>
               
            <div class="row">
               <div class="col-xs-12">
                 <legend>希望条件</legend>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12">
                  <?php 
                  echo $this->Form->label('employment_pattern', '雇用形態');
                  echo "<br>";
                  echo $this->Form->radio('employment_pattern', 
									array(
										"常勤（夜勤有）" => "常勤（夜勤有）", 
										"常勤（夜勤無）" => "常勤（夜勤無）", 
										"非常勤" => "非常勤",
										"夜勤常勤" => "夜勤常勤",
										"夜勤アルバイト" => "夜勤アルバイト",
										"派遣" => "派遣",
										"応援" => "応援",
										"その他" => "その他"), 
									array('legend' => false, 'div' => false)); ?>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12">
				<?php
				echo $this->Form->label('desired_joining_time', '転職時期');
				echo "<br>";
				echo $this->Form->radio('desired_joining_time', 
									array(
										"即日可能" => "即日可能",
						               "1ヶ月以内" => "1ヶ月以内",
						               "3ヶ月以内" => "3ヶ月以内",
						               "6ヶ月以内" => "6ヶ月以内",
						               "１年以内" => "１年以内",
						               "未定" => "未定"),
								array('legend' => false, 'div' => false));
				?>
               </div>
            </div> 
            
            <div class="row">
               <div class="col-xs-12">
				<?php
				echo $this->Form->label('places_of_employment', '就業場所');
				echo "<br>";
				echo $this->Form->radio('places_of_employment', 
									array(
										"病院" => "病院",
						               "クリニック" => "クリニック",
						               "施設" => "施設",
						               "訪問" => "訪問",
						               "企業" => "企業",
						               "その他" => "その他"),
								array('legend' => false, 'div' => false));
				?>
               </div>
            </div> 
            <div class="row">
            	<div class="col-xs-6">
                  <?php echo $this->Form->input('annual_income', array('label' => '年収', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('holiday', array('label' => '休日', 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row">
            	<div class="col-xs-6">
                  <?php echo $this->Form->input('working_hours', array('label' => '勤務時間', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('commuting_time', array('label' => '通勤時間', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="row">
               <div class="col-xs-12">
				<?php
				echo $this->Form->label('commuting', '交通');
				echo "<br>";
				echo $this->Form->radio('commuting', 
									array(
										"公共交通機関" => "公共交通機関",
						               "車" => "車",
						               "バイク" => "バイク",
						               "自転車" => "自転車",
						               "徒歩" => "徒歩"),
								array('legend' => false, 'div' => false));
				?>
               </div>
            </div> 
             
            <div class="row">
               <div class="col-xs-12">
                  <legend>現在の就業状況</legend>
                  <?php echo $this->Form->radio('employment_status', array("在職中（退職時期未定）" => "在職中（退職時期未定）", 
                                               "在職中（退職時期確定済み）" => "在職中（退職時期確定済み）", 
                                               "離職中" => "離職中"), array('legend' => false, 'div' => false));
                                               ?>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12">
	               <legend>希望勤務地</legend>
	           </div>
	        </div>       
            <div class="row">
               <div class="col-xs-6">
                   <?php echo $this->Form->input('desired_location_first_id', array('class' => 'form-control', 'label' => '第1希望', 'options' => array('' => '選択してください') + $prefectures)); ?>
               </div>
               <div class="col-xs-6">
                   <?php echo $this->Form->input('desired_location_second_id', array('class' => 'form-control', 'label' => '第2希望', 'options' => array('' => '選択してください') + $prefectures)); ?>
               </div>
            </div>
            
            <div class="row">
              <div class="col-xs-12">
	              <legend>希望事業所</legend>
	              <?php foreach($businesses as $id => $val){?>
	       
	              <span style="width:25%;float:left; margin-top:10px;">
	                <input id = "<?php echo $id?>" name='data[DesiredJob][]' value="<?php echo $id?>" class='checkbox ' type="checkbox" <?php if(!empty($desired_jobs) && in_array($id,array_values($desired_jobs))) echo "checked";?>/>
	                <label for="<?php echo $id?>">                                  
	                <b><?php echo $val; ?></b>
	                </label>
	              </span> 
	       
	                <?php if($id % 4 == 0) echo "<br><br>"; ?>            
	              <?php }?>
	          </div>
            </div>
            
            <div class="row">
               <div class="col-xs-12">
	               <legend>資格取得年</legend>
	           </div>
	        </div>
	        <div class="row">
               <div class="col-xs-4">       
                   <?php
	                 $years = array('' => "選択してください");
	                 foreach (range(date('Y'), 1935) as $number) $years[$number] = $number; 
	                 echo $this->Form->input('qualification_year', array('class' => 'form-control', 'label' => false,'type' => 'select',
	                                                                        'options' => $years 
	                ));?> 
               </div>
            </div>   
            <div class="row">   
               <div class="col-xs-12">
	               <legend>これまでの職務経歴</legend>
	               <div class="row">
	               <div class="col-xs-2">職務履歴①</div> 
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.0.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '施設形態を選択してください') + $businesses )); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.0.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '勤務年数を選択してください') + $service_periods)); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴②</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.1.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '施設形態を選択してください') + $businesses )); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.1.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '勤務年数を選択してください') + $service_periods)); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴③</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.2.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '施設形態を選択してください') + $businesses)); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.2.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '勤務年数を選択してください') + $service_periods)); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴④</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.3.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '施設形態を選択してください') + $businesses)); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.3.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '勤務年数を選択してください') + $service_periods)); ?></div>
	               </div>
	               <div class="row"> 
	               <div class="col-xs-2">職務履歴⑤</div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.4.business_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '施設形態を選択してください') + $businesses)); ?></div>
	               <div class="col-xs-5"><?php echo $this->Form->input('WorkHistory.4.service_period_id', array('class' => 'form-control', 'label' => false, 'div' => false, 'options' => array('' => '勤務年数を選択してください') + $service_periods)); ?></div>
	               </div>
               </div>
            </div>
            
            <div class="row">   
               <div class="col-xs-12">
                  <legend>備考</legend>
                 <?php  echo $this->Form->input('remarks', array('label' => false, 'class' => 'form-control'));  ?>
               </div>
            </div>
	    </div>
       
<?php echo $this->Form->end(__('Submit')); ?>