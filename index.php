<?php
	require_once('includes/header.php');
	$query = $db->query('SELECT entryID, entryTitle, entryContent, entryDate, entryAuthor, FROM blog_posts ORDER BY entryID DESC');
?>

<h1 class="rc">iStock Blog</h1>

<div class="entry-list rc">
	<h2>Admin Section</h2>
	<div><a href="admin/newPost.php">Add a new post</a></div>
	<div><a href="admin/index.php">Delete or edit an existing post</a></div>
</div>

<div class="entry-list rc">
	<h2>Past Listings</h2>
	<?php while ($row = $query->fetch()): ?>
		<div class="item">
			<h3 class="title"><?= $row['entryTitle']; ?></h3>
			<div class="tiny author">- <?= $row['entryAuthor']; ?></div>
			<?= $row['entryContent']; ?>
		</div>
	<?php endwhile; ?>
</div>