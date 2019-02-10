<div class="create">
	<form action="<?php echo ABSOLUTE_URL;?>/users/createUsers" method="POST">
		<div class="row">
			<input type="text" name="name" placeholder="User Name" required="">
		</div>
		<div class="row">
			<input type="text" name="password" placeholder="Password" required="">
		</div>
		<div class="row">
			<input type="text" name="address" placeholder="Address" >
		</div>
		<div class="row">
			<label for="">Select Reporting Managers</label>
			<select name="reporting_manager_ids[]" multiple placeholder="Reporting Managers" required="">
				<?php foreach ($usersList as $key => $value) { ?>
					<option value="<?php echo $key;?>"><?php echo $value;?></option>
				<?php }?>
			</select>
		</div>
		<div class="row">
			<label for="">Select User Group</label>
			<select name="user_group_id[]" multiple placeholder="User Group" required="">
				<?php foreach ($groupList as $key => $value) { ?>
					<option value="<?php echo $key;?>"><?php echo $value;?></option>
				<?php }?>
			</select>
		</div> 
		<div class="row">
			<button type="submit">Submit</button>
		</div>
	</form>
</div>
