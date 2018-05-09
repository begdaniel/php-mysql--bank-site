<?php require_once('../../../private/initialize.php');

require_login();


?>

<?php $page_title="New page" ; ?>

<?php

	$page=[];
	$page['menu_name']=$_POST['menu_name'] ?? "";
	$page['subject_id']=$_POST['subject_id'] ?? "";
	$page['position']=$_POST['position'] ?? "";
	$page['visible']=$_POST['visible'] ?? "";
	$page['content']=$_POST['content'] ?? "";

if(is_post_request()){
	$result = insert_page($page);
	if($result === true) {
	$new_id = mysqli_insert_id($db);
	shift_page_positions(0, $page['position'], $page['subject_id'], $new_id);
	$_SESSION['message'] = "Page succesfully created.";
	redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
} else {
	$errors = $result;
}
} else {
	$page=[];
	$page['menu_name']= "";
	$page['subject_id']=$_GET['subject_id'] ?? "1";
	$page['position']="";
	$page['visible']= "";
	$page['content']= "";
}

$page_count = count_pages_by_subject_id($page['subject_id']) +1 ;


include(SHARED_PATH . '/staff_header.php');?>


<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to subject </a>
	<h1> New page </h1>

	<?php echo display_errors($errors); ?>

	<form action="<?php echo url_for('/staff/pages/new.php');?>" method="post">
		<dl>
			<dt> Page Name </dt>
			<dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Subject </dt>
			<dd>
				<select name="subject_id">
					<option value="" selected hidden disabled> Please select </option>
					<?php
						$subject_set = find_all_subjects();
					 	while($subject = mysqli_fetch_assoc($subject_set)) {?>
						<option value="<?php echo $subject['id'];?>"  <?php if($page['subject_id'] == $subject['id']){echo " selected";}?>>
						<?php echo h($subject['menu_name']);?>
						</option>
					<?php } mysqli_free_result($subject_set);?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt> Position </dt>
			<dd>
				<select name="position">
					<option value="" selected disabled hidden> Please select </option>
					<?php for ($i=1; $i <= $page_count; $i++) {
						echo "<option value='{$i}' ";
						if($i == $page['position']){echo "selected";}
						echo "> {$i} </option>";
					} ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt> Visible </dt>
			<dd>
				<input type="hidden" name="visible" value="0"/>
				<input type="checkbox" name="visible" value="1" <?php if($page['visible']=="1"){echo "Checked";}?>/>
			</dd>
		</dl>
		<dl>
			<dt> Content </dt>
			<dd><textarea name="content"  rows="4" cols="50"><?php echo h($page['content']) ;?></textarea></dd>
		</dl>
		<div id="operations">
			<input type="submit" value="New Page"/>
		</div>
	</form>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
