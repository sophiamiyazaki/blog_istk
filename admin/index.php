<?php
	require_once('../includes/header.php');
	$query = $db->query('SELECT entryID, entryTitle, entryContent, entryDate, entryAuthor FROM blog_posts ORDER BY entryID DESC');
	
	if(isset($_GET['deleteid'])){ 
	    $stmt = $db->prepare('DELETE FROM blog_posts WHERE entryID = :entryID') ;
	    $stmt->execute(array(':entryID' => $_GET['deleteid']));
	
	    header('Location: index.php?action=deleted&isAdmin=true');
	    exit;
	}
	
?>

<h1 class="rc">iStock Blog -- <span class="red">Admin</span></h1>

<div class="entry-list rc">
	<div><a href="newPost.php?isAdmin=true">Add a new post</a></div>
	<div><a href="../index.php?isAdmin=true">Go back to main page of listings</a></div>
</div>


<div class="entry-list rc">
	<h2>Past Listings</h2>
	<?php while ($row = $query->fetch()): ?>
		<div class="item">
			<h3 class="title"><a href="../entry.php/?id=<?= $row['entryID']; ?>"><?= $row['entryTitle']; ?></a></h3>
			<div class="tiny author">by <? echo ($row['entryAuthor'] ? $row['entryAuthor'] : 'anonymous'); ?></div>
			<div class="actions"><a class="btn btn-default btn-sm" role="button" href="editPost.php?editid=<?= $row['entryID']; ?>">edit</a> <a class="btn btn-danger btn-sm" role="button" href="index.php?deleteid=<?= $row['entryID']; ?>">delete</a></div>
		</div>
	<?php endwhile; ?>
</div>