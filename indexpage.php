<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>University Portal</title>
</head>
<body>

<!--- Link the css page and javascript file into this page --->
<link rel="stylesheet" href="style.css">

<script src="validationAndSorting.js"></script>

<h1>Welcome to the University Portal!</h1>

<!--- create a form to send Western Course Choice info --->
<form id="choiceForm" action="westernCourseChoice.php" method="post">

<h2>Select A Western Course</h2>

<!--- Instructions for sorting the Western Course table --->
*Click Course Number or Course Name headings to toggle from ascending or descending order*

<br><br>

<!--- create a table to show the Western Courses in and make the Course Number and Course Name headings clickable to sort by calling sort() function --->
<table id="courseTable" align="center">
<tr>
<th>Select</th>
<th onclick="sort(1)">Course Number</th>
<th onclick="sort(2)">Course Name</th>
<th>Weight</th>
<th>Suffix</th>
</tr>

<?php
	//call this .php page to display the Western Courses on the main page
	include "showWesternCourses.php";
?>

</table>

<br>

<!--- Show the edit option box and text box if a user wants to edit a western course (drop down list of options) --->
<label for="edit">Would you like to edit:</label>
<select name="edit" id="edit" onchange="placeHold()">
<option value="ChooseOne">Choose One</option>
<option value="CourseName">Course Name</option>
<option value="Weight">Course Weight</option>
<option value="Suffix">Course Suffix</option>
</select>
<input type="text" placeholder="Insert Edit Here" name="theedit" id="editbox">
<br><br>

<!--- create the submit buttons for edit course, delete course, and equivalent course and call the validation functions where applicable --->
<input type="submit" name="editcourse" onclick="validateEditEntry()" value="Edit Course">
<input type="submit" name="deletecourse" value="Delete Course">
<input type="submit" name="equivalentcourses" value="Get Equivalent Courses">

</form>

<br>

<p>
<hr>
<p>

<!--- create form for when user wants to enter a new Western Course --->
<form name="enterWesternCourseForm" action="enterWesternCourse.php" onsubmit="return validateEntry()" method="post">

<h2>Enter the Western Course Here</h2>

<!--- create text boxes for user entry --->
<input type="text" placeholder="Course Number" name="coursenumber"><br><br>
<input type="text" placeholder="Course Name" name="coursename"><br><br>
<input type="text" placeholder="Weight (1 or 0.5)" name="weight"><br><br>
<input type="text" placeholder="Suffix" name="suffix"><br><br>
<input type="submit" value="Add Western Course"><br>

<br>
</form>

<p>
<hr>
<p>

<h2>Select a University or Province</h2>

<!--- create form to get the university information when a Uni is clicked on --->
<form action="getUniInfo.php" method="post">

<!--- create a table to hold the university buttons and province buttons --->
<table id="uni" align="center">
<tr>
<th>University Name</th>
<th>Province</th>
</tr>

<?php
	//.php file that shows the university table with their provinces
	include "showUniversities.php";
?>

</table>

</form>

<br><br>

<p>
<hr>
<p>

<!--- a form to get the universities with no courses offered upon button click --->
<form action="getUniWithNoCourses.php" method="post">

<input type ="submit" value="Find Universities With No Courses Offered">

</form>

<p>
<hr>
<p>

<!--- a form to create an equivalency between western course and outside course --->
<form action="createEquiv.php" method="post">

<input type ="submit" value="Create A Course Equivalency">

</form>

<p>
<hr>
<p>

<h2>Search Equivalencies By Date</h2>

<!--- form to get the equivalencys made on or before selected date --->
<form action="getDateEquiv.php" onsubmit="return validateDateEntry()" method="post">

<!--- create dropdown for all equivalency dates in system --->
<label for="dates">Select the date:</label>
<select name="dates" id="dates">

<option value="ChooseOne">Choose One</option>

<?php

	//get all dates in descending order in the Equivalent course table
	$query = "SELECT DISTINCT Date FROM IsEquivalentTo ORDER BY Date DESC";

	$result = mysqli_query($connection,$query);

	if (!$result) {
    		die("databases query failed.");
	}

	//print out the dates in the dropdown list format
	while ($row = mysqli_fetch_assoc($result)) {	
		echo '<option value= "' . $row["Date"] . '"> ' . $row["Date"] . ' </option>';
	}

	mysqli_free_result($result);

	mysqli_close($connection);
?>

</select>

<input type="submit" value="Search Equivalencies">

</form>

</body>
</html>
