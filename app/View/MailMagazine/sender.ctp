

<?php echo $this->html->link('メールマガジン配信へ', '/mail_magazine/')?>
<?php if(!empty($applicants)){ ?>
<table>
  <tr>
    <th>No.</th>
    <th>名前</th>
    <th>メールアドレス</th>
  </tr>
  <?php foreach($applicants as $no => $val){?>
     <tr>
       <td><?php echo $no ?></td>
       <?php foreach($val as $name => $email){?>
         <td><?php echo $name ?></td>
         <td><?php echo $email ?></td>
       <?php } ?>
     </tr>
  <?php } ?>
</table>
<?php } ?>


