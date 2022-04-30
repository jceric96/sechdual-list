<?php
	/*
	 * @file: 	index.php
	 * 
	 * @author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 * @desc:	This file is the homepage of the list interface, which serves as a starting point for Assignment 3 (CSCI 2170, Fall 2021).
	 * 
	 * @notes:	As a student working on A3 in CSCI 2170, you are allowed to edit this file.
	 * 			When you edit/modify, include block comments to summarize changes. 
	 * 			Clearly highlight what changed and why, and state assumptions if you make any.
	 */
	session_start(); 

	session_regenerate_id(true); //--> will destroy old session

	if (!isset($_SESSION['fname'])) {
		header("location:includes/login.php");
	}

	require_once "includes/db.php";

	require_once "includes/processform.php";
	
	require_once "includes/header.php";
?>
	<main id="pg-main">
		<h3>Submit a new item to your to do list:</h3>
		<form id="form-flex-container" action="index.php" method="post">
			<input type="text" id ="Text" placeholder="Enter list item" name="listItem">
			<input type="submit" id ="Submit" name="submitListItem" value="Submit list item";>
		</form>
		<section id="list-container">
			<h3>Your list:</h3>
			<?php
				if(isset($_POST['Text'])){			
			?>
			<script>
    			let content = document.getElementById("Text").value
    			sendDataToServer(content)

			function sendDataToServer(contentFromText) {
    			let ajaxPostObj = new XMLHttpRequest()
    			ajaxPostObj.open("POST", "includes/processform.php" , true)
    			ajaxPostObj.onreadystatechange = function() {
        			if (ajaxPostObj.readyState == 4 && ajaxPostObj.status == 200) {
            			console.log(ajaxPostObj.status)
            			console.log(ajaxPostObj.responseText)
        			}
    			}
    			ajaxPostObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
				console.log("content=" + contentFromText)
   				ajaxPostObj.send("content=" + contentFromText)
	  			ajaxPostObj.send()
			}
			function getDataFromServer() {
    			let infoBox = document.querySelector("#updata");
   				let ajaxObject = new XMLHttpRequest()
    			ajaxObject.open("GET", "includes/processform.php", true)
    			ajaxObject.onreadystatechange = function() {
        			if (this.readyState == 4 && this.status == 200) {
            			infoBox.innerHTML = this.responseText
        			}
    			}
    			ajaxObject.send()
			}				
			</script>

			<?php
			}
			?>
				<div id="getdata">
			<?php
				$select = "SELECT * FROM mylist";
					$Data = $conn->query($select);
					if($Data->num_rows>0){
						while($row = $Data->fetch_assoc()){
						/*
						* Delete listitems feature and achieve checkbox feature
	 					* URL: https://dal.brightspace.com/d2l/le/content/185358/viewContent/2631277/View
	 					* Authors: Raghav V. Sampangi 
	 					* Date: DD-MMM-YYYY (30 Oct 2021)
	 					*/						
							$checkedLinkString = <<<ENDDELETESTRING
							<input type="checkbox" id = "complete-box" name ='complete' checked onclick="location.href='index.php?complete={$row['l_id']}&&completed=0 '">
							ENDDELETESTRING;
							$uncheckLinkString = <<<ENDDELETESTRING
							<input type="checkbox" id = "complete-box" name ='complete' onclick="location.href='index.php?complete={$row['l_id']}&&completed=1 '"> 
							ENDDELETESTRING;
							$deleteLinkString = <<<ENDDELETESTRING
							<input type='button' id = 'delete-list' name ='delete' value='Delete this item'  onclick="location.href='index.php?delete={$row['l_id']}'">
							ENDDELETESTRING;
			
							if($check== 1 || $row['l_done']) {
								echo  $checkedLinkString;
								echo  "<label class='complete'>$row[l_item]</label>";
							}else {
								echo  $uncheckLinkString;
								echo  "<label>$row[l_item]</label>";
							}
							echo  $deleteLinkString;
							echo "<br>";
						}
					}
					else{
						echo "<p>is currently empty!</p>";
					}
			?>
				</div>
		</section>
	</main>
	<?php
	require_once "includes/footer.php";
	?>