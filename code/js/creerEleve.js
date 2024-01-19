// Add an event listener to the form with id "inscription" when it is submitted
document.getElementById("creerEleve").addEventListener("submit", function (e) {
    // Prevent the default form submission behavior
    e.preventDefault();
  
    // Create a FormData object from the form
    var data = new FormData(this);
  
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Function to clear all error messages
    function clearText() {
      var elements = document.getElementsByClassName("erreur");
      for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
      }
      document.getElementById("login").style.border = "black 1px solid";
      document.getElementById("mdp").style.border = "black 1px solid";
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
                    console.log("Joueur créer");

                    document.getElementById("login").value = "";
                    document.getElementById("mdp").value = "";
                    window.location.href = "../php/gestionGroupe.ctrl.php";

                }else if(res.success == 2){
                    var elements = document.getElementById("erreurMdp");
                    elements.style.display = "block";
                    elements.textContent = res.msg;

                    document.getElementById("mdp").style.border = "solid 1px red";
                    
                } else if(res.success == 1){
                    var elements = document.getElementById("erreurMdp");
                    elements.style.display = "block";
                    elements.textContent = res.msg;
                
                } else if(res.success == 3){
                    var elements = document.getElementById("erreurLogin");
                    elements.style.display = "block";
                    elements.textContent = res.msg;

                    document.getElementById("login").style.border = "solid 1px red";

                } else if(res.success == 23){
                    var elements = document.getElementById("erreurMdp");
                    elements.style.display = "block";
                    elements.textContent = res.msg[0];

                    document.getElementById("mdp").style.border = "solid 1px red";

                    elements = document.getElementById("erreurLogin");
                    elements.style.display = "block";
                    elements.textContent = res.msg[1];

                    document.getElementById("login").style.border = "solid 1px red";

                }else if (res.success == 4){
                    var elements = document.getElementById("erreurMdp");
                    elements.style.display = "block";
                    elements.textContent = res.msg[0];

                    document.getElementById("mdp").style.border = "solid 1px red";
                    document.getElementById("login").style.border = "solid 1px red";

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
 xhr.open("POST", "../php/creerEleve.ctrl.php", true);
 xhr.responseType = "json";
 xhr.send(data);

 // Log the end of the function
 console.log("End");

 // Prevent form submission
 return false;
});