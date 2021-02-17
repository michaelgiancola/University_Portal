<?php
//shows the universities in the system in button form on the main page

	include 'connectdb.php';
	
	//get all universities in the databsase
	$query = "SELECT OfficialName, Province FROM University ORDER BY Province";

	$result = mysqli_query($connection,$query);

	if (!$result) {
    		die("databases query failed.");
	}

	//show all the universities in a table on the main page in button form
	while ($row = mysqli_fetch_assoc($result)) {

	echo "<tr>";
	echo "<td>"; echo '<input type="submit" name="universities" value= "'. $row["OfficialName"]. '">'; echo "</td>";
	echo "<td>"; echo '<input type="submit" name="provinces" value= "'. $row["Province"]. '">'; echo "</td>";
	echo "</tr>";

}
mysqli_free_result($result);

?>

