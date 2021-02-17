<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Courses</title>
</head>
<body>

<link rel="stylesheet" href="style.css">

<script>
<!--- this function shows an alert message and sends user back to home page --->
function deleted(){

        alert("The course has been successfully deleted.");
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}
</script>

<?php

	include 'connectdb.php';
	$course = $_POST["course"];
	
	//the query deletes the selected Western Course
	$query = "DELETE FROM WesternCourse WHERE CourseNumber= '" . $course . "';";

	$result = mysqli_query($connection, $query);

	if (!$result) {
        	die("databases query failed.");
	}
	
	//call deleted() function
	echo "<script> deleted(); </script>";

	mysqli_close($connection);
?>

</body>
</html>
