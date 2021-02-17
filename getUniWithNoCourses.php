<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>University Portal</title>
</head>
<body>

<!--- link to css file --->
<link rel="stylesheet" href="style.css">

<script>
<!--- this function sends user back to home page when they click the back button --->
function back(){
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

</script>

<h2>Universities With No Courses Offered</h2>

<!--- creates a table to show the Universities without courses offered --->
<table align="center">
<tr>
<th>University Name</th>
<th>Nickname</th>
</tr>

<?php
	include 'connectdb.php';

	//get all universities with no courses offered
        $query = "SELECT OfficialName, Nickname FROM University WHERE OfficialName NOT IN (SELECT OfficialName FROM University u INNER JOIN OutsideCourse o ON u.SchoolID = o.SchoolID)";
        
	$result = mysqli_query($connection,$query);

        if (!$result) {
                die("databases query failed.");
        }

        $row = mysqli_fetch_assoc(($result));
	
	//print out the universitys' name and nickname
        while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>";
                echo "<td>"; echo  $row["OfficialName"]; echo "</td>";
                echo "<td>"; echo  $row["Nickname"]; echo "</td>";
                echo "</tr>";
        }

        mysqli_free_result($result);
?>

</table>

<br><br>

<input type="submit" onclick="back()" value="Go Back"><br>

</body>
</html>
