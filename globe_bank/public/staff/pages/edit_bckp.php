<?php require_once('../../../private/initialize.php'); ?>

<?php 
	if(!isset($_GET['id'])){
		redirect_to(url_for('/staff/pages/index.php'));
	}
?>
<?php $page_title="Edit page" ; ?>

<?php 
	$id=$_GET['id'];
	$page_name="";
	$position="";
	$visible="";
?>

<?php if(is_post_request()){
	$page_name=$_POST['page_name'] ?? "";
	$position=$_POST['position'] ?? "";
	$visible=$_POST['visible'] ?? "";

	echo "New parameters: <br/>";
	echo "Page name: " . $page_name . "<br/>";
	echo "Position: " . $position . "<br/>";
	echo "Visible: " . $visible . "<br/>";
}
?>


<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/pages/index.php');?>"> &laquo;  Back to list </a>
	<h1> New page </h1>

	<form action="<?php echo url_for('/staff/pages/edit.php?id='.h(u($id)));?>" method="post"> 
		<dl>
			<dt> Page Name </dt>
			<dd><input type="text" name="page_name" value="<?php echo h($page_name) ;?>"/></dd>
		</dl>
		<dl>
			<dt> Position </dt>
			<dd> 
				<select name="position">
					<option value="" selected disabled hidden> Please select </option>
					<option value="1" <?php if($position=="1"){echo "selected";}?>> 1 </option>
					<option value="2" <?php if($position=="2"){echo "selected";}?>> 2 </option>
					<option value="3" <?php if($position=="3"){echo "selected";}?>> 3 </option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt> Visible </dt>
			<dd>
				<input type="hidden" name="visible" value="0"/>
				<input type="checkbox" name="visible" value="1" <?php if($visible=="1"){echo "Checked";}?>/>
			</dd>
		</dl>
		<div id="operations">
			<input type="submit" value="Edit Page"/>
		</div>
	</form>
</div>


<?php include(SHARED_PATH . '/staff_footer.php') ?>

