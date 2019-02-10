<div class="list">
	<label for="">
		<h3><?php echo $title;?></h3>
	</label>
	<table class="table">
		<div class="head">
			<td>#</td>
			<td>Privilege</td>
			<td>Created On</td>
		</div>
		<?php foreach ($list as $key => $value) { ?>
			<tr class="row">
				<td><?php echo $key+1;?></td>
				<td><?php echo $value['Privilege']['name'];?></td>
				<td><?php echo $value['Privilege']['created'];?></td>
			</tr>
		<?php }?>
	</table>
</div>