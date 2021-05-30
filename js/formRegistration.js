
//Inspiration: https://www.w3schools.com/howto/howto_js_form_steps.asp

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab


function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");

    for (let index = 0; index < x.length; index++) {
        if (index != n) {
            var inputFieldsInCurrentTab = x[index].getElementsByTagName('input');

            for (let indexFields = 0; indexFields < inputFieldsInCurrentTab.length; indexFields++) {
               inputFieldsInCurrentTab[indexFields].disabled = "disabled";

            }

            var selectFieldsInCurrentTab = x[index].getElementsByTagName('select');


            for (let indexSelectFields = 0; indexSelectFields < selectFieldsInCurrentTab.length; indexSelectFields++) {
                selectFieldsInCurrentTab[indexSelectFields].disabled = "disabled";

            }
        }
        else{
            //If it's the current page enable input fields
            var inputFieldsInCurrentTab = x[index].getElementsByTagName('input');

            for (let indexFields = 0; indexFields < inputFieldsInCurrentTab.length; indexFields++) {
                inputFieldsInCurrentTab[indexFields].disabled = "";

            }

            var selectFieldsInCurrentTab = x[index].getElementsByTagName('select');


            for (let indexSelectFields = 0; indexSelectFields < selectFieldsInCurrentTab.length; indexSelectFields++) {
                selectFieldsInCurrentTab[indexSelectFields].disabled = "";

            }
        }


    }


    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    //   fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");

    // // Exit the function if any field in the current tab is invalid:
    var form = document.forms["iscebRegistrationForm"];
    console.log(this);
    if ( n>0 && !form.reportValidity()) {return false};

    // console.log(currentTab);
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("iscebRegistrationForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

document.getElementById("password").addEventListener('input',passwordCheck);
document.getElementById("passwordConfirm").addEventListener('input',passwordCheck);
var form = document.forms["iscebRegistrationForm"];
function passwordCheck(input) {
    var passwordConfirmField = document.getElementById("passwordConfirm");
    var passwordField = document.getElementById('password');

    console.log(passwordField.value);
    console.log(passwordConfirmField.value);

    if (passwordConfirmField.value != passwordField.value) {
        input.target.setCustomValidity('Passwords Must be Matching.');
        if(passwordConfirmField.value != ""){
            input.target.reportValidity();
        }
        
        
    } else {
        // input is valid -- reset the error message
        passwordConfirmField.setCustomValidity('');
        passwordField.setCustomValidity('');
    }
}