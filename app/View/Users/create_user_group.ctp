<div class="create">
	<form action="<?php echo ABSOLUTE_URL;?>/users/createUserGroup" method="POST">
		<div class="row">
			<input type="text" name="name" placeholder="Group Name" required="">
		</div>
		<div class="row">
			<select name="privilege_ids[]" multiple placeholder="User Group" required="">
				<option value="">Select Privileges</option>
				<?php foreach ($privilegeList as $key => $value) { ?>
					<option value="<?php echo $key;?>"><?php echo $value;?></option>
				<?php }?>
			</select>
		</div> 
		<div class="row">
			<button type="submit">Submit</button>
		</div>
	</form>
</div>