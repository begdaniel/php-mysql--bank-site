<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$pages_set = find_all_pages();

?>

<?php $page_title = h('Pages'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div content>
	<div class ="pages listing">
		<h1> Pages </h1>

		<div class = "actions">
			<a class="action" href="<?php echo url_for('/staff/pages/new.php');?>"> Create new page </a>

			<table class = "list">
                <tr>
                    <th>ID</th>
										<th>Subject ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
				<?php while($page = mysqli_fetch_assoc($pages_set)) { ?>
					<tr>
						<td> <?php echo h($page['id']); ?> </td>
						<td>
							<?php
								$subject = find_subject_by_id($page['subject_id']);
								echo h($subject['menu_name']);
							 ?>
						</td>
						<td> <?php echo h($page['position']); ?> </td>
						<td> <?php echo $page['visible'] == 1 ? 'true' : 'false'; ?> </td>
						<td> <?php echo h($page['menu_name']); ?> </td>
						<td> <a class="action" href="<?php echo url_for('/staff/pages/show.php?id=') . h(u($page['id'])); ?>"> View </a> </td>
						<td> <a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=') . h(u($page['id'])); ?>"> Edit </a> </td>
						<td> <a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=') . h(u($page['id'])); ?>"> Delete </a></td>

					</tr>
				<?php } ?>

			<?php mysqli_free_result($pages_set); ?>

		</div>
	</div>
</div>




<?php include(SHARED_PATH . '/staff_footer.php'); ?>
