<div class="row">
	<div class="col-xs-1">
  		<?php echo $this->html->link('求職者一覧へ', array('controller' => 'applicants', 'action' => 'index'), array('class' => 'btn btn-success ')); ?><br><br>
 		<?php echo $this->html->link('編集する', array('controller' => 'applicants', 'action' => 'edit', !empty($applicant) ? $applicant['Applicant']['id']: ''), array('class' => 'btn btn-warning ')); ?><br><br>
  		<?php echo $this->html->link('PDF出力', array('controller' => 'applicants', 'action' => 'print_view', !empty($applicant) ? $applicant['Applicant']['id']: ''), array('class' => 'btn btn-info ', 'target' => '_blank')); ?><br><br>
  		
  		<div id='inline-example'>	
                     <?php
                        $this->Fancybox->setProperties( array( 
  			  		        'class' => 'fancybox1 btn btn-danger',
  			  		        'className' => 'fancybox.ajax',
  			  		        'title'=>'エントリーPDF出力',
  			  		        'ajaxUrl'=>'/applicants/sender_info/' . $applicant['Applicant']['id']
  					      )
				       );
                       $this->Fancybox->setPreviewContent('エントリーPDF出力'); // the link which will trigger fancybox on click
                       echo $this->Fancybox->output();		

                    ?>
                  </div>
  		<br><br>
	</div>

    <div class="col-xs-7">
		<div class="users form">
			<abbr title="ステータス"><label class='label label-danger'><?php echo $applicant['ProgressStatus']['name']?></label></abbr>
			<abbr title="法人施設名"><label class='label label-warning'><?php echo $applicant['Institution']['name']?></label></abbr>			
			<?php echo $this->element('applicant/show',array('applicant' => $applicant)); ?>
		</div>
	</div>
	<div class="col-xs-4">	    
   		<pre>コンタクト履歴</pre>
   		<?php echo $this->element('note/edit', array('notes' => Hash::sort($applicant['Note'], '{n}.note.date_time', 'DESC'), 'target_id' => $applicant['Applicant']['id'], 'type' => 'Applicant' )); ?>
   		        
  	</div>
</div>
