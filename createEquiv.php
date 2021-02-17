<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>University Portal</title>
</head>
<body>

<link rel="stylesheet" href="style.css">

<!--- functions for validation of choice to create the equivalency or if back button is clicked --->
<script>
function back(){
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

function validation(){
	var choice = confirm("Are you sure you want to create this equivalency?");
	if(choice == true){
		return true;
	}

	else {
		return false;
	}
}
</script>

<!--- form for when user selects the two courses they want to make equivalent --->
<form name="EquivForm" action="makeEquivalent.php" onsubmit="return validation()" method="post">

<h2>Western Courses</h2>

<!--- table created to show western courses --->
<table align="center">
<tr>
<th>Select</th>
<th>Course Number</th>
<th>Course Name</th>
<th>Weight</th>
<th>Suffix</th>
</tr>

<?php
//show western courses as radio buttons to create equivalencies

	include 'connectdb.php';

	$query = "SELECT * FROM WesternCourse";

	$result = mysqli_query($connection,$query);

	if (!$result) {
    		die("databases query failed.");	
	}

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<tr>";
		echo "<td>"; echo '<input type="radio" name="westerncourses" value= "'. $row["CourseNumber"]. '">'; echo "</td>";
		echo "<td>"; echo  $row["CourseNumber"]; echo "</td>";
		echo "<td>"; echo  $row["CourseName"]; echo "</td>";
		echo "<td>"; echo  $row["Weight"]; echo "</td>";
		echo "<td>"; echo  $row["Suffix"]; echo "</td>";
		echo "</tr>";
	}

	mysqli_free_result($result);
?>

</table>

<br><br>

<h2>Outside University Courses</h2>

<!--- table created to show outside courses --->
<table align="center">
<tr>
<th>Select</th>
<th>Course Code</th>
<th>Course Name</th>
<th>Weight</th>
<th>Year Offered</th>
<th>University</th>
</tr>

<?php
//get outside courses and make them each radio buttons in their table

	$query1 = "SELECT CourseCode, CourseName, Weight, YearOffered, OfficialName, Nickname FROM OutsideCourse o INNER JOIN University u ON o.SchoolID = u.SchoolID";

	$result1 = mysqli_query($connection,$query1);

	if (!$result1) {
    		die("databases query failed.");
	}

	while ($row = mysqli_fetch_assoc($result1)) {

		echo "<tr>";
		echo "<td>"; echo '<input type="radio" name="outsidecourseanduni" value= "'. $row["CourseCode"] . "#" . $row["Nickname"] . '">'; echo "</td>";
		echo "<td>"; echo  $row["CourseCode"]; echo "</td>";
		echo "<td>"; echo  $row["CourseName"]; echo "</td>";
		echo "<td>"; echo  $row["Weight"]; echo "</td>";
		echo "<td>"; echo  $row["YearOffered"]; echo "</td>";
		echo "<td>"; echo  $row["OfficialName"]; echo "</td>";
		echo "</tr>";
	}	

	mysqli_free_result($result1);

	mysqli_close($connection);
?>

</table>

<br>

<input type=submit value="Create Equivalency"/>

</form>

<br><br>

<input type="submit" onclick="back()" value="Go Back"><br>

</body>
</html>
