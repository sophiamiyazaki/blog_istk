<?php
	require_once('../db_connect.php');
	$query = $db->query('SELECT entryID, entryTitle, entryContent, entryDate FROM blog_posts ORDER BY entryID DESC');
	
?>


<link rel="stylesheet" href="../css/main.css" type="text/css">

<div class="entry-list rc admin">
<h2>--- Past Listings ---</h2>
<?php while ($row = $query->fetch()): ?>
	<div class="item">
		<h3 class="title"><?= $row['entryTitle']; ?></h3> - edit | delete
	</div>
<?php endwhile; ?>
</div>