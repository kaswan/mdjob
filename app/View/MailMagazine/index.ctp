<?php echo $this->Html->css('font-awesome');?>
<?php echo $this->Html->css('build');?>
<form action="sender" method="POST" id="mailForm">

  <div class="wrapper" >

  <div class="alert alert-warning">
    ※最初に内容確認をする場合は【確認用アドレス】にアドレスを入力し、送信ボタンを押してください。<br/>
    ・「送信する。」をチェックすると該当の本番メールリストに送信します。それ以外は確認用のテストメールのみ送信します。<br/>
    ・「メルマガ希望会員」を選択すると、都道府県・資格・雇用形態・年齢・性別の条件に応じてメルマガ希望会員にのみ送信します。<br/>
    
  </div>


  <table class="main">
    <tr>
    <th>送信種別</th>
    <td class="align_l">
      <div class="radio radio-success radio-inline">
         <input type="radio" id="mailMagazineRadio1" value="1" name="mail_magazine_subscription" checked>
         <label for="mailMagazineRadio1"> メルマガ希望会員 </label>
      </div>
      <div class="radio radio-danger radio-inline">
         <input type="radio" id="mailMagazineRadio2" value="all" name="mail_magazine_subscription">
         <label for="mailMagazineRadio2"> 全会員 </label>
      </div>
    </td>
    </tr>
    <tr>
      <th>居住都道府県</th>
      <td class="align_l" width="80%">
      <div class="alert alert-danger"><strong>※</strong>絞り込まない場合何もチェックしないでください。</div>
      <?php foreach($areas as $area_id => $area_name) {?>
        <kbd><?php echo $area_name ?></kbd>
        <?php foreach($prefectures[$area_id] as $id => $prefecture){ ?>
              <div class="checkbox checkbox-success checkbox-inline">
                 <input type="checkbox" class="styled" id="pre_<?php echo $id ?>" value="<?php echo $id ?>" name = "prefectures[]">
                 <label for="pre_<?php echo $id ?>"> <?php echo $prefecture ?> </label>
              </div>
        <?php }?>
        <br>
      <?php }?>
      </td>
    </tr>
    
    
    <tr>
      <th>資格</th>
      <td><?php echo $this->Form->input('qualification', array('label' => false, 'class' => 'form-control', 'options' => array('' => '--選んでください--') + $qualifications )); ?></td>
    </tr>
  
    <tr>
      <th>雇用形態</th>
      <td>
         <?php echo $this->Form->input('employment_pattern', array('label' => false, 'class' => 'form-control', 
               'options' => 
                 array('' => '--選んでください--', 
                    "常勤（夜勤有）" => "常勤（夜勤有）", 
										"常勤（夜勤無）" => "常勤（夜勤無）", 
										"非常勤" => "非常勤",
										"夜勤常勤" => "夜勤常勤",
										"夜勤アルバイト" => "夜勤アルバイト",
										"派遣" => "派遣",
										"応援" => "応援",
										"その他" => "その他") )); ?>
      </td>
    </tr>
      
    <tr>
    <th>年齢</th>
    <td class="align_l">
    <div class="alert alert-danger"><strong>※</strong>絞り込まない場合何もチェックしないでください。</div>
    <?php for($i=15;$i <= 60; $i=$i+5) $age_range[$i] = $i . "歳" . "～". ($i + 5) ."歳"; ?>
      <?php foreach($age_range as $i => $range) { ?>
    　　　　<div class="checkbox checkbox-success checkbox-inline">
        <input type="checkbox" class="styled" id="age_<?php echo $i ?>" value="<?php echo $i ?>" name = "age_range[]">
        <label for="age_<?php echo $i ?>"> <?php echo $range ?> </label>
      </div>
      <?php } ?>
    </td>
    </tr>
    
    <tr>
    <th>性別</th>
    <td class="align_l">
       <div class="radio radio-danger radio-inline">
         <input type="radio" id="gender1" value="all" name="gender" checked>
         <label for="gender1"> 未指定 </label>
      </div>
      <div class="radio radio-info radio-inline">
         <input type="radio" id="gender2" value="男" name="gender">
         <label for="gender2"> 男 </label>
      </div>
      <div class="radio radio-info radio-inline">
         <input type="radio" id="gender3" value="女" name="gender">
         <label for="gender3"> 女 </label>
      </div>    
    </td>
    </tr>
    
    
    <tr><th>確認用アドレス</th><td class="align_l"><input style="width:700px" name="mailToTest" type="text" value="<?php if(!empty($this->request->data['mailToTest'])) echo htmlspecialchars($this->request->data['mailToTest']); ?>"/>  </td></tr>
    <tr><th>送信元アドレス</th><td class="align_l"><input style="width:700px" name="mailFrom" type="text"  value="<?php !empty($this->request->data['mailFrom']) ? print_r($this->request->data['mailFrom']) : print_r("info@medical-jobs.co.jp") ?>" />  </td></tr>
    <tr><th>送信者名</th><td class="align_l"><input style="width:700px" name="mailSender" type="text"  value="<?php !empty($this->request->data['mailSender']) ? print_r($this->request->data['mailSender']) : print_r("メディカルジョブズ") ?>" />  </td></tr>
    <tr><th>件　名</th><td class="align_l"><input style="width:700px" name="mailTitle" type="text" value="<?php if(!empty($this->request->data['mailTitle'])) echo htmlspecialchars($this->request->data['mailTitle']); ?>"/><span class="error" id="mail-title"></span></td></tr>
    <tr style="vertical-align:top"><th>本　文</th><td class="align_l"><textarea style="width:700px;height:330px" name="mailBody" ><?php if(!empty($this->request->data['mailBody'])) echo htmlspecialchars($this->request->data['mailBody']); ?></textarea><span class="error" id="mail-body"></span></td></tr>
  </table>

  <center>
  <div class="submit">
    <input type="submit" name="send" value="メルマガを送信する" class="btn" />
  </div>
  </center>

  </div>
</form>



<script type="text/javascript">
  $(document).ready(function() {
    $('#mailForm').submit(function(e){
      
      var title = $('input[name=mailTitle]').val();
      var body = $('textarea[name=mailBody]').val();
      if(title == ''){        
        $('#mail-title').text('件名を入力してください')
        $('#mail-title').show();
      }else{
        $('#mail-title').hide();
      }
      if(body == ''){
        $('#mail-body').text('本文を入力してください')
        $('#mail-body').show();
      }else{
        $('#mail-body').hide();
      }
      
      if(title!= '' && body != ''){
        if(confirm('送信種別に間違いはありませんか?')){
          return true;
        }
      }
      
      e.preventDefault();
    });
  });
  
</script>