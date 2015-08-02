<?php
	require_once('../includes/header.php');
?>

<?php

try {
	if(isset($_POST['submit'])){
		$stmt = $db->prepare('INSERT INTO blog_posts (entryTitle, entryContent, entryDate, entryAuthor) VALUES (:entryTitle, :entryContent, :entryDate, :entryAuthor)');
                $stmt->execute(array(
                    ':entryTitle' => $_POST['entryTitle'],
                    ':entryContent' => $_POST['entryContent'],
                    ':entryDate' => date('Y-m-d H:i:s'),
                    ':entryAuthor' => $_POST['entryAuthor']
                ));

                //redirect to index page
                header('Location: index.php?action=added');
                exit;
	}
} catch(PDOException $e) {
	echo $e->getMessage();
}
?>

<div class="entry-list rc admin">
	<h2>--- Add a New Listing ---</h2>
	
	<form action='' method='post'>
		<div class="form-row">
			<label>Title</label>
			<input type='text' name='entryTitle' value=''>
		</div>
		<div class="form-row">
			<label>Content</label>
			<textarea name='entryContent' cols='60' rows='10'></textarea>
		</div>
		<div class="form-row">
			<label>Author</label>
			<input type='text' name='entryAuthor' value='' />
		</div>
		<div class="form-row">
			<label></label>
			<input type='submit' name='submit' value='Submit' />
		</div>
	</form>

</div>