<div class="list">
	<label for="">
		<h3><?php echo $title;?></h3>
	</label>
	<table class="table">
		<div class="head">
			<td>User Name</td>
			<td>UserGroup</td>
			<td>Address</td>
			<td>Created On</td>
		</div>
		<?php foreach ($reporters as $key => $value) { ?>
			<tr class="row">
				<td><?php echo $value['name'];?></td>
				<td><?php echo $value['groups'];?></td>
				<td><?php echo $value['address'];?></td>
				<td><?php echo $value['created'];?></td>
			</tr>
		<?php }?>
	</table>
</div>