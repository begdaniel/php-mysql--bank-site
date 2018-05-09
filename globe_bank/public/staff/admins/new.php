<?php require_once('../../../private/initialize.php');?>

<?php require_login(); ?>

<?php $admin_title="New admin" ; ?>

<?php

	$admin=[];
	$admin['first_name']=$_POST['first_name'] ?? "";
	$admin['last_name']=$_POST['last_name'] ?? "";
	$admin['email']=$_POST['email'] ?? "";
	$admin['username']=$_POST['username'] ?? "";
	$admin['password']=$_POST['password'] ?? "";
	$admin['confirm_password']=$_POST['confirm_password'] ?? "";

if(is_post_request()){
	$result = insert_admin($admin);
	if($result === true) {
	$_SESSION['message'] = "Admin succesfully created.";
	$new_id = mysqli_insert_id($db);
	redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
} else {
	$errors = $result;
}
}

include(SHARED_PATH . '/staff_header.php');?>


<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/admins/index.php');?>"> &laquo;  Back to list </a>
	<h1> New admin </h1>

	<?php echo display_errors($errors); ?>

	<form action="<?php echo url_for('/staff/admins/new.php');?>" method="post">
		<dl>
			<dt> First Name </dt>
			<dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Last Name </dt>
			<dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Email </dt>
			<dd><input type="text" name="email" value="<?php echo h($admin['email']) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Username </dt>
			<dd><input type="text" name="username" value="<?php echo h($admin['username']) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Password </dt>
			<dd><input type="password" name="password" /></dd>
		</dl>
		<dl>
			<dt> Confirm Password </dt>
			<dd><input type="password" name="confirm_password" /></dd>
		</dl>
		<p>
			Password should be at least 12 characters long and include at least 1 uppercase letter, lowercase letter, number, and symbol.
		</p>
		<br />
		<div id="operations">
			<input type="submit" value="New admin"/>
		</div>
	</form>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
