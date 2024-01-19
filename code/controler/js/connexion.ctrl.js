document.getElementById("connexion").addEventListener("submit", function(e){
    e.preventDefault();
    
    var data = new FormData(this);

    var xhr = new XMLHttpRequest();

    function clearText(){
        console.log("ici");
        document.getElementById("erreur").style.display = "none";

        var elements = document.getElementsByClassName("erreurTxt");
        for(var j = 0; j < elements.length; j++){
        elements[j].style.color = "#3EA300";
        }

        elements = document.querySelectorAll('input');
        for(var i = 0; i<elements.length; i++){
            elements[i].style.border = "solid 1px #3EA300";
        }

    }

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var res = this.response;

            if(this.response !== null){
                if(res.success == 1){
                    console.log("Utilisateur connecté");

                    localStorage.setItem('login', document.getElementById("login").value);

                    window.location.href = "../view/pagePrincipaleEnseignant.html";

                }else if (res.success == 0){
                    console.log(res.msg.join('\n'));
                    var elements = document.getElementById("erreur");
                    elements.style.display = "block";
                    elements.textContent = res.msg;
                    elements = document.querySelectorAll('input:not([type="submit"])');
                    for(var i = 0; i<elements.length; i++){
                        elements[i].style.border = "solid 1px red";
                    }
                    elements = document.getElementsByClassName("erreurTxt");
                    for(var j = 0; j < elements.length; j++){
                    elements[j].style.color = "red";
                    }
                }else{
                    console.log(res.msg.join('\n'));
                    var elements = document.getElementById("erreur");
                    elements.style.display = "block";
                    elements.textContent = res.msg;
                }
            }else{
                console.log("La reponse obtenu est null");
            }
        }else if(this.readyState == 4){
            console.log("Une erreur est survenue");
        }
    }


    xhr.open("POST", "../controler/php/connexion.ctrl.php", true);
    xhr.responseType = "json";
    xhr.send(data);
    return false;
});