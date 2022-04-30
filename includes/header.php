<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>To Do list</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<header id="pg-header">
		<h1>This is your To Do list</h1>
	</header>

	<nav id="primary-nav">
		
		<?php
		// include code here to display a hello message, and a link to logout when someone is logged in. Use this format: Hello FirstName! (logout)		
			if (isset($_SESSION['fname'])) {
		?>
				<a href="index.php">Home</a>
				<p id="welcome">Hello <?php echo $_SESSION['fname']; ?>！<a href= "includes/logout.php">(click here to logout)</a></p>
		<?php
			}
			else{
		?>
				<a href="../index.php">Home</a>
		<?php	
			}
		?>
	</nav>
