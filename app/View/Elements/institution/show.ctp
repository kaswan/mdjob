<?php if(!empty($institution)){ ?>
  <pre>施設情報</pre>
  <table >
    <thead>
      <tr>
        <th colspan="2"><kbd>基本情報</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td width="200px"><b>法人名</b></td>
        <td><span style="float:left;width:80%;"><?php echo $institution['Institution']['corporate_name'] ?></span></td>
      </tr>
      <tr>
        <td><b>ふりがな</b></td>
        <td colspan="2"><?php echo $institution['Institution']['corporate_furigana'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>名称</b></td>
        <td><span style="float:left;width:80%;"><?php echo $institution['Institution']['name'] ?></span></td>
      </tr>
      <tr>
        <td><b>ふりがな</b></td>
        <td colspan="2"><?php echo $institution['Institution']['furigana'] ?></td>
      </tr>
      
      <tr>
        <td rowspan='2'><b>ご住所</b></td>
        <td >〒<?php echo $institution['Institution']['postalcode'] ?></td>
      </tr>      
      <tr>        
        <td ><?php echo ($institution['Institution']['prefecture_id'] > 0 ? $prefectures[$institution['Institution']['prefecture_id']] : '' . '　' ) . $institution['Institution']['address'] ?></td>
      </tr>
      <tr>
        <td><b>最寄駅</b></td>
        <td colspan="2"><?php echo $institution['Institution']['nearest_station'] ?></td>
      </tr>
      <tr>
        <td rowspan='4'><b>ご連絡先</b></td>
        <td ><code style="color:#000;background-color:#F9F2DC;">電話番号&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>： <?php echo $institution['Institution']['tel'] ?></td>
      </tr>
      <tr>
        <td ><code style="color:#000;background-color:#F9F2DC;">FAX番号&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>： <?php echo $institution['Institution']['fax'] ?></td>
      </tr>
      <tr>
        <td ><code style="color:#000;background-color:#F9F2DC;">メールアドレス&nbsp;</code>： <?php echo $institution['Institution']['email'] ?></td>
      </tr>
      <tr>
        <td ><code style="color:#000;background-color:#F9F2DC;">HPアドレス&nbsp;&nbsp;&nbsp;&nbsp;</code>： <?php echo $institution['Institution']['url'] ?></td>
      </tr>
      
    </tbody>
  </table>
  <br>
  <table>
    <thead>
      <tr>
        <th><kbd>部署</kbd></th>
        <th><kbd>お役職名</kbd></th>
        <th><kbd>ご担当者名</kbd></th>
        <th><kbd>直通電話番号</kbd></th>
        <th><kbd>Email</kbd></th>
      </tr>
    </thead>
    
    <tbody>
     <?php foreach($institution['ContactPerson'] as $contact) {?>
        <tr>
        	<td><?php echo($contact['department'])?></td>
        	<td><?php echo($contact['name'])?></td>
        	<td><?php echo($contact['title'])?></td>
        	<td><?php echo($contact['direct_phone_number'])?></td>
        	<td><?php echo($contact['email'])?></td>
        </tr>
        
     <?php } ?>     
    </tbody>
  </table>
  <br>
  <table>
    <thead>
      <tr>
        <th colspan = '2' ><kbd>施設詳細</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td width="200px"><b>区分</b></td>
        <td><?php echo $institution['Institution']['classification'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>科目</b></td>
        <td><?php echo $institution['Institution']['clinical_departments'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>病床数</b></td>
        <td><?php echo $institution['Institution']['number_of_beds'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>看護基準</b></td>
        <td><?php echo $institution['Institution']['nursing_standards'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>利用者数</b></td>
        <td><?php echo $institution['Institution']['number_of_users'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>想定年収</b></td>
        <td><?php echo $institution['Institution']['expected_annual_income'] ?></td>
      </tr>
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
        <td width="200px"><b>契約締結年月</b></td>
        <td><?php if(!empty($institution['Institution']['agreement_date']))echo $this->Time->format($institution['Institution']['agreement_date'], '%Y年%m月%d日') ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>契約パーセンテージ</b></td>
        <td><?php echo $institution['Institution']['contract_percentage'] ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>返金規定</b></td>
        <td><?php echo nl2br($institution['Institution']['contract_refund_policy']) ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>書類関係</b></td>
        <td><?php echo nl2br($institution['Institution']['contract_document']) ?></td>
      </tr>
      
      <tr>
        <td width="200px"><b>面接情報</b></td>
        <td><?php echo nl2br($institution['Institution']['interview_information']) ?></td>
      </tr>    
    </tbody>
  </table>
  
  <table>
    <thead>
      <tr>
        <th colspan="2"><kbd>その他</kbd></th>      
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td width="150px"><b>備考</b></td>
        <td><?php echo nl2br($institution['Institution']['other']) ?></td>
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
     <?php foreach($institution['UploadDocument'] as $upload) {?>
        <tr>
        	<td><?php echo($upload['remark'])?></td>
        	<td><?php echo $this->Html->link($upload['document'], $upload['document_path'], array('target' => 'blank'))?></td>
        </tr>
     <?php } ?>     
    </tbody>
  </table>
<?php } ?>