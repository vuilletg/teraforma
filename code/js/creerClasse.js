// Add an event listener to the form with id "inscription" when it is submitted
document.getElementById("creerClasseForm").addEventListener("submit", function (e) {
    // Prevent the default form submission behavior
    e.preventDefault();
  
    // Create a FormData object from the form
    var data = new FormData(this);
  
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Get the element with id "msgErreur" for displaying error messages
    var msg = document.getElementById("msgErreur");
    // Function to clear all error messages
    function clearText() {
      var elements = document.getElementsByClassName("erreur");
      for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
      }
      elements = document.getElementsByClassName("erreurTxt");
      for(var j = 0; j < elements.length; j++){
        elements[j].style.color = "#3EA300";
      }
      elements = document.querySelectorAll('input:not([type="checkbox"])');
      for (var k = 0; k < elements.length; k++){
        elements[k].style.border = "1px solid #3EA300";
      }
    }

     // Set up a callback function to handle the XMLHttpRequest state changes
    xhr.onreadystatechange = function () {
        // Check if the request is complete and successful
        if (this.readyState == 4 && this.status == 200) {
            // Parse the response as JSON
            var res = this.response;
            clearText();
            console.log(this.response);

            if(this.response != null){
                if(res.success == 0){
                    console.log("Classe créer");
                    console.log(res.msg.join('\n'));

                    window.location.href = "../controler/php/gestionGroupe.ctrl.php";
                }else if(res.success == 2){
                    var elements = document.getElementById("erreurNb");
                    elements.style.display = "block";
                    elements.textContent = res.msg;

                    document.getElementById("nb").style.border = "solid 1px red";
                    document.getElementById("nbTxt").style.color = "red";
                    
                } else if(res.success == 1){
                    var elements = document.getElementById("erreurNb");
                    elements.style.display = "block";
                    elements.textContent = res.msg;
                
                } else if(res.success == 3){
                    var elements = document.getElementById("erreurName");
                    elements.style.display = "block";
                    elements.textContent = res.msg;

                    document.getElementById("name").style.border = "solid 1px red";
                    document.getElementById("nameTxt").style.color = "red";
                } else if(res.success == 23){
                    var elements = document.getElementById("erreurName");
                    elements.style.display = "block";
                    elements.textContent = res.msg[0];

                    document.getElementById("name").style.border = "solid 1px red";
                    document.getElementById("nameTxt").style.color = "red"

                    elements = document.getElementById("erreurNb");
                    elements.style.display = "block";
                    elements.textContent = res.msg[1];

                    document.getElementById("nb").style.border = "solid 1px red";
                    document.getElementById("nbTxt").style.color = "red";
                    
                }else if (res.success == 4){
                    document.getElementById("nb").style.border = "solid 1px red";
                    document.getElementById("nbTxt").style.color = "red";

                    document.getElementById("name").style.border = "solid 1px red";
                    document.getElementById("nameTxt").style.color = "red"

                    var elements = document.getElementById("erreurNb");
                    elements.style.display = "block";
                    elements.textContent = res.msg;
                }else if(res.success == 5){
                    console.log(res.msg);
                }else{
                    alert("An error occurred. Please try again.");
                }
            }else{
                console.log("Retour null");
            }
        }else if (this.readyState == 4){
            console.log("Une erreur est survenue");
        }
    }

 // Configure and send the XMLHttpRequest to the server
 xhr.open("POST", "../controler/php/creerClasse.ctrl.php", true);
 xhr.responseType = "json";
 xhr.send(data);

 // Log the end of the function
 console.log("End");

 // Prevent form submission
 return false;
});