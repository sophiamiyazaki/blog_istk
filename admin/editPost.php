<?php
	require_once('../includes/header.php');
	$stmt = $db->prepare('SELECT entryID, entryTitle, entryContent FROM blog_posts WHERE entryID = :entryID') ;
	$stmt->execute(array(':entryID' => $_GET['editid']));
	$row = $stmt->fetch();
?>

<?php

	if(isset($_POST['submit'])){
	
		// easy validation
		if($_POST['entryTitle'] ==''){
		    $error[] = 'Please enter a title.';
		}
		
		if($_POST['entryContent'] ==''){
		    $error[] = 'Please enter some interesting content.';
		}
		
		if (!isset($error)) {
		
			try {
				$stmt = $db->prepare('UPDATE blog_posts SET entryTitle = :entryTitle, entryContent = :entryContent WHERE entryID = :entryID');
		                $stmt->execute(array(
		                    ':entryTitle' => $_POST['entryTitle'],
		                    ':entryContent' => $_POST['entryContent'],
		                    ':entryID' => $_POST['entryID']
		                ));
		
		                //redirect to index page
		                header('Location: index.php?action=updated&isAdmin=true');
		                exit;
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		
		if(isset($error)){
			echo '<div class="alert alert-warning" role="alert">';
		        foreach($error as $error){
		            echo $error . '<br/>';
		        }
		        echo '</div>';
	    	}
	}
			
?>

<div class="entry-list rc">
	<h2>Update Your Listing</h2>
	
	<form action='' method='post'>
		<input type='hidden' name='entryID' value='<?= $row['entryID'];?>'>
		<div class='form-group'>
			<label>Title</label>
			<input type='text' class='form-control' name='entryTitle' value='<?= $row['entryTitle'];?>'>
		</div>
		<div class='form-group'>
			<label>Content</label>
			<textarea name='entryContent' class='form-control' cols='60' rows='10'><?= $row['entryContent'];?></textarea>
		</div>
		<div class='form-group'>
			<label></label>
			<input type='submit' name='submit' value='Submit' />
		</div>
	</form>

</div>