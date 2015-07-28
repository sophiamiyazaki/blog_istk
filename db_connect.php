<?php
ob_start();
session_start();

define('DBHOST','localhost');
define('DBUSER','sophiaya_mighty');
define('DBPASS','AllMightyUser78');
define('DBNAME','sophiaya_blog_istck');

$db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS) or die("Unable to connect yo");
	//echo "connected";

?>