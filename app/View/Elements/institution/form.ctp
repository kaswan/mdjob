<?php echo $this->html->script('ajaxzip3'); ?>
<?php echo $this->Form->create('Institution', array('type' => 'file')); ?>

        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                <kbd>基本情報</kbd>
                
                </div>
            </div>
            
            <div class="row">
            	<div class="col-xs-1"></div> 
                <div class="col-xs-5">
                   <?php echo $this->Form->input('corporate_name', array('label' => '法人名', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-5">
                   <?php echo $this->Form->input('corporate_furigana', array('label' => 'ふりがな', 'class' => 'form-control')); ?>
                </div>                        
            </div>
            
            <div class="row">
            	<div class="col-xs-1"></div> 
                <div class="col-xs-5">
                   <?php echo $this->Form->input('name', array('label' => '名称', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-5">
                   <?php echo $this->Form->input('furigana', array('label' => 'ふりがな', 'class' => 'form-control')); ?>
                </div>                        
            </div>
                        
            <div class="row">
                <div class="col-xs-12">
                <kbd>ご住所</kbd>
                </div>
            </div>    
            <div class="row">
                <div class="col-xs-1"></div>                
                <div class="col-xs-2">
                  <?php echo $this->Form->input('postalcode', array('label' => '郵便番号', 'class' => 'form-control', 
                  'onkeyup'=>"AjaxZip3.zip2addr('data[Institution][postalcode]','','data[Institution][prefecture_id]','data[Institution][address]')")); ?>
                </div>
                <div class="col-xs-3">
                 
                  <?php echo $this->Form->input('prefecture_id', array('label' => '都道府県', 'class' => 'form-control','options' => array('' => '選択してください') + $prefectures)); ?>
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('address', array('label' => '市区町村', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                <kbd>最寄駅</kbd>
                </div>
            </div>
            
            <div class="row">      
            	<div class="col-xs-1"></div>
                <div class="col-xs-6">
                  <?php echo $this->Form->input('nearest_station', array('label' => '最寄駅', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                <kbd>ご連絡先</kbd>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('tel', array('label' => '電話番号', 'type' => 'tel', 'class' => 'form-control js-characters-change',)); ?>
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('fax', array('label' => 'FAX番号', 'class' => 'form-control js-characters-change',)); ?>
                </div>
                
            </div>
            <div class="row"> 
                <div class="col-xs-1"></div>
	            <div class="col-xs-5">
	              <?php echo $this->Form->input('email', array('label' => 'メールアドレス', 'class' => 'form-control')); ?>
	            </div>
	            <div class="col-xs-5">
	              <?php echo $this->Form->input('url', array('label' => 'HPアドレス', 'class' => 'form-control')); ?>
	            </div>
	        </div>
            
            <div class="row"> 
               <div class="col-xs-1"></div>  
               <div class="col-xs-11">
                  <fieldset>
                     <table id="contact-table">
                        <thead>
                           <tr>
                              <th>部署</th>
                              <th>お役職名</th>
                              <th>ご担当者名</th>
                              <th>直通電話番号</th>
                              <th>Email</th>
                              <th>&nbsp;</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (!empty($this->request->data['ContactPerson'])) :?>
                              <?php for ($key = 0; $key < count($this->request->data['ContactPerson']); $key++) :?>
                                 <?php echo $this->element('institution/contact_person', array('key' => $key));?>
                              <?php endfor;?>
                           <?php endif;?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <td colspan="5"></td>
                              <td><a href="#" class="add btn-success btn-xs">追加</a></td>
                           </tr>
                        </tfoot>
                     </table>
                  </fieldset>
                  <script id="contact-template" type="text/x-underscore-template">
                     <?php echo $this->element('institution/contact_person');?>
                  </script>
               </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                <kbd>施設詳細</kbd>
                </div>
            </div>    
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-5">
                <?php 
                   echo $this->Form->label('classification', '区分');
                   echo "<br>";
                   echo $this->Form->input('classification', array(
                              'div' => false, 'label' => false, 'class' => 'form-control',
                              'options' => array("" => "-- 区分を選択 --",
                              					'総合病院' => '総合病院',
                              					'急性期' => '急性期',
                              					'回復期' => '回復期',
                              					'療養型' => '療養型',
                              					'維持期' => '維持期',
                              					'単科病院' => '単科病院',
                              					'介護老人保健施設' => '介護老人保健施設',
                              					'特別養護老人ホーム' => '特別養護老人ホーム',
                              					'介護付き有料老人ホーム' => '介護付き有料老人ホーム',
                              					'クリニック' => 'クリニック',
                              					'訪問看護ステーション' => '訪問看護ステーション',
                              					'その他' => 'その他'))); 
                ?>                                                 
                                
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('clinical_departments', array('label' => '科目', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('number_of_beds', array('label' => '病床数', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('nursing_standards', array('label' => '看護基準', 'class' => 'form-control')); ?>
                </div>                
            </div>
            
            <div class="row">
                <div class="col-xs-1"></div>
                
                <div class="col-xs-5">
                  <?php echo $this->Form->input('number_of_users', array('label' => '利用者数', 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('expected_annual_income', array('label' => '想定年収', 'class' => 'form-control')); ?>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-xs-12">
                	<kbd>契約情報</kbd>
                </div>
            </div>    
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-5">
                <label>契約締結年月</label><br>
                   <?php echo $this->Form->input('agreement_date', array('div' => false, "label" => false,
													'empty' => true,
													'dateFormat' => 'YMD',
													'monthNames' => false,
    												'minYear' => date('Y') - 50,
    												'maxYear' => date('Y') + 10,
    												'separator' => '/',
        											'separator' => array('年', '月', '日'),
    				));?>
                      
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->input('contract_percentage', array('label' => '契約パーセンテージ', 'class' => 'form-control')); ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10">
                	<?php  echo $this->Form->input('contract_refund_policy', array('label' => '返金規定', 'rows' => 2,'class' => 'form-control'));  ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10">
                	<?php  echo $this->Form->input('contract_document', array('label' => '書類関係', 'rows' => 2,'class' => 'form-control'));  ?>
                </div>
            </div>  
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10">
                	<?php  echo $this->Form->input('interview_information', array('label' => '面接情報', 'rows' => 2,'class' => 'form-control'));  ?>
                </div>
            </div>      
            <div class="row">
               <div class="col-xs-12">
                  <kbd>その他・ご要望など</kbd>
               </div>
            <div>   
            
            <div class="row">
               <div class="col-xs-1"></div>
               <div class="col-xs-10">
                 <?php  echo $this->Form->input('other', array('label' => '備考', 'class' => 'form-control'));  ?>
               </div>
            </div>
            
            <div class="row">
               
               <div class="col-xs-1"></div>
               <div class="col-xs-10">
                  <fieldset>
                  <legend><kbd>資料</kbd></legend>
                     <table id="upload-table">                        
                        <tbody>
                           <?php if (!empty($this->request->data['UploadDocument'])) :?>
                              <?php for ($key = 0; $key < count($this->request->data['UploadDocument']); $key++) :?>
                                 <?php echo $this->element('upload/show', array('key' => $key, 'type' => 'Institution', 'data' => $this->request->data['UploadDocument'][$key]));?>
                              <?php endfor;?>
                           <?php endif;?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <td colspan="3"></td>
                              <td><a href="#" class="add btn-success btn-xs">追加</a></td>
                           </tr>
                        </tfoot>
                     </table>
                  </fieldset>
                  <script id="upload-template" type="text/x-underscore-template">
                     <?php echo $this->element('upload/add', array('type' => 'Institution'));?>
                  </script>
               </div>
            </div>
            
	    </div>
	    <div class="row">
            <div class="col-xs-11">
            	<?php echo $this->Form->hidden('id', array('value' => !empty($this->request->data['Institution']['id']) ? $this->request->data['Institution']['id'] : '')); ?>
				<center>
					<?php echo $this->Form->end(array('label' => '保存する', 'class' => 'btn btn-success', 'style' => 'width:250px;font-size:20px;font-weight:bold;position:fixed; bottom:20px;')); ?>
				</center>
			</div>
		</div>			
</div>



<script>
$(document).ready(function() {
    var
        contactTable = $('#contact-table'),
        contactBody = contactTable.find('tbody'),
        contactTemplate = _.template($('#contact-template').remove().text()),
        numberRows = contactTable.find('tbody > tr').length;

    contactTable
        .on('click', 'a.add', function(e) {
            e.preventDefault();

            $(contactTemplate({key: numberRows++}))
                .hide()
                .appendTo(contactBody)
                .fadeIn('fast');
        })
        .on('click', 'a.remove', function(e) {
                e.preventDefault();

            $(this)
                .closest('tr')
                .fadeOut('fast', function() {
                    $(this).remove();
                });
        });

        if (numberRows === 0) {
            contactTable.find('a.add').click();
        }
});
</script>

<script>
$(document).ready(function() {
    var
        uploadTable = $('#upload-table'),
        uploadBody = uploadTable.find('tbody'),
        uploadTemplate = _.template($('#upload-template').remove().text()),
        numberRows = uploadTable.find('tbody > tr').length;

    uploadTable
        .on('click', 'a.add', function(e) {
            e.preventDefault();

            $(uploadTemplate({key: numberRows++}))
                .hide()
                .appendTo(uploadBody)
                .fadeIn('fast');
        })
        .on('click', 'a.remove', function(e) {
                e.preventDefault();

            $(this)
                .closest('tr')
                .fadeOut('fast', function() {
                    $(this).remove();
                });
        });

        if (numberRows === 0) {
            uploadTable.find('a.add').click();
        }
});
</script>

<script type="text/javascript">
$(function(){
    $(".js-characters-change").blur(function(){
        charactersChange($(this));
    });


    charactersChange = function(ele){
        var val = ele.val();
        var han = val.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});

        if(val.match(/[Ａ-Ｚａ-ｚ０-９]/g)){
            $(ele).val(han);
        }
    }
});
</script>