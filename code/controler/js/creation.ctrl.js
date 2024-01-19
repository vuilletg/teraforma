// Add an event listener to the form with id "inscription" when it is submitted
document.getElementById("inscription").addEventListener("submit", function (e) {
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

      // Log the response for debugging purposes
      console.log(this.response);
      console.log(this.response !== null);

      // Check if the response is not null
      if (this.response !== null) {
        // Check the success status in the response
        if (res.success == 0) {
          console.log("User registered successfully");
      
          // Stockage de la variable dans le localStorage
          localStorage.setItem('login', document.getElementById("login").value);

          // Redirection vers une nouvelle page
          window.location.href = "../view/pagePrincipaleEnseignant.html";

        } else {
          // Log and display error messages based on different cases
          console.log(res.msg.join("\n"));
          clearText();

          if (res.success == 2) {
            var elementCourant = document.getElementById("erreurMdp");
            elementCourant.textContent = res.msg;
            elementCourant.style.display = "block";

            document.getElementById("mdp").style.border = "solid 1.5px red";
            document.getElementById("mdpTxt").style.color = "red";
            document.getElementById("mdp2").style.border = "solid 1.5px red";
            document.getElementById("mdp2Txt").style.color = "red";

          } else if (res.success == 3) {
            var elementCourant = document.getElementById("erreurLogin");
            elementCourant.textContent = res.msg;
            elementCourant.style.display = "block";
            document.getElementById("login").style.border = "solid 1.5px red";
            document.getElementById("loginTxt").style.color = "red";

          } else if (res.success == 23) {
            var elementCourant = document.getElementById("erreurMdp");
            elementCourant.textContent = res.msg[0];
            elementCourant.style.display = "block";

            document.getElementById("mdp").style.border = "solid 1.5px red";
            document.getElementById("mdpTxt").style.color = "red";
            document.getElementById("mdp2").style.border = "solid 1.5px red";
            document.getElementById("mdp2Txt").style.color = "red";

            elementCourant = document.getElementById("erreurLogin");
            elementCourant.textContent = res.msg[1];
            elementCourant.style.display = "block";

            document.getElementById("login").style.border = "solid 1.5px red";
            document.getElementById("loginTxt").style.color = "red";

        } else if(res.success == 4){
            var elementCourant = document.getElementById("erreurMail");
            elementCourant.textContent = res.msg;
            elementCourant.style.display = "block";

            document.getElementById("mail").style.border = "solid 1.5px red";
            document.getElementById("mailTxt").style.color = "red";

        } else if(res.success == 24){
            var elementCourant = document.getElementById("erreurMdp");
            elementCourant.textContent = res.msg[0];
            elementCourant.style.display = "block";

            document.getElementById("mdp").style.border = "solid 1.5px red";
            document.getElementById("mdpTxt").style.color = "red";
            document.getElementById("mdp2").style.border = "solid 1.5px red";
            document.getElementById("mdp2Txt").style.color = "red";

            elementCourant = document.getElementById("erreurMail");
            elementCourant.textContent = res.msg[1];
            elementCourant.style.display = "block";

            document.getElementById("mail").style.border = "solid 1.5px red";
            document.getElementById("mailTxt").style.color = "red";
        }
        else if (res.success == 234){
            var elementCourant = document.getElementById("erreurMdp");
            elementCourant.textContent = res.msg[0];
            elementCourant.style.display = "block";

            document.getElementById("mdp").style.border = "solid 1.5px red";
            document.getElementById("mdpTxt").style.color = "red";
            document.getElementById("mdp2").style.border = "solid 1.5px red";
            document.getElementById("mdp2Txt").style.color = "red";

            elementCourant = document.getElementById("erreurLogin");
            elementCourant.textContent = res.msg[1];
            elementCourant.style.display = "block";

            document.getElementById("login").style.border = "solid 1.5px red";
            document.getElementById("loginTxt").style.color = "red";

            elementCourant = document.getElementById("erreurMail");
            elementCourant.textContent = res.msg[2];
            elementCourant.style.display = "block";

            document.getElementById("mail").style.border = "solid 1.5px red";
            document.getElementById("mailTxt").style.color = "red";
        }
        else if(res.success == 34){
            var elementCourant = document.getElementById("erreurLogin");
            elementCourant.textContent = res.msg[0];
            elementCourant.style.display = "block";
            document.getElementById("login").style.border = "solid 1.5px red";
            document.getElementById("loginTxt").style.color = "red";

            elementCourant = document.getElementById("erreurMail");
            elementCourant.textContent = res.msg[1];
            elementCourant.style.display = "block";
            document.getElementById("mail").style.border = "solid 1.5px red";
            document.getElementById("mailTxt").style.color = "red";
          } else if (res.success == 1) {
            var elementCourant = document.getElementById("erreurInput");
            elementCourant.textContent = res.msg;
            elementCourant.style.display = "block";
          } else if (res.success == 5) {
            var elementCourant = document.getElementById("erreurLogin");
            elementCourant.textContent = res.msg[0];
            elementCourant.style.display = "block";
            document.getElementById("login").style.border = "solid 1.5px red";
            document.getElementById("loginTxt").style.color = "red";
          } else {
            alert("An error occurred. Please try again.");
          }
        }
      } else {
        console.log("Error: Response is NULL");
      }
    } else if (this.readyState == 4) {
      console.log("An error occurred");
    }
  };

  // Configure and send the XMLHttpRequest to the server
  xhr.open("POST", "../model/creation.php", true);
  xhr.responseType = "json";
  xhr.send(data);

  // Log the end of the function
  console.log("End");

  // Prevent form submission
  return false;
});
