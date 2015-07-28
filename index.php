<?php
	require_once('db_connect.php');

	$query = $db->query('SELECT entryID, entryTitle, entryContent, entryDate FROM blog_posts ORDER BY entryID DESC');
?>

<style>
.entry-list {
	background-color: #fefefe;
	font-family: Verdana, Arial;
	font-size: 14px;
	padding: 10px;
}
.entry-list div.item {
	padding: 5px 10px;
	border-bottom: 1px dotted #eee;
}
</style>

<div class="entry-list">
<?php while ($row = $query->fetch()): ?>
	<div class="item">
		<span>Title</span>: <?= $row['entryTitle'] ?>
	</div>
<?php endwhile; ?>
</div>