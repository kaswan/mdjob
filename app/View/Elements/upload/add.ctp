<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>   
        <?php echo $this->Form->input("UploadDocument.{$key}.remark", array('size' => '15px', 'class' => 'form-control', 'label' => false, 'placeholder' => 'メモを入力')); ?>                
    </td>
    <td>   
        <?php echo $this->Form->input("UploadDocument.{$key}.document", array('type' => 'file', 'label' => false, 'class' => 'form-control')); ?>                
    </td>
    <td>
        <?php echo $this->Form->hidden("UploadDocument.{$key}.id") ?>
        <?php echo $this->Form->hidden("UploadDocument.{$key}.type", array('value' => $type)); ?>
        <a href="#" class="remove btn btn-danger btn-xs" >削除</a>
    </td>
</tr>