<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>University Portal</title>
</head>
<body>

<link rel="stylesheet" href="style.css">

<script>
function back(){
	window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

</script>
 
<?php
     
	include 'connectdb.php';
        
	//get university or province clicked on from form
	$uni = $_POST["universities"];
	$prov = $_POST["provinces"];

//if a university was clicked on get its information and courses offered
if($_POST["universities"]){
		
	echo "<table align='" . center . "'>";
	echo "<tr>";
	echo "<th>Course Code</th>";
	echo "<th>Course Name</th>";
	echo "</tr>";
	
	//query 1 gets the university information and query 2 gets the university offered courses
	$query1 = "SELECT * FROM University u WHERE u.OfficialName = '" . $uni . "';"; 
	$query2 = "SELECT CourseCode, CourseName FROM OutsideCourse o INNER JOIN University u ON o.SchoolID = u.SchoolID WHERE u.OfficialName = '" . $uni . "';";

        $result1 = mysqli_query($connection,$query1);
	$result2 = mysqli_query($connection,$query2);

        if (!$result1 || !$result2) {
                die("databases query failed.");
        }

        $row = mysqli_fetch_assoc(($result1));
	
	//extract values from queries
        $uniID = $row["SchoolID"];
	$uniName = $row["OfficialName"];
	$uniCity = $row["City"];
	$uniProv = $row["Province"];
	$uniNickname = $row["Nickname"];
	
	echo "<h2> $uniName Courses </h2>";
 
        echo "School ID: " . $uniID . " School: " . $uniName . " Nickname: " . $uniNickname . " City: " . $uniCity . " Province: " . $uniProv;
	echo "<br><br>";

	while ($row = mysqli_fetch_assoc($result2)) {

		echo "<tr>";
		echo "<td>"; echo  $row["CourseCode"]; echo "</td>";
		echo "<td>"; echo  $row["CourseName"]; echo "</td>";
		echo "</tr>";
	}

	mysqli_free_result($result1);
	mysqli_free_result($result2);

	echo "</table>";
}

//if a province was selected get the universities that are located in that province
if($_POST["provinces"]){
	
	echo "<h2> Universities in the Province of $prov </h2>";
        echo "<table align= '" . center . "'>";
        echo "<tr>";
        echo "<th>University Name</th>";
        echo "<th>Nickname</th>";
        echo "</tr>";
		
	//query gets unies located in that province
        $query3 = "SELECT OfficialName, Nickname FROM University u WHERE u.Province = '" . $prov . "';";

	$result3 = mysqli_query($connection,$query3);

        if (!$result3) {
                die("databases query failed.");
        }

	//print out university names and nicknames
	while ($row = mysqli_fetch_assoc($result3)) {

                echo "<tr>";
                echo "<td>"; echo  $row["OfficialName"]; echo "</td>";
                echo "<td>"; echo  $row["Nickname"]; echo "</td>";
                echo "</tr>";
        }

        mysqli_free_result($result3);
	
	echo "</table>";
}

mysqli_close($connection);
?>

<br><br>

<input type="submit" onclick="back()" value="Go Back"><br>

</body>
</html>
