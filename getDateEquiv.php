<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Courses</title>
</head>
<body>

<link rel="stylesheet" href="style.css">

<script>
<!--- this function sends user back to home page upon clicking the back button --->
function back(){
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

</script>

<!--- creation of the equivalent courses table that is shown upon clicking the get Equivalent Courses button --->
<table align="center">
<tr>
<th>Western Course Number</th>
<th>Western Course Name</th>
<th>Western Course Weight</th>
<th>University Name</th>
<th>Outside Course Number</th>
<th>Outside Course Name</th>
<th>Outside Course Weight</th>
<th>Date of Equivalence</th>

</tr>

<?php
        include 'connectdb.php';
        $date = $_POST["dates"]; //obtain the selected date from the main page

	echo "<h2> Equivalencies Made On or Before $date </h2>";

	//gets equivalent courses created on and before the date selected
	$query = "SELECT w.CourseNumber as wNum, w.CourseName as wName, w.Weight as wWeight, u.OfficialName, o.CourseName, o.CourseCode, o.Weight, e.Date FROM (((IsEquivalentTo e INNER JOIN University u ON e.SchoolNickname = u.Nickname) INNER JOIN WesternCourse w ON e.CourseNumber = w.CourseNumber) INNER JOIN OutsideCourse o ON e.CourseCode = o.CourseCode AND u.SchoolID = o.SchoolID) WHERE e.Date <= '" . $date . "' ORDER BY e.Date DESC;";

	$result = mysqli_query($connection,$query);

	if (!$result) {
    		die("databases query failed.");
	}

	//print out the table of equivalent courses with their dates
	while ($row = mysqli_fetch_assoc($result)) {

		echo "<tr>";
        	echo "<td>"; echo $row["wNum"]; echo "</td>";
        	echo "<td>"; echo $row["wName"]; echo "</td>";
       		echo "<td>"; echo $row["wWeight"]; echo "</td>";
        	echo "<td>"; echo $row["OfficialName"]; echo "</td>";
        	echo "<td>"; echo $row["CourseName"]; echo "</td>";
		echo "<td>"; echo $row["CourseCode"]; echo "</td>";
		echo "<td>"; echo $row["Weight"]; echo "</td>";
		echo "<td>"; echo $row["Date"]; echo "</td>";        
		echo "</tr>";
	}

	mysqli_free_result($result);

	mysqli_close($connection);

?>

</table>

<br><br>

<input type="submit" onclick="back()" value="Go Back"><br>

</body>
</html>
