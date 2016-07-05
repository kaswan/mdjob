<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>   
        <?php echo $this->Form->input("UploadDocument.{$key}.remark", array('size' => '15px', 'class' => 'form-control', 'label' => false)); ?>                
    </td>
    <td> 
    	<?php echo  $data['document'];?>  
    </td>
    <td>
        <?php echo $this->Form->hidden("UploadDocument.{$key}.id") ?>
        <?php echo $this->Form->hidden("UploadDocument.{$key}.type", array('value' => $type)); ?>
        <a href="#" class="remove btn btn-danger btn-xs" >削除</a>
    </td>
</tr>