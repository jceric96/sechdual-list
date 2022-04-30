<?php
	/*
	 * @file: 	index.php
	 * 
	 * @author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 * @desc:	This file must contain the login processing script.
	 * 
	 * @notes:	As a student working on A3 in CSCI 2170, you are allowed to edit this file.
	 * 			When you edit/modify, include block comments to summarize changes. 
	 * 			Clearly highlight what changed and why, and state assumptions if you make any.
	 */

	require_once "db.php";

	require_once "header.php";
	session_start();
	session_regenerate_id(); // --> will not destroy old session
	
?>
<main id="pg-main">
		<h3>You must login to continue...</h3>
		<h4 id = "tip">*** The username and/or password that you have entered is incorrect. Please try again. ***</h4>
		<form id="form-flex-container" action="login.php" method="post">
			<div>
			<label>Enter your username:</label>
			<input type="text" id ="input-username" placeholder="Please enter your username" name="username">
			</div>
			<div>
			<label>Enter your password:</label>
			<input type="text" id ="input-password" placeholder="Please enter your password" name="password">
			</div>
			<input type="submit" id ="Submit" name="submit" value="Login">
		</form>
</main>
<?php
	if (isset($_POST['submit'])) {
		session_regenerate_id(true); //--> will destroy old session

		$_SESSION['username'] = stripslashes(htmlspecialchars(trim($_POST['username']))); //sanitize data	
		$_SESSION['password'] = stripslashes(htmlspecialchars(trim($_POST['password']))); //sanitize data
		//$_SESSION['username'] = sanitizeData($_POST['username']);
    	//$_SESSION['password'] = sanitizeData($_POST['password']);
		$checkUser = "SELECT * FROM mylist_login WHERE m_login_username ='{$_POST['username']}' AND m_login_password='{$_POST['password']}'";
		$Data = $conn->query($checkUser);
		$row = $Data->fetch_assoc();
		if($Data->num_rows>0){
			$_SESSION['fname']=$row['m_login_firstname'];
			header("Location:../index.php");
		}
		else{
?>
		<script>	
			document.getElementById("tip").style.display="block";
		</script>
<?php
			session_destroy();
		}
	}
	// function sanitizeData($data) {
	// 	$cleanData = trim($data);
	// 	$cleanData = stripslashes($cleanData);
	// 	$cleanData = htmlspecialchars($cleanData);

	// 	return $cleanData;
	// }
?>
<?php
	require_once "footer.php";
?>