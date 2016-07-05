<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>
        <?php echo $this->Form->hidden("Grade.{$key}.id") ?>
        <?php echo $this->Form->text("Grade.{$key}.subject"); ?>
    </td>   
    <td>
        <?php echo $this->Form->select("Grade.{$key}.grade", array(
            'A+',
            'A',
            'B+',
            'B',
            'C+',
            'C',
            'D',
            'E',
            'F'
        ), array(
            'empty' => '-- Select grade --'
        )); ?>
    </td>
    <td class="actions">
        <a href="#" class="remove">Remove grade</a>
    </td>
</tr>