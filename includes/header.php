<?php
	require_once('db_connect.php');
		if (isset($_GET) && $_GET['isAdmin']=='true') {
		$_SESSION['isAdmin'] = true;
	} else {
		$_SESSION['isAdmin'] = false;
	}
	
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="http://www.sophiaya.com/blog_istck/css/main.css" type="text/css">