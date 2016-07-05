<?php if(!empty($applicant)){ ?>
  <pre><span style="float:left;margin:5px;">ES-<?php echo $applicant['Applicant']['id']?></span></pre>
  <table >
    <thead>
      <tr>
        <th colspan="3"><kbd>基本情報</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td><b>ニックネーム</b></td>
        <td colspan="2"><?php echo $applicant['Applicant']['nickname'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>お名前</b></td>
        <td><span style="float:left;max-width:100%;"><?php echo $applicant['Applicant']['name'] ?></span></td>
        <td><span style="float:left;max-width:100%;"><code style="color:#000;background-color:#F9F2DC;">性別</code> : <?php echo $applicant['Applicant']['gender'] ?></span></td>
      </tr>
      <tr>
        <td><b>ふりがな</b></td>
        <td colspan="2"><?php echo $applicant['Applicant']['furigana'] ?></td>
      </tr>
      <tr>
        <td><b>生年月日</b></td>
        <td><span style="float:left;max-width:100%;"><?php if(!empty($applicant['Applicant']['date_of_birth']))echo $this->Time->format($applicant['Applicant']['date_of_birth'], '%Y年%m月%d日') ?></span></td>
        <td><span style="float:left;max-width:100%;"><code style="color:#000;background-color:#F9F2DC;">年齢</code> : <?php echo $applicant['Applicant']['age'] ?></span></td>
      </tr>
      <tr>
        <td rowspan='3'><b>ご住所</b></td>
        <td colspan="2">〒<?php echo $applicant['Applicant']['postalcode'] ?></td>
      </tr>
      <tr>        
        <td colspan="2"><?php echo ($applicant['Applicant']['prefecture_id'] > 0 ? $prefectures[$applicant['Applicant']['prefecture_id']] : '' . '　' ) . $applicant['Applicant']['address'] ?></td>
      </tr>
      <tr>        
        <td colspan="2"><?php echo $applicant['Applicant']['house_address'] ?></td>
      </tr>
      <tr>
        <td rowspan='2'><b>ご連絡先</b></td>
        <td colspan="2">
        	<code style="color:#000;background-color:#F9F2DC;">携帯電話&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>： <?php echo $applicant['Applicant']['tel'] ?><br>
        	<code style="color:#000;background-color:#F9F2DC;">固定電話&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>： <?php echo $applicant['Applicant']['tel_home'] ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        	<code style="color:#000;background-color:#F9F2DC;">メールアドレス(PC)&nbsp;&nbsp;</code>： <?php echo $applicant['Applicant']['email'] ?><br>
            <code style="color:#000;background-color:#F9F2DC;">メールアドレス(携帯)&nbsp;</code>： <?php echo $applicant['Applicant']['email_mobile'] ?>
        </td>
      </tr>
      <tr>
        <td ><b>最寄駅</b></td>
        <td colspan="2"><?php echo $applicant['Applicant']['nearest_station'] ?></td>
      </tr>
      <tr>
        <td><b>最終学歴</b></td>
        <td colspan="2"><?php echo $applicant['Applicant']['education'] ?></td>
      </tr>
    </tbody>
  </table>
  
  <br>
  <table>
    <thead>
      <tr>
        <th ><kbd>取得資格</kbd></th>    
        <th ><kbd>取得年月</kbd></th>   
      </tr>
    </thead>
    
    <tbody>
     <?php foreach($applicant['QualificationHistory'] as $qualification) {?>
        <tr>
        	<td><?php echo($qualification['name'])?></td>
        	<td><?php echo($qualification['year']. '年'. $qualification['month'] . '月')?></td>
        </tr>
        
     <?php } ?>     
    </tbody>
  </table>
  
  <br>
  <table>
    <thead>
      <tr>
        <th colspan="2"><kbd>希望条件</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td width="150px"><b>雇用形態</b></td>
        <td><?php echo $applicant['Applicant']['employment_pattern'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>雇用形態_備考</b></td>
        <td><?php echo $applicant['Applicant']['employment_pattern_remarks'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>希望転職時期</b></td>
        <td><?php echo $applicant['Applicant']['desired_joining_time'] ?></td>
      </tr>
      
      <tr>
        <td width="150px"><b>就業場所</b></td>
        <td><?php echo $applicant['Applicant']['places_of_employment'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>希望部署</b></td>
        <td><?php echo $applicant['Applicant']['desired_department'] ?></td>
      </tr>
      
      <tr>
        <td width="150px"><b>希望年収</b></td>
        <td><?php echo $applicant['Applicant']['annual_income'] ?></td>
      </tr>
      
      <tr>
        <td width="150px"><b>希望休日</b></td>
        <td><?php echo $applicant['Applicant']['holiday'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>勤務日数</b></td>
        <td><?php echo $applicant['Applicant']['desired_working_days'] ?></td>
      </tr>
      
      <tr>
        <td width="150px"><b>希望勤務時間</b></td>
        <td><?php echo $applicant['Applicant']['working_hours'] ?></td>
      </tr>
      
      <tr>
        <td width="150px"><b>希望通勤時間</b></td>
        <td><?php echo $applicant['Applicant']['commuting_time'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>交通</b></td>
        <td><?php echo $applicant['Applicant']['commuting'] ?></td>
      </tr>
    </tbody>
  </table>
  
  
  
  <br>
  <table>
    <thead>
      <tr>
        <th><kbd>勤務先名称</kbd></th>
        <th><kbd>名称</kbd></th>
        <th><kbd>部署</kbd></th>
        <th><kbd>科目</kbd></th>
        <th><kbd>雇用形態</kbd></th>
        <th><kbd>在籍年</kbd></th>   
      </tr>
    </thead>
    
    <tbody>
     <?php foreach($applicant['WorkHistory'] as $work) {?>
        <tr>
        	<td><?php echo($work['company_name'])?></td>
        	<td><?php echo($work['short_name'])?></td>
        	<td><?php echo($work['department_name'])?></td>
        	<td><?php echo($work['discipline'])?></td>
        	<td><?php echo($work['employment_pattern'])?></td>
        	<td><?php echo($work['enrollment_year'])?></td>
        </tr>
        
     <?php } ?>     
    </tbody>
  </table> 
  <br>
  <table>
    <thead>
      <tr>
        <th colspan="2"><kbd>契約情報</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
  	  <tr>
        <td width="200px"><b>書類関係</b></td>
        <td><?php echo nl2br($applicant['Applicant']['contract_document']) ?></td>
      </tr>
   </tbody>
  </table>   
  <br>
  <table>
    <thead>
      <tr>
        <th><kbd>備考</kbd></th>
      </tr>
    </thead>
    
    <tbody>
      <tr>        
        <td><?php echo nl2br($applicant['Applicant']['remarks']) ?></td>
      </tr>      
    </tbody>
  </table>
  
  <br>
  <table>
    <thead>
      <tr>
        <th><kbd>備考（エントリシート用）</kbd></th>
      </tr>
    </thead>
    
    <tbody>
      <tr>        
        <td><?php echo nl2br($applicant['Applicant']['entry_sheet_remarks']) ?></td>
      </tr>      
    </tbody>
  </table>
  
  <br>
  <table>
    <thead>
      <tr>
        <th><kbd>資料</kbd></th>
        <th></th>        
      </tr>
    </thead>
    
    <tbody>
     <?php foreach($applicant['UploadDocument'] as $upload) {?>
        <tr>
        	<td><?php echo($upload['remark'])?></td>
        	<td><?php echo $this->Html->link($upload['document'], $upload['document_path'], array('target' => 'blank'))?></td>
        </tr>
     <?php } ?>     
    </tbody>
  </table>

<?php } ?>