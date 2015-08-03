<?php
	require_once('../includes/header.php');
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
				$stmt = $db->prepare('INSERT INTO blog_posts (entryTitle, entryContent, entryDate, entryAuthor) VALUES (:entryTitle, :entryContent, :entryDate, :entryAuthor)');
		                $stmt->execute(array(
		                    ':entryTitle' => $_POST['entryTitle'],
		                    ':entryContent' => $_POST['entryContent'],
		                    ':entryDate' => date('Y-m-d H:i:s'),
		                    ':entryAuthor' => $_POST['entryAuthor']
		                ));
		
		                //redirect to index page
		                header('Location: index.php?action=added&isAdmin=true');
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

<h1 class="rc">iStock Blog -- <span class="red">Admin</span></h1>

<div class="entry-list rc">
	<h2>Add a New Listing</h2>
	
	<form action='' method='post'>
		<div class='form-group'>
			<label>Title</label>
			<input type='text' class='form-control' name='entryTitle' value=''>
		</div>
		<div class='form-group'>
			<label>Content</label>
			<textarea name='entryContent' class='form-control' cols='60' rows='10'></textarea>
		</div>
		<div class='form-group'>
			<label>Author</label>
			<input type='text' class='form-control' name='entryAuthor' value='' />
		</div>
		<div class='form-group'>
			<label></label>
			<input type='submit' name='submit' value='Submit' />
		</div>
	</form>

</div>