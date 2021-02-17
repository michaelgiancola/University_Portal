<?php

//if the user clicked on the delete course button then this block checks if there are equivalent courses to the selected Western Course
if ($_POST["deletecourse"]){

        $query = "SELECT COUNT(e.CourseNumber) FROM WesternCourse w INNER JOIN IsEquivalentTo e ON w.CourseNumber = e.CourseNumber WHERE w.CourseNumber= '" . $course . "';";
        $result = mysqli_query($connection,$query);

        if (!$result) {
                die("databases query failed.");
        }

        $row = mysqli_fetch_assoc(($result));

        $numberOfEquivalents = $row["COUNT(e.CourseNumber)"];

        //if equivalents exist for the selected western course call deleteConfirmationEquiv()
        if($numberOfEquivalents > 0){
                echo "<script> deleteConfirmationEquiv(); </script>";
        }
	
	//if no equivalents exist then call deleteConfirmation()
        if($numberOfEquivalents == 0){
                echo "<script> deleteConfirmation(); </script>";
        }

        mysqli_free_result($result);
}

?>

