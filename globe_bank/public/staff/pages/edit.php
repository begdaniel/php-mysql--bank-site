<?php require_once('../../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php
	if(!isset($_GET['id'])){
		redirect_to(url_for('/staff/pages/index.php'));
	}

	$id = $_GET['id'];

?>

<?php $page_title="Edit page" ; ?>

<?php
 if(is_post_request()){
	 $page=[];
	 $page['id'] = $id;
	 $page['menu_name']=$_POST['menu_name'] ?? "";
	 $page['subject_id']=$_POST['subject_id'] ?? "";
	 $page['position']=$_POST['position'] ?? "";
	 $page['visible']=$_POST['visible'] ?? "";
	 $page['content']=$_POST['content'] ?? "";

	 $start_pos = $_POST['start_pos'];


	 $result = update_page($page);
	 if($result === true) {
		 shift_page_positions($start_pos, $page['position'], $page['subject_id'], $page['id']);
		 $_SESSION['message'] = "Page succesfully updated.";
	 	redirect_to(url_for('/staff/pages/show.php?id=' . h(u($id))));

 } else {
	 $errors = $result;
 }
}

 $page = find_page_by_id($id);

 $page_count = count_pages_by_subject_id($page['subject_id']) ;


?>

<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to subject </a>
	<h1> Edit page </h1>

	<?php echo display_errors($errors); ?>

	<form action="<?php echo url_for('/staff/pages/edit.php?id='.h(u($id)));?>" method="post">
		<dl>
			<dt> Page Name </dt>
			<dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Subject </dt>
			<dd>
				<select name="subject_id">
					<?php
						$subject_set = find_all_subjects();
						while($subject = mysqli_fetch_assoc($subject_set)) {?>
						<option value="<?php echo $subject['id'];?>"  <?php if($page['subject_id'] == $subject['id']){echo " selected ";}
						else {echo " hidden ";}?>>
						<?php echo h($subject['menu_name']);?>
						</option>
					<?php } mysqli_free_result($subject_set);?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt> Position </dt>
			<dd>
				<select name="start_pos" hidden>
					<option value="<?php echo h($page['position']) ;?>" selected> <?php echo h($page['position']) ;?></option>
				</select>
			</dd>
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
			<input type="submit" value="Edit Page"/>
		</div>
	</form>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
