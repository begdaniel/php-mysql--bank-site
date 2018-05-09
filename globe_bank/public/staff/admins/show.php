<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>


<?php
$id = $_GET['id'] ?? '1';
// $id = isset($_GET['id']) ? $_GET['id'] : '1';

$admin = find_admin_by_id($id);
//$subject = find_subject_by_id($admin['subject_id']);

?>

<?php $page_title=h("Show admin") ; ?>

<?php include SHARED_PATH . '/staff_header.php' ?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to list </a>



	<div class = "admin show">

		<h1> Admin: <?php echo h($admin['username']) ; ?></h1>

	<div class = "attributes">
		<dl>
			<dt>First name:</dt>
			<dd><?php echo h($admin['first_name']); ?></dd>
		</dl>
		<dl>
			<dt>Last name:</dt>
			<dd><?php echo h($admin['last_name']); ?></dd>
		</dl>
		<dl>
			<dt>Email:</dt>
			<dd><?php echo h($admin['email']); ?></dd>
		</dl>
		<dl>
			<dt>Username:</dt>
			<dd><?php echo $admin['username']; ?></dd>
		</dl>

	</div>

</div>

<?php include SHARED_PATH . '/staff_header.php' ?>
