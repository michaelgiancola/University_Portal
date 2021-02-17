<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>University Portal</title>
</head>
<body>

<link rel="stylesheet" href="style.css">

<!--- these scripts show confirmation or failure messages when called in the form of alerts and send user back to home page --->
<script>
function updated(){
	alert("The equivalency was updated with today's date.");
	window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

function added(){
	alert("The equivalency was added into the system");
	window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

function failed(){
	alert("Insert failed. Make sure to select both a Western course and Outside course for the equivalency.");
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/createEquiv.php';
}
</script>

<?php
	include 'connectdb.php';

	//the value sent from the form was two values so deconcatenate them so they can be used using the explode function
	$courseNumber = $_POST["westerncourses"];
	list($courseCode,$uni) = explode('#', $_POST["outsidecourseanduni"]);

	//check if the equivalency between the two courses exists 
	$query = "SELECT COUNT(CourseNumber) FROM IsEquivalentTo WHERE CourseNumber = '" . $courseNumber .  "' "." AND "." CourseCode =  '" . $courseCode . "' "." AND "." SchoolNickname = '" . $uni . "';";

        $result = mysqli_query($connection,$query);

        if (!$result) {
                die("databases query failed.");
        }

        $row = mysqli_fetch_assoc(($result));

        $existCheck = $row["COUNT(CourseNumber)"];

	mysqli_free_result($result);
	
	//if equivalency exists then update the date to todays date
        if($existCheck > 0){
		//update date to todays date
		$query1 = "UPDATE IsEquivalentTo SET Date = '" . date("Y-m-d") . "' WHERE CourseNumber= '" . $courseNumber . "' "." AND "." CourseCode = '" . $courseCode . "' "." AND "." SchoolNickname = '" . $uni . "';";

        	$result1 = mysqli_query($connection,$query1);

        	if (!$result1) {
                	die("databases query failed.");
        	}

        	echo "<script> updated(); </script>";
        }
	
	//if equivalency does not exist then insert all info into equivalency table
        if($existCheck == 0){
		//add equivalency into system
                $query2 = "INSERT INTO IsEquivalentTo values('" . $courseNumber . "', '" . $courseCode . "', '" . date("Y-m-d") . "', '" . $uni . "');";

                if (!mysqli_query($connection, $query2)) {
                        echo "<script> failed(); </script>";
                }
          
	  	else {echo "<script> added(); </script>";}
	}
	
	mysqli_close($connection);
?>
 
</body>
</html>
