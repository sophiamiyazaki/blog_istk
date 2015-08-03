<?php
	require_once('includes/header.php');
	$stmt = $db->prepare('SELECT entryID, entryTitle, entryContent, entryAuthor, entryDate FROM blog_posts WHERE entryID = :entryID') ;
	$stmt->execute(array(':entryID' => $_GET['id']));
	$row = $stmt->fetch();
	$date = 'a whim, who knows when';
	if ($row['entryDate'] != '0000-00-00 00:00:00') {
		$date = date("F j, Y, g:i a", strtotime($row['entryDate']));
	}
	
	$cstmt = $db->prepare('SELECT commentContent, commentDate, commentAuthor FROM blog_comments WHERE blogEntryID = :blogEntryID ORDER BY commentID DESC') ;
	$cstmt->execute(array(':blogEntryID' => $_GET['id']));
	
	//handle comment submission
	if(isset($_POST['submit'])){
	
		// easy validation
		if($_POST['commentContent'] ==''){
		    $error[] = 'Please enter some smarty pants comment';
		}
		
		if($_POST['commentAuthor'] ==''){
		    $error[] = 'Please enter your name.';
		}
		
		if (!isset($error)) {
		
			try {
				$stmt = $db->prepare('INSERT INTO blog_comments (blogEntryID, commentContent, commentDate, commentAuthor) VALUES (:blogEntryID, :commentContent, :commentDate, :commentAuthor)');
		                $stmt->execute(array(
		                    ':blogEntryID' => $_POST['blogEntryID'],
		                    ':commentContent' => $_POST['commentContent'],
		                    ':commentDate' => date('Y-m-d H:i:s'),
		                    ':commentAuthor' => $_POST['commentAuthor']
		                ));
		
		                //redirect to entry with loaded comments
		                $id = $_POST['blogEntryID'];
		                header('Location: ?id=' . $id . '&action=commented');
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

<h1 class="rc">iStock Blog</h1>

<div class="entry-list rc">
	<a href="../index.php">back to listings</a>
</div>

<div class="entry-list rc">	
	<div class="item">
		<h3 class="title"><a href="entry.php/?id=<?= $row['entryID']; ?>"><?= $row['entryTitle']; ?></a></h3>
		<div class="tiny author">by <? echo ($row['entryAuthor'] ? $row['entryAuthor'] : 'anonymous'); ?> on <?= $date; ?></div>
		<div class="content"><?= $row['entryContent']; ?></div>
		<? if ($_SESSION['isAdmin']) : ?>
			<div class="actions"><a class="btn btn-default btn-sm" role="button" href="../admin/editPost.php?editid=<?= $row['entryID']; ?>&isAdmin=true">edit</a> <a class="btn btn-danger btn-sm" role="button" href="../admin/index.php?deleteid=<?= $row['entryID']; ?>&isAdmin=true">delete</a></div>
		<? endif; ?>
	
		<div class="comments">
			<h4>Comments</h4>
			<?php if (!$crow = $cstmt->fetch()) : ?>
				Aww. No one has commented yet. Be the first!
			<?php endif; ?>
			
			<?php while ($crow = $cstmt->fetch()): ?>
				<? 
					$cdate = 'a whim, who knows when';
					if ($crow['commentDate'] != '0000-00-00 00:00:00') {
						$cdate = date("F j, Y, g:i a", strtotime($crow['commentDate']));
					}
				?>
				<div class="item">
					<?= $crow['commentContent']; ?><br/>
					<div class="tiny author">by <? echo ($crow['commentAuthor'] ? $crow['commentAuthor'] : 'anonymous'); ?> on <?= $cdate; ?></div>
				</div>
			<?php endwhile; ?>
		
			<h4>Add a comment!</h4>
			<form action='' method='post'>
				<input type='hidden' name='blogEntryID' value='<?= $row['entryID'];?>'>
				<div class='form-group'>
					<label>Content</label>
					<textarea name='commentContent' class='form-control' cols='60' rows='10'></textarea>
				</div>
				<div class='form-group'>
					<label>Author</label>
					<input type='text' class='form-control' name='commentAuthor' value='' />
				</div>
				<div class='form-group'>
					<label></label>
					<input type='submit' name='submit' value='Submit' />
				</div>
			</form>
		</div>
	</div>
</div>