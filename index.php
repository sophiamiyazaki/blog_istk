<?php
	require_once('includes/header.php');
	$query = $db->query('SELECT entryID, entryTitle, entryDate, entryAuthor FROM blog_posts ORDER BY entryID DESC');
?>

<h1 class="rc">iStock Blog</h1>

<?php if ($_SESSION['isAdmin']): ?>
<div class="entry-list rc">
	<h2>Admin Section</h2>
	<div><a href="admin/newPost.php?isAdmin=true">Add a new post</a></div>
	<div><a href="admin/index.php?isAdmin=true">Delete or edit an existing post</a></div>
</div>
<?php endif; ?>

<div class="entry-list rc">
	<h2>Past Listings</h2>
	<?php while ($row = $query->fetch()): ?>
		<?
			$date = 'a whim, who knows when';
			if ($row['entryDate'] != '0000-00-00 00:00:00') {
				$date = date("F j, Y, g:i a", strtotime($row['entryDate']));
			}
		?>
		<div class="item">
			<h3 class="title"><a href="entry.php/?id=<?= $row['entryID']; ?>"><?= $row['entryTitle']; ?></a></h3>
			<div class="tiny author">by <? echo ($row['entryAuthor'] ? $row['entryAuthor'] : 'anonymous'); ?> on <?= $date; ?></div>
		</div>
	<?php endwhile; ?>
</div>