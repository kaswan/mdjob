<?php if(!empty($applicant)){ ?>
  <pre style="padding:5px;"><span style="float:left;margin:5px;font-size:20px;">ES-<?php echo $applicant['Applicant']['id']?></span></pre>
  <table >
    <thead>
      <tr>
        <th colspan="3"><kbd>基本情報</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td width="150px"><b>お名前</b></td>
        <td><span style="float:left;max-width:100%;"><?php echo $applicant['Applicant']['nickname'] ?></span></td>
        <td><span style="float:left;max-width:100%;"><code style="color:#000;background-color:#F9F2DC;">性別</code> : <?php echo $applicant['Applicant']['gender'] ?></span></td>
      </tr>
      <tr>
        <td><b>年齢</b></td>
        <td colspan="2"><?php echo $applicant['Applicant']['age'] ?>歳</td>
      </tr>
      <tr>        
        <td><b>ご住所</b></td>
        <td colspan="2"><?php echo ($applicant['Applicant']['prefecture_id'] > 0 ? $prefectures[$applicant['Applicant']['prefecture_id']] : '' . '　' ) . $applicant['Applicant']['address'] ?></td>
      </tr>
      
      <tr>
        <td ><b>最寄駅</b></td>
        <td colspan="2"><?php echo $applicant['Applicant']['nearest_station'] ?></td>
      </tr>
    </tbody>
  </table>
  
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
    
  <table>
    <thead>
      <tr>
        <th><kbd>勤務先名称</kbd></th>
        <th><kbd>部署</kbd></th>
        <th><kbd>科目</kbd></th>
        <th><kbd>雇用形態</kbd></th>
        <th><kbd>在籍年</kbd></th>   
      </tr>
    </thead>
    
    <tbody>
     <?php foreach($applicant['WorkHistory'] as $work) {?>
        <tr>
        	<td><?php echo($work['short_name'])?></td>
        	<td><?php echo($work['department_name'])?></td>
        	<td><?php echo($work['discipline'])?></td>
        	<td><?php echo($work['employment_pattern'])?></td>
        	<td><?php echo($work['enrollment_year'])?></td>
        </tr>
        
     <?php } ?>     
    </tbody>
  </table> 
  
   <table>
    <thead>
      <tr>
        <th colspan="2"><kbd>希望条件</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td width="150px"><b>勤務形態</b></td>
        <td><?php echo $applicant['Applicant']['employment_pattern'] ?></td>
      </tr>
      <tr>
        <td width="150px"><b>希望転職時期</b></td>
        <td><?php echo $applicant['Applicant']['desired_joining_time'] ?></td>
      </tr>
      
      <tr>
        <td width="150px"><b>希望部署</b></td>
        <td><?php echo $applicant['Applicant']['desired_department'] ?></td>
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
  <?php if(!empty($applicant['Applicant']['entry_sheet_remarks'])) { ?>
  <table>
    <thead>
      <tr>
        <th><kbd>備考</kbd></th>
      </tr>
    </thead>
    
    <tbody>
      <tr>        
        <td><?php echo nl2br($applicant['Applicant']['entry_sheet_remarks']) ?></td>
      </tr>
    </tbody>
  </table>
  <?php }?>
<?php } ?>
<br>

<div style="width:520px;float:right;">
メディカルジョブズ<br>
〒１０１－００５２ 東京都千代田区神田小川町２－３－１３ M＆Cビル２階<br>
TEL： ０３－５５７７－８００１　FAX： ０３－５５７７－８００２<br>
担当者： <?php echo $applicant['User']['name']?>
</div>
<div style="width:100px;float:right;">
<?php echo $this->Html->image('logo.jpeg', array('width' => '75'))?>
</div>