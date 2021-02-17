<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Courses</title>
</head>
<body>

<link rel="stylesheet" href="style.css">

<!--- added() alerts user that the course entered was successfully added then brings them back to home page --->
<!--- exists() alerts user that the course entered already exists in database and brings them back to home page --->
<script> 
function added(){
	alert("The course has been added.");
	window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

function exists(){
	alert("This course was not added since it already exists.");
	window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
} 
</script>

<?php
	include 'connectdb.php';

	//obtain info from sent form
	$courseNumber = $_POST["coursenumber"];
	$courseName = $_POST["coursename"];
	$weight = $_POST["weight"];
	$suffix = $_POST["suffix"];

	//query helps to check if the entered course already exists
	$query = "SELECT COUNT(CourseNumber) FROM WesternCourse WHERE CourseNumber = '" . $courseNumber . "';";

        $result = mysqli_query($connection,$query);

        if (!$result) {
                die("databases query failed.");
        }

	$row = mysqli_fetch_assoc(($result));
	
	$existCheck = $row["COUNT(CourseNumber)"];

	//if the course exists in the database already do not insert
	if($existCheck > 0){
		echo "<script> exists(); </script>";
	}

	//if the course is new to the database insert it
	if($existCheck == 0){
		$query = "INSERT INTO WesternCourse values('" . $courseNumber . "', '" . $courseName . "', '" . $weight . "', '" . $suffix . "');";

		if (!mysqli_query($connection, $query)) {
        		die("Error: insert failed" . mysqli_error($connection));
    		}
		echo "<script> added(); </script>";	
	}	

	mysqli_close($connection);
?>


</body>
</html>
