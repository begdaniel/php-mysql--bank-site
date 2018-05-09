<?php require_once('../../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php

$admins_set = find_all_admins();

?>

<?php $page_title = h('Admins'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div content>
	<div class ="pages listing">
		<h1> Pages </h1>

		<div class = "actions">
			<a class="action" href="<?php echo url_for('/staff/admins/new.php');?>"> Create new admin </a>

			<table class = "list">
                <tr>
                    <th>ID</th>
										<th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Username</th>
										<th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
				<?php while($admin = mysqli_fetch_assoc($admins_set)) { ?>
					<tr>
						<td> <?php echo h($admin['id']); ?> </td>
						<td> <?php echo h($admin['first_name']); ?> </td>
						<td> <?php echo h($admin['last_name']); ?> </td>
						<td> <?php echo $admin['email']; ?> </td>
						<td> <?php echo h($admin['username']); ?> </td>
						<td> <a class="action" href="<?php echo url_for('/staff/admins/show.php?id=') . h(u($admin['id'])); ?>"> View </a> </td>
						<td> <a class="action" href="<?php echo url_for('/staff/admins/edit.php?id=') . h(u($admin['id'])); ?>"> Edit </a> </td>
						<td> <a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=') . h(u($admin['id'])); ?>"> Delete </a></td>

					</tr>
				<?php } ?>

			<?php mysqli_free_result($admins_set); ?>

		</div>
	</div>
</div>




<?php include(SHARED_PATH . '/staff_footer.php'); ?>
