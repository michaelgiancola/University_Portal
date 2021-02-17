<?php
//this PHP block shows the Western Courses and makes them selectable
//this file is called in the indexpage file

	include 'connectdb.php';

	$query = "SELECT * FROM WesternCourse";

	$result = mysqli_query($connection,$query);

	if (!$result) {
    		die("databases query failed.");
	}

	//prints out western courses with radio buttons associated with each
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
