//these functions are used on the main page for validation of inputs and course sorting

//sorts Western Courses by Course Number or Name depending on which column heading is clicked
//toggling switches from ascending to descending order
//column number is the parameter for the function
//reference: https://www.w3schools.com/howto/howto_js_sort_table.asp
function sort(column) {
  var myTable, rows, switching, i, x, y, shouldSwitch, order, switchcount = 0;
  myTable = document.getElementById("courseTable");
  switching = true;

  //Set the sorting direction to ascending:
  order = "asc";

 //loop until no switching occurs
  while (switching) {
    
    switching = false;
    rows = myTable.rows;

    //Loop through the table rows skipping the column heading row
    for (i = 1; i < (rows.length - 1); i++) {
      
      shouldSwitch = false;

     //get two column values fro the appropriate column
      x = rows[i].getElementsByTagName("TD")[column];
      y = rows[i + 1].getElementsByTagName("TD")[column];

      //swap the rows depending on the specified order (indicate by switching variable)
      if (order == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
   
          shouldSwitch= true;
          break;
        }
      } else if (order == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {

      //if a switch is needed then do it and add to count
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      
      switchcount ++;
    }

    else {

     //swap the order type if no switching has been done with current direction
      if (switchcount == 0 && order == "asc") {
        order = "desc";
        switching = true;
      }
    }
  }
}

//change the placeholder in the edit textbox to whatever is selected for a better GUI 
function placeHold(){
    document.getElementById("editbox").placeholder = document.getElementById("edit").value;
}

//validate the date entry to ensure a date was selected before searching for the info or else do not let form submit
function validateDateEntry(){

        var dateBox = document.getElementById("dates");

        if(dateBox.value == "ChooseOne"){
                {alert("Select what date you would like to search."); return false;}
        }

        return true;
}

//validate edit entry before searching for the info or else prevent submit from occuring
function validateEditEntry(){

        var editBox = document.getElementById("edit");
        var theEdit = document.getElementById("editbox");

        if(editBox.value == "ChooseOne"){
                {alert("Select what field you would like to edit."); return event.preventDefault();}
        }

        if(editBox.value == "CourseName"){
		if(theEdit.value == ""){alert("Please fill in the edit box."); return event.preventDefault();}

                if(theEdit.value.length > 50){alert("The course name cannot be more than 50 characters long."); return event.preventDefault();}
        }

        if(editBox.value == "Weight"){
		if(theEdit.value == ""){alert("Please fill in the edit box."); return event.preventDefault();}

                if(theEdit.value != 0.5 && theEdit.value != 1 && theEdit.value != 1.0){alert("The weight must be 0.5 or 1."); return event.preventDefault();}
        }

        if(editBox.value == "Suffix"){
                if(theEdit.value.length > 3){alert("The suffix cannot be more than 3 characters long."); return event.preventDefault();}
        }
}

//validate enter Western Course information so that it meets requirments or else do not let user proceed (do not submit form)
function validateEntry(){
        var courseNumber = document.forms["enterWesternCourseForm"]["coursenumber"].value;
        var courseName = document.forms["enterWesternCourseForm"]["coursename"].value;
        var weight = document.forms["enterWesternCourseForm"]["weight"].value;
        var suffix = document.forms["enterWesternCourseForm"]["suffix"].value;

        if(courseNumber == "" || courseName == "" || weight == ""){alert("Course Number, Course Name, and Weight must all be filled."); return false;}

        if(courseNumber.startsWith("cs") == false){alert("The course number must start with cs."); return false;}

        if(courseNumber.length != 6){alert("The course number must be 6 characters long."); return false;}

        if(courseName.length > 50){alert("The course name cannot be more than 50 characters long."); return false;}

        if(weight != 0.5 && weight != 1 && weight != 1.0){alert("The weight must be 0.5 or 1."); return false;}

        if(suffix.length > 3){alert("The suffix cannot be more than 3 characters long."); return false;}

        return true;
}

