<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>
        <?php echo $this->Form->select("QualificationHistory.{$key}.name", $qualifications, array('empty' => '-- 選択してください --')); ?>
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
