<?php echo $this->Html->css('font-awesome');?>
<?php echo $this->Html->css('build');?>
<form action="sender" method="POST">

  <div class="wrapper" >

  <div class="alert alert-warning">
    ※最初に内容確認をする場合は【確認用アドレス】にアドレスを入力し、送信ボタンを押してください。<br/>
    ・「送信する。」をチェックすると該当の本番メールリストに送信します。それ以外は確認用のテストメールのみ送信します。<br/>
    ・「メルマガ希望会員」を選択すると、都道府県・学年・性別の条件に応じてメルマガ希望会員にのみ送信します。<br/>
    ・「教職員向けメルマガ希望会員」を選択すると、都道府県・学年・性別の条件に応じて教職員向けメルマガ希望会員にのみ送信します。<br/>
    ・「全会員」を選択すると、都道府県・学年・性別の条件は無視し進路ナビ全会員に送信します。<br/>
    <!-- ・「幽霊会員」を選択すると進路ナビ全会員に送信します。<br/>-->
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
    
    
    <tr><th>確認用アドレス</th><td class="align_l"><input style="width:700px" name="mailToTest"    type="text" value="<?php # echo htmlspecialchars($_REQUEST['mailToTest']); ?>"/>  </td></tr>
    <tr><th>送信元アドレス</th><td class="align_l"><input style="width:700px" name="mailFrom"  type="text"  value="<?php #($_REQUEST['mailFrom']) ? print_r($_REQUEST['mailFrom']) : print_r("info@shinronavi.com") ?>" />  </td></tr>
    <tr><th>送信者名</th><td class="align_l"><input style="width:700px" name="mailSender"  type="text"  value="<?php #($_REQUEST['mailSender']) ? print_r($_REQUEST['mailSender']) : print_r("進路ナビ編集部") ?>" />  </td></tr>
    <tr><th>件　名</th><td class="align_l"><input style="width:700px" name="mailTitle"  type="text" value="<?php #echo htmlspecialchars($_REQUEST['mailTitle']); ?>"/></td></tr>
    <tr style="vertical-align:top"><th>本　文</th><td class="align_l"><textarea  style="width:700px;height:330px" name="mailBody" ><?php #echo htmlspecialchars($_REQUEST['mailBody']); ?></textarea></td></tr>
  </table>

  <center>
  <p>
    <?php echo '<input type="submit" name="send" value="送信" onclick=\'return confirm("送信種別に間違いはありませんか?")\'\; />';?>
  </p>
  </center>

  </div>

  </form>