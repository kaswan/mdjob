<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>
        <div class="col-xs-6"><?php echo $this->Form->select("QualificationHistory.{$key}.name", $qualifications, array('empty' => '-- 選択してください --', 'class' => "form-control")); ?></div>
        <div class="col-xs-6"><?php echo $this->Form->input("QualificationHistory.{$key}.other_name", array('label' => false, 'div' => false, 'class' => "form-control", 'placeholder' => 'その他の資格がある場合記入'))?></div>
    </td>
    <td>   
        <?php echo $this->Form->year("QualificationHistory.{$key}", 1950, date('Y') + 15); ?><b>年</b>
        <?php echo $this->Form->month("QualificationHistory.{$key}", array('monthNames' => false)); ?><b>月</b>        
    </td>
    
    <td>
        <?php echo $this->Form->hidden("QualificationHistory.{$key}.id") ?>
        <a href="#" class="remove btn btn-danger btn-xs" >削除</a>
    </td>
</tr>
