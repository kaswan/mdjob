<div class="row">
	<div class="col-xs-1">
	  <?php echo $this->html->link('求職者一覧へ', array('controller' => 'applicants', 'action' => 'index'), array('class' => 'btn btn-success ')); ?><br><br>
	  <?php echo $this->html->link('施設一覧へ', array('controller' => 'institutions', 'action' => 'index'), array('class' => 'btn btn-success ')); ?><br><br>
	  <?php if(AuthComponent::user('role') == 'admin') echo $this->html->link('新規ユーザ登録', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-danger ')); ?>
	</div>  
	<div class="col-xs-10">
		<div class="users form">
			<table>
  				<thead>
    				<tr>
    					<th>社員番号</th>
    				    <th>名前</th>
       					<th>ユーザID</th>
       					<th>メールアドレス</th>
       					<th></th>
       					<th></th>
    				</tr>
  				</thead>
  				<body>
					<?php foreach($users as $val){ ?>
				    <tr>
				    	<td><?php echo $val['User']['employee_number']?></td>
				    	<td><?php echo $val['User']['name']?></td>
        				<td><?php echo $val['User']['username']?></td>
        				<td><?php echo $val['User']['email']?></td>
        				<td><?php if(AuthComponent::user('role') == 'admin' || AuthComponent::user('id') == $val['User']['id']) echo $this->html->link('編集', array('controller' => 'users', 'action' => 'edit', $val['User']['id']), array('class' => 'btn btn-success btn-sm', 'role' => "button"))?></td>
        				<td><?php if(AuthComponent::user('role') == 'admin' && AuthComponent::user('id') != $val['User']['id']) echo $this->html->link('削除', array('controller' => 'users', 'action' => 'delete', $val['User']['id']), array('class' => 'btn btn-danger btn-sm', 'confirm' =>'削除してもよろしいですか？')) ?></td>
     				</tr>
   					<?php }?>
  				</body>
			</table>
		</div>
	</div>
</div>		