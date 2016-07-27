<?php if(!empty($data)){?>
  <div class="wrapper" >
  
  <table class="main">
    <tr>
    <th>送信種別</th>
    <td class="align_l">
         <?php echo ($data['mail_magazine_subscription'] == 1) ?  'メルマガ希望会員' : '全会員' ?>
    </td>
    </tr>
    <tr>
      <th>居住都道府県</th>
      <td class="align_l" width="80%">      
      <?php if(isset($data['prefectures'])) foreach($data['prefectures'] as $id) {?>
        <kbd><?php echo $prefecure_lists[$id] ?></kbd>        
      <?php }?>
      </td>
    </tr>
    
    
    <tr>
      <th>資格</th>
      <td><?php if(isset($data['qualification'])) echo $data['qualification']; ?></td>
    </tr>
  
    <tr>
      <th>雇用形態</th>
      <td><?php if(isset($data['employment_pattern'])) echo $data['employment_pattern']; ?></td>
    </tr>
      
    <tr>
    <th>年齢</th>
    <td class="align_l">
      <?php if(isset($data['age_range'])) foreach($data['age_range'] as $age) { ?>        
        <kbd><?php echo $age . "歳" . "～". ($age + 5) ."歳"; ?> </kbd>&nbsp;
      <?php } ?>
    </td>
    </tr>
    
    <tr>
      <th>性別</th>
      <td><?php echo ($data['gender'] == 'all') ? '未指定 ' : $data['gender'] ?></td>
    </tr>    
    
    <tr><th>確認用アドレス</th><td class="align_l"><?php if(!empty($data['mailToTest'])) echo htmlspecialchars($data['mailToTest']); ?> </td></tr>
    <tr><th>送信元アドレス</th><td class="align_l"><?php !empty($data['mailFrom']) ? print_r($data['mailFrom']) : '' ?> </td></tr>
    <tr><th>送信者名</th><td class="align_l"><?php !empty($data['mailSender']) ? print_r($data['mailSender']) : '' ?> </td></tr>
    <tr><th>件　名</th><td class="align_l"><?php if(!empty($data['mailTitle'])) echo htmlspecialchars($data['mailTitle']); ?></td></tr>
    <tr style="vertical-align:top"><th>本　文</th><td class="align_l"><?php if(!empty($this->request->data['mailBody'])) echo nl2br(htmlspecialchars($data['mailBody'])); ?></td></tr>
  </table>

  <form action="/mail_magazine/sender" method="POST" id="mailForm">
    <center>
    <div class="submit">
      <?php foreach($data as $key => $value) { ?>
        <?php if(in_array($key, array('send', 'confirm'))) continue; ?>
        <?php if($key == 'prefectures' || $key == 'age_range') { ?>
          <?php foreach($value as $i => $val){ ?>
            <input type='hidden' name='<?php echo $key ?>[]' value='<?php echo $val?>'>
          <?php } ?>  
        <?php }else { ?>
          <input type='hidden' name='<?php echo $key ?>' value='<?php echo $value ?>'>
        <?php } ?>  
      <?php }?>
      <input type="submit" name="back" id="back"  value="&lt;&lt;入力画面に戻る" class="btn" data-action="/mail_magazine/"/>
      <input type="submit" name="send" id="send"  value="メルマガを送信する &gt;&gt;" class="btn " data-action="/mail_magazine/sender"/>
    </div>
    </center>
  </form>
  </div>

<?php } ?>

<script>
  $('.btn').click(function() {
    if($(this).attr('id') == 'send'){
      if(confirm('送信種別に間違いはありませんか?')){
         $(this).parents('form').attr('action', $(this).data('action'));
      }else{
        return false;
      }
    }
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
  });
</script>