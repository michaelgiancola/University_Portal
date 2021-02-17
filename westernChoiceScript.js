//Confirmation, warning, or failure functions after manipulating an existing western course and the back button function

//called when back button is clicked on page and brings you back to main page
function back(){
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

//back to main page when edit is successful and message
function courseInfoChange(){
        alert("The course information has been successfully editted.");
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

//back to main page when a western course is not selected to be manipulated (back to main page)
function failed(){
        alert("A Western course was not selected.");
        window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
}

//warning message that western course selected to be deleted has equvalent courses (if okay do the delete if cancel go back to main page)
function deleteConfirmationEquiv(){

        if (confirm("This course has equivalent courses to other Universities. Are you sure you want to delete this course?")){
                document.getElementById("deleteForm").submit();
        }

        else {
                window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
        }
}

//warning message that western course selected to be deleted has no equivalents (if okay do the delete if cancel go back to main page)
function deleteConfirmation(){

        if (confirm("Are you sure you want to delete this course?")){
                document.getElementById("deleteForm").submit();
        }

        else {
                window.location = 'http://cs3319.gaul.csd.uwo.ca/vm071/a3joseph/indexpage.php';
        }
}

