<div style="width:53%;float:left;font-size: 13px;">

<b>【FAX送信 】</b>
   
<div style="width: 30%; float: right;">
   <?php $dys = array("日","月","火","水","木","金","土");
     echo date('Y') . '年 ' . date('m') . '月 ' . date('d') . '日' . '(' . $dys[date('w')] . ')'; 
   ?>
</div>
<br>

<?php echo $company_name ?><br>
<?php echo $person_name ?><br>
<br>
突然のFAX失礼いたします。<br>
リハビリテーション専門の人材マッチングをしているリハビリWORK事業部の宮崎 彰伸と申します。<br>
この度、弊社にご登録された経験者の方が就業先を探しております。<br>
<br>
もし募集がございましたら、紹介をご検討いただければ幸いです。<br>
※編者は完全成功報酬となっており、ご登録の費用は一切かかりません。<br>
ご採用の場合のみマッチング手数料を頂戴しております。<br>
<br>
下記をご記入の上、FAXにてご返信いただければ私共よりご連絡差し上げます。<br>

<table>
  <tbody>
    <tr>
       <th>紹介（面接）を希望</th>
       <th>ご質問などございましたらご記入ください</th>
    </tr>
    <tr>
       <th>する　・　しない</th>
       <td></td>
    </tr>    
    
  </tbody>
</table>

<table class="no-border">
  <tr>
      <td colspan="2">企業名________________________________________</td>
  </tr>
  <tr>
      <td>役職名 _____________________</td>
      <td>ご担当者名 _____________________</td>
  </tr>
  <tr>
      <td>TEL ________________________</td>
      <td>FAX ___________________________</td>
  </tr>
  <tr>
      <td colspan="2">メールアドレス_______________________________________________________</td>
  </tr>
</table>

<table class="no-border">
  <tr><td colspan="2"><b>BrozGroup株式会社</b></td><tr>
  <tr>
    <td>所在地</td>
    <td>〒225-0002<br>神奈川県横浜市青葉区美しが丘1-13-10　吉村ビル</td>
  </tr>
  <tr>
    <td>連絡先</td>
    <td>045-905-3340（BrozGroup 内）<br>
リハビリWORK事業部　045-905-3342<br>
FAX: 045-905-3341</td>
  </tr>
</table>  

</div>
<div style="width:45%;float:right;">
<?php if(!empty($applicant)){ ?>
  <pre>キャリア・シート</pre>
  <table>
    <tr>
      <th width="120px">職種</th>
      <td colspan='3'><?php echo $work_types[$applicant['Applicant']['work_type_id']] ?></td>
    </tr>
    <tr>
      <th width="120px">年齢  性別</th>
      <td><?php if($applicant['Applicant']['age'] <= '100') echo $applicant['Applicant']['age'].'歳';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($applicant['Applicant']['gender'])) echo $applicant['Applicant']['gender'].'性';?></td>
      <th>住所</th>
      <td><?php if($applicant['Applicant']['prefecture_id'] > 0 ) echo $prefectures[$applicant['Applicant']['prefecture_id']];?></td>
    </tr>
  </table>
  <br>
  <b>学歴／免許／資格</b>
  <table>
    <tr>
      <td width="120px"><?php if($applicant['Applicant']['qualification_year']) echo $applicant['Applicant']['qualification_year']."年" ?></td>
      <td><?php if($applicant['Applicant']['qualification_year']) echo $work_types[$applicant['Applicant']['work_type_id']] . "　資格取得" ;?></td>
    </tr>
  </table>
  <b>職歴</b>
  <table>
    <thead>
      <tr>
        <td><b>施設形態</b></td>
        <td><b>勤務期間</b></td>      
      </tr>
    </thead>
    
    <tbody>
      <?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['0'])) { ?>
      <tr>        
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['0'])) echo $businesses[$applicant['WorkHistory']['0']['business_id']] ?></td>
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['0'])) echo $service_periods[$applicant['WorkHistory']['0']['service_period_id']] ?></td>
      </tr>
      <?php } ?>
      <?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['1'])) { ?>
      <tr>        
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['1'])) echo $businesses[$applicant['WorkHistory']['1']['business_id']] ?></td>
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['1'])) echo $service_periods[$applicant['WorkHistory']['1']['service_period_id']] ?></td>
      </tr>
      <?php } ?>
      <?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['2'])) { ?>
      <tr>        
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['2'])) echo $businesses[$applicant['WorkHistory']['2']['business_id']] ?></td>
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['2'])) echo $service_periods[$applicant['WorkHistory']['2']['service_period_id']] ?></td>
      </tr>
      <?php } ?>
      <?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['3'])) { ?>
      <tr>        
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['3'])) echo $businesses[$applicant['WorkHistory']['3']['business_id']] ?></td>
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['3'])) echo $service_periods[$applicant['WorkHistory']['3']['service_period_id']] ?></td>
      </tr>
      <?php } ?>
      <?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['4'])) { ?>
      <tr>        
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['4'])) echo $businesses[$applicant['WorkHistory']['4']['business_id']] ?></td>
        <td><?php if(!empty($applicant['WorkHistory']) && !empty($applicant['WorkHistory']['4'])) echo $service_periods[$applicant['WorkHistory']['4']['service_period_id']] ?></td>
      </tr>
      <?php } ?>
    </tbody>   
  </table>
  <br>
  <b>特記事項</b>
  <table class="table table-bordered">        
    <tbody>
      <tr>
        <td width="120px" rowspan='2'><b>就業希望など</b></td>
        <th width="100px">就業状況 </th>
        <td><?php echo $applicant['Applicant']['employment_status'] ?></td>
      </tr>
      <tr>
        <td colspan='2' style="height: 50px;">
           <?php echo nl2br($remarks) ?>
        </td>
      </tr>
      <!--
      <tr>
        <th>希望勤務地 </th>
        <td><span style="float:left;width:50%;">第1希望&nbsp;：&nbsp;<?php echo $applicant['Applicant']['desired_location_first_id'] > 0 ? $prefectures[$applicant['Applicant']['desired_location_first_id']] : "" ?></span>
            <span style="float:left;width:50%;">第2希望&nbsp;：&nbsp;<?php echo $applicant['Applicant']['desired_location_second_id'] > 0 ? $prefectures[$applicant['Applicant']['desired_location_second_id']] : "" ?></span></td>
      </tr>
      <tr>
        <th>希望事業所 </th>
        <td>
        <?php foreach(Set::classicExtract($applicant['DesiredJob'], '{n}.business_id') as $id => $val) { ?>
           <span style="float:left;width:33%;padding:5px 0px 5px 0px;"><?php echo $businesses[$val] ?></span>
           <?php $id++; if($id % 3 == 0) echo "<br>" ?>
        <?php } ?>   
        </td>
      </tr>
      -->
    </tbody>
  </table>
  
<b>【この件に関するお問い合わせ】</b><br>
BrozGroup株式会社<br>
TEL:　045-905-3342 &nbsp;&nbsp; FAX:　045-905-3341 <br>
担当： 宮崎 彰伸　&nbsp;&nbsp; E-MAIL： aki@zimotee.com <br>
<?php } ?>
</div>