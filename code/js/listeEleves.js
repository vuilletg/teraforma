  function allowDrop(event) {
    event.preventDefault();
  }
  
  function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
  }
var data, draggedElement, cible;
console.log(data + " : " + draggedElement);

  function drop(event) {
    event.preventDefault();
    data = event.dataTransfer.getData("text");
    draggedElement = document.getElementById(data);
    cible = event.target;


    if (verifGroupes(event, draggedElement) && event.target.classList.contains("blank")) {
      if(cible.getAttribute('id') == "poubelle"){
        openPopup();  
      } else {
        modification();
      }
    }
  }  

  function verifGroupes(event, draggedElement){
    if(draggedElement.classList.contains("groupe") && event.target.classList.contains("groupe")){
      alert("Attention, vous ne pouvez pas insérer un groupe dans un autre groupe.");    
      return false;
    }
    return true;
  }


// Ouvertures pop up
function openPopup() {
    document.getElementById('popupContent').innerHTML = "Voulez vous vraiment supprimer " + draggedElement.getAttribute('id') + " ?";
    document.getElementById('myPopup').style.display = 'block';
}

function modification() {
    if (cible.firstChild) {
      cible.removeChild(cible.firstChild);
    }
    cible.appendChild(draggedElement);

    fermeturePopup();
}

function fermeturePopup(){
  document.getElementById('myPopup').style.display = 'none';
}