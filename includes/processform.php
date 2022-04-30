<?php
	/*
	 * @file: 	processform.php
	 * 
	 * @author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 * @desc:	This file processes data submitted to add/edit/delete items to the list.
	 * 
	 * @notes:	As a student working on A3 in CSCI 2170, you are allowed to edit this file. 
	 * 			When you edit/modify, include block comments to summarize changes. 
	 * 			Clearly highlight what changed and why, and state assumptions if you make any.
	 */


	/*
	 * Processing submitted list item
	 */

	if (isset($_POST['submitListItem'])) {
		// your code here
		$items = stripslashes(htmlspecialchars(trim($_POST['listItem']))); //sanitize data	
		if($items!=NULL){
			$insert = "INSERT INTO mylist (l_item, l_done )
			VALUES ('$items','0')";  
			$result = mysqli_query($conn, $insert) or die ('Error querying database.'. mysqli_error($conn));
		}
	}

	/*
	 *	Processes delete item requests
	 */
	 					
	if (isset($_GET['delete'])) {
		// your code here
		$l_id = $_GET['delete'];
		$delete = "DELETE FROM mylist WHERE l_id=" . $l_id;
		$conn->query($delete);
		header ("Location: index.php");
		die();
	}

	/*
	 *	Processes completed item requests
	 *  "Mark as done" --> set l_done = 1
	 */

	if (isset($_GET['complete'])) {
		// your code here
		$l_done = stripslashes(htmlspecialchars(trim($_GET['completed']))); //sanitize data
		$l_id = $_GET['complete'];
		$update = "UPDATE mylist SET l_done = $l_done WHERE l_id =" .$l_id;
		$result = mysqli_query($conn, $update) or die ('Error querying database.'. mysqli_error($conn));
	}


?>