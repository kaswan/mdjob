<?php
$key = isset($key) ? $key : '<%= key %>';
?>
<tr>
    <td>
        <?php echo $this->Form->select("QualificationHistory.{$key}.name", array(
            '正看護師' => '正看護師',
            '准看護師' => '准看護師',
            '保健師' => '保健師',
            '助産師' => '助産師',
        	'認定系' => '認定系',
        	'理学療法士' => '理学療法士',
        	'作業療法士' => '作業療法士',
        	'言語聴覚士' => '言語聴覚士',
        	'介護職員初任者研修' => '介護職員初任者研修',
        	'介護職員基礎研修' => '介護職員基礎研修',
        	'介護職員実務者研修' => '介護職員実務者研修',
        	'介護福祉士' => '介護福祉士',
        	'介護支援専門員' => '介護支援専門員',
        	'社会福祉士' => '社会福祉士',
        	'社会福祉主事' => '社会福祉主事',
        	'ヘルパー2級' => 'ヘルパー2級',
        	'ヘルパー1級' => 'ヘルパー1級',
        	'臨床検査技師' => '臨床検査技師',
        	'臨床工学技士' => '臨床工学技士',
        	'診療放射線技師' => '診療放射線技師',
            'その他' => 'その他'
        ), array(
            'empty' => '-- Select --'
        )); ?>
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