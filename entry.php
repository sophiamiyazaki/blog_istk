<?php
	require_once('includes/header.php');
	$stmt = $db->prepare('SELECT entryID, entryTitle, entryContent, entryAuthor, entryDate FROM blog_posts WHERE entryID = :entryID') ;
	$stmt->execute(array(':entryID' => $_GET['id']));
	$row = $stmt->fetch();
	$date = 'a whim, who knows when';
	if ($row['entryDate'] != '0000-00-00 00:00:00') {
		$date = date("F j, Y, g:i a", strtotime($row['entryDate']));
	}
	
?>

<h1 class="rc">iStock Blog</h1>

<div class="entry-list rc">
	<a href="../index.php">back to listings</a>
</div>

<div class="entry-list rc">	
	<div class="item">
		<h3 class="title"><a href="entry.php/?id=<?= $row['entryID']; ?>"><?= $row['entryTitle']; ?></a></h3>
		<div class="tiny author">by <? echo ($row['entryAuthor'] ? $row['entryAuthor'] : 'anonymous'); ?></div>
		<div class="content"><?= $row['entryContent']; ?></div>
		<? if ($_SESSION['isAdmin']) : ?>
			<div class="actions"><a class="btn btn-default btn-sm" role="button" href="../admin/editPost.php?editid=<?= $row['entryID']; ?>&isAdmin=true">edit</a> <a class="btn btn-danger btn-sm" role="button" href="../admin/index.php?deleteid=<?= $row['entryID']; ?>&isAdmin=true">delete</a></div>
		<? endif; ?>
	</div>
</div>