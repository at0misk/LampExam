<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
</head>
<body>
	<div class="nav">
	<a href='/friends'>Home </a>
	<a href='/logout'>Logout</a>
	</div>
	<?php
		echo "<h3>" . $clicked['alias'] . "'s Profile</h3>"; 
		echo "<p>Name: " . $clicked['name'] . "</p>";
		echo "<p>Email Address: " . $clicked['email'] . "</p>";
	?>
</body>
</html>