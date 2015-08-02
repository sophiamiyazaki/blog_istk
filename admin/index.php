<?php
	require_once('../includes/header.php');
	$query = $db->query('SELECT entryID, entryTitle, entryContent, entryDate, entryAuthor FROM blog_posts ORDER BY entryID DESC');
	
	if(isset($_GET['deleteid'])){ 
	    $stmt = $db->prepare('DELETE FROM blog_posts WHERE entryID = :entryID') ;
	    $stmt->execute(array(':entryID' => $_GET['deleteid']));
	
	    header('Location: index.php?action=deleted');
	    exit;
	}
	
?>

<h1 class="rc">iStock Blog -- <span class="red">Admin</span></h1>

<div class="entry-list rc admin">
	<h2>Past Listings</h2>
	<?php while ($row = $query->fetch()): ?>
		<div class="item">
			<h3 class="title"><?= $row['entryTitle']; ?></h3> - by <? echo ($row['entryAuthor'] ? $row['entryAuthor'] : 'anonymous'); ?>
			<p><?= $row['entryContent']; ?></p>
			<div class="actions"><a href="editPost.php?editid=<?= $row['entryID']; ?>">edit</a> | <a href="index.php?deleteid=<?= $row['entryID']; ?>">delete</a></div>
		</div>
	<?php endwhile; ?>
</div>