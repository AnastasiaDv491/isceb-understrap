var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab


function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");


    console.log(x);


    for (let index = 0; index < x.length; index++) {
        if (index != n) {
            var inputFieldsInCurrentTab = x[index].getElementsByTagName('input');

            for (let indexFields = 0; indexFields < inputFieldsInCurrentTab.length; indexFields++) {
                inputFieldsInCurrentTab[indexFields].type = "hidden";

            }

            var selectFieldsInCurrentTab = x[index].getElementsByTagName('select');
            console.log(selectFieldsInCurrentTab);

            for (let indexSelectFields = 0; indexSelectFields < selectFieldsInCurrentTab.length; indexSelectFields++) {
                selectFieldsInCurrentTab[indexSelectFields].disabled = "disabled";

            }
        }
        else{
            var inputFieldsInCurrentTab = x[index].getElementsByTagName('input');

            for (let indexFields = 0; indexFields < inputFieldsInCurrentTab.length; indexFields++) {
                inputFieldsInCurrentTab[indexFields].type = "visible";

            }

            var selectFieldsInCurrentTab = x[index].getElementsByTagName('select');
            console.log(selectFieldsInCurrentTab);

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

function disableInputAndSelectFieldsInAllTabsExceptCurren(){

}