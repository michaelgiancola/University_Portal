<?php

//if the user clicks the get equivalent courses button
	if ($_POST["equivalentcourses"]){

        	echo "<br>";

        	//get the information of the selected western course and all of its equivalents
        	$query = "SELECT * FROM WesternCourse WHERE CourseNumber = '" . $course . "';";
        	$query1 = "SELECT u.OfficialName, o.CourseCode, o.CourseName, o.Weight, e.Date FROM (((IsEquivalentTo e INNER JOIN University u ON e.SchoolNickname = u.Nickname) INNER JOIN WesternCourse w ON e.CourseNumber = w.CourseNumber) INNER JOIN OutsideCourse o ON e.CourseCode = o.CourseCode AND u.SchoolID = o.SchoolID) WHERE w.CourseNumber = '" . $course . "';";

        	$result = mysqli_query($connection,$query);
        	$result1 = mysqli_query($connection,$query1);

        	if (!$result || !$result1) {
                	die("databases query failed.");
        	}

        	$row = mysqli_fetch_assoc(($result));
		
        	$courseNum = $row["CourseNumber"];
        	$courseName = $row["CourseName"];
        	$weight = $row["Weight"];
			
		//print the western course info
        	echo "<h2> Equivalent Courses to $courseNum  $courseName  with Weight of $weight</h2>";
		
		//create a table for all the equivalent courses
        	echo "<table align= '" . center . "'>";
        	echo "<tr>";
        	echo "<th>University Name</th>";
        	echo "<th>Course Code</th>";
        	echo "<th>Course Name</th>";
        	echo "<th>Weight</th>";
        	echo "<th>Date</th>";
        	echo "</tr>";
			
		//print the equivalent courses in a table
        	while ($row = mysqli_fetch_assoc($result1)) {

                	echo "<tr>";
                	echo "<td>"; echo $row["OfficialName"]; echo "</td>";
                	echo "<td>"; echo $row["CourseCode"]; echo "</td>";
                	echo "<td>"; echo $row["CourseName"]; echo "</td>";
                	echo "<td>"; echo $row["Weight"]; echo "</td>";
                	echo "<td>"; echo $row["Date"]; echo "</td>";
                	echo "</tr>";
        	}

        	mysqli_free_result($result);
        	mysqli_free_result($result1);

        	echo "</table>";
        	echo "<br><br>";
        	echo '<input type="submit" onclick="back()" value= "Go Back">';
	}

?>
