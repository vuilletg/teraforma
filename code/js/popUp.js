
var containers = document.querySelectorAll('[id^="container"]');

containers.forEach(function(container) {
    container.addEventListener('click', function(event) {
        var targetButton = event.target;
        if (targetButton.classList.contains('popup-button')) {
            event.preventDefault();
            var nomClasse = container.getAttribute('data-popup-content');
            openPopup(nomClasse, targetButton.classList[0]);
        }
    });
});

function openPopup(nomClasse, type) { 
    /* avec "type" on récupère modifier ou supprimer, voir plus tard pour ajouter un if type = supprimer alors ... sinon ...*/
    /* modifier pas vraiment important mais ça serait bien d'au moins faire supprimer*/
    document.getElementById('popupContent').innerHTML = "Voulez vous vraiment " + type + " la classe " + nomClasse + " ?";
    document.getElementById('myPopup').style.display = 'block';
}
function closePopup() {
    document.getElementById('myPopup').style.display = 'none';
}