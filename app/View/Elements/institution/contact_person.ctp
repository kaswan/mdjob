<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>
    	<?php echo $this->Form->hidden("ContactPerson.{$key}.id") ?>
        <?php echo $this->Form->text("ContactPerson.{$key}.department", array('size' => '10px', 'class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo $this->Form->text("ContactPerson.{$key}.name", array('size' => '10px', 'class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo $this->Form->text("ContactPerson.{$key}.title", array('size' => '15px', 'class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo $this->Form->text("ContactPerson.{$key}.direct_phone_number", array('size' => '15px', 'class' => 'form-control js-characters-change')); ?>
    </td>
    
    <td>
        <?php echo $this->Form->text("ContactPerson.{$key}.email", array('size' => '15px', 'class' => 'form-control')); ?>
    </td>
    
    <td >
        <a href="#" class="remove btn btn-danger btn-xs" >削除</a>
    </td>
</tr>