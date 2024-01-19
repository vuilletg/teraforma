document.addEventListener("DOMContentLoaded", function () {
  // Mélanger les propositions au chargement de la page
  shufflePropositions();
});

function shufflePropositions() {
  const propositionsContainer = document.getElementById("wordList");
  const propositions = Array.from(
    propositionsContainer.getElementsByClassName("draggable")
  );

  propositions.forEach(function (proposition) {
    propositionsContainer.removeChild(proposition);
  });

  shuffleArray(propositions);

  propositions.forEach(function (proposition, index) {
    proposition.setAttribute("data-position", index + 1);
    propositionsContainer.appendChild(proposition);
  });
}

function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
  event.preventDefault();
  const data = event.dataTransfer.getData("text");
  const draggedElement = document.getElementById(data);
  const draggedPosition = draggedElement.getAttribute("data-position");

  if (event.target.classList.contains("blank")) {
    if (event.target.firstChild) {
      event.target.removeChild(event.target.firstChild);
    }
    event.target.appendChild(draggedElement);

    // Set the data-position attribute on the dropped element
    event.target.firstChild.setAttribute("data-position", draggedPosition);
  }
}

function checkAnswer() {
  const blanks = document.querySelectorAll(".blank");

  blanks.forEach(function (blank) {
    const correctPosition = blank.id;
    const draggedElement = blank.firstChild;

    if (!draggedElement) {
      allCorrect = false;
      blank.style.border = "2px solid red";
    } else {
      const draggedPosition = draggedElement.getAttribute("data-position-correct");
      console.log(draggedPosition)

      if (draggedPosition !== correctPosition) {
        blank.style.border = "2px solid red";
      } else {
        blank.style.border = "2px solid green";
      }
    }
  });
}

function resetDragAndDrop() {
  shufflePropositions();
  document.getElementById("drop-container").innerHTML = "";
}

function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}
