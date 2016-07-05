<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>
        <?php echo $this->Form->hidden("WorkHistory.{$key}.id") ?>
        <?php echo $this->Form->text("WorkHistory.{$key}.company_name", array('size' => '15px', 'class' => 'form-control')); ?>
    </td>  
    <td>
        <?php echo $this->Form->text("WorkHistory.{$key}.short_name", array('size' => '10px', 'class' => 'form-control', 'placeholder' => 'エントリシート用')); ?>
    </td> 
    <td>
        <?php echo $this->Form->text("WorkHistory.{$key}.department_name", array('size' => '15px', 'class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo $this->Form->text("WorkHistory.{$key}.discipline", array('size' => '15px', 'class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo $this->Form->text("WorkHistory.{$key}.employment_pattern", array('size' => '15px', 'class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo $this->Form->text("WorkHistory.{$key}.enrollment_year", array('size' => '10px', 'class' => 'form-control')); ?>
    </td>
    <td >
        <a href="#" class="remove btn btn-danger btn-xs" >削除</a>
    </td>
</tr>