<?php
	require_once('db_connect.php');
	$query = $db->query('SELECT entryID, entryTitle, entryContent, entryDate FROM blog_posts ORDER BY entryID DESC');
?>

<link rel="stylesheet" href="css/main.css" type="text/css">

<h1 class="rc">iStock Blog</h1>

<div class="entry-list rc">
<h2>--- Past Listings ---</h2>
<?php while ($row = $query->fetch()): ?>
	<div class="item">
		<h3 class="title"><?= $row['entryTitle']; ?></h3>
		<div class="tiny author">- <? echo $row['entryAuthor']; ?></div>
		<?= $row['entryContent']; ?>
	</div>
<?php endwhile; ?>
</div>