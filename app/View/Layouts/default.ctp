<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Access Control Managment System
		
	</title>
	<?php echo $this->Html->css('style'); ?>
</head>
<body>
	<div id="container">
		<div id="content">
			<div class="side-nav">
				<?php if($this->Session->read('User.id')){ ?>
				<ul>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/reportingUsers" >
						Reporting Users
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/listToReportUsers" >
						Users To Report
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/listUserGroup" >
						User Groups
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/listPrivileges" >
						Privileges
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/createUserGroup" >
						Create User Group
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/createPrivileges" >
						Create new Privileges
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/createUsers" >
						Create New User
					</a></li>
					<li><a href="<?php echo ABSOLUTE_URL;?>/users/logout" >
						Logout
					</a></li>
				</ul>
			<?php } ?>
			</div>
			<div>
				<div class="flash">
					 <?php echo $this->Session->flash(); ?>
				</div>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
