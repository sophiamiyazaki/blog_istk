<?php
	require_once('../includes/header.php');
	$stmt = $db->prepare('SELECT entryID, entryTitle, entryContent FROM blog_posts WHERE entryID = :entryID') ;
	$stmt->execute(array(':entryID' => $_GET['editid']));
	$row = $stmt->fetch();
?>

<?php

try {
	if(isset($_POST['submit'])){
		$stmt = $db->prepare('UPDATE blog_posts SET entryTitle = :entryTitle, entryContent = :entryContent WHERE entryID = :entryID');
                $stmt->execute(array(
                    ':entryTitle' => $_POST['entryTitle'],
                    ':entryContent' => $_POST['entryContent'],
                    ':entryID' => $_POST['entryID']
                ));

                //redirect to index page
                header('Location: index.php?action=updated');
                exit;
	}
} catch(PDOException $e) {
	echo $e->getMessage();
}
?>

<div class="entry-list rc admin">
	<h2>Update Your Listing</h2>
	
	<form action='' method='post'>
		<input type='hidden' name='entryID' value='<?= $row['entryID'];?>'>
		<div class="form-row">
			<label>Title</label>
			<input type='text' name='entryTitle' value='<?= $row['entryTitle'];?>'>
		</div>
		<div class="form-row">
			<label>Content</label>
			<textarea name='entryContent' cols='60' rows='10'><?= $row['entryContent'];?></textarea>
		</div>
		<div class="form-row">
			<label></label>
			<input type='submit' name='submit' value='Submit' />
		</div>
	</form>

</div>