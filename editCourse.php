<?php

	//validation to ensure that a western course was selected
	if ($course == ""){echo "<script> failed(); </script>";}

	//if edit course button is selected then edit the course info in the database
	if ($_POST["editcourse"]){
		
		//get information that was posted through the form
        	$editType = $_POST["edit"];
        	$changeText = $_POST["theedit"];
		
		//use data above and update the Western Course info
        	$query = "UPDATE WesternCourse " . " SET " . $editType . "= '" . $changeText . "' WHERE CourseNumber= '" . $course . "';";

        	$result = mysqli_query($connection,$query);

        	if (!$result) {
                	die("databases query failed.");
        	}
		
		//show message that shows info was updated
        	echo "<script> courseInfoChange(); </script>";
	}

?>
