<div class="list">
	<label for="">
		<h3><?php echo $title;?></h3>
	</label>
	<table class="table">
		<div class="head">
			<td>#</td>
			<td>UserGroup</td>
			<td>Created On</td>
		</div>
		<?php foreach ($list as $key => $value) { ?>
			<tr class="row">
				<td><?php echo $key+1;?></td>
				<td><?php echo $value['UserGroup']['name'];?></td>
				<td><?php echo $value['UserGroup']['created'];?></td>
			</tr>
		<?php }?>
	</table>
</div>