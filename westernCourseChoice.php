<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Courses</title>
</head>
<body>

<!--- depending on what button the user clicked to manipulate a western course, each case is handled here --->
<link rel="stylesheet" href="style.css">

<?php
        include 'connectdb.php';
        $course = $_POST["westerncourses"];
?>

<script src="westernChoiceScript.js"></script>

<?php
	//if user wants to edit the course
	include "editCourse.php";
?>

<?php
	//if user wants to get the equivalent courses of a western course
	include "getEquivCourses.php";
?>

<form id="deleteForm" action="deleteWesternCourse.php" method="post">

<input type="hidden" name="course" value ="<?php echo $course; ?>">

<?php
	//if user wants to delete course
	include "checkDelete.php";
?>

</form>

<?php 
	mysqli_close($connection);
?>

</body>
</html>
