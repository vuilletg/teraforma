import * as THREE from "three";

import getStarfield from "./creationEtoiles.js";
import { OrbitControls } from "jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(
  75,
  window.innerWidth / window.innerHeight,
  0.1,
  1000
);
camera.position.z = 280;
camera.position.y = 120;

const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

function ajusterCaméraEtRendu() {
  var largeurFenetre = window.innerWidth;
  var hauteurFenetre = window.innerHeight;

  // Ajuster la caméra en fonction du nouveau rapport d'aspect
  camera.aspect = largeurFenetre / hauteurFenetre;
  camera.updateProjectionMatrix();

  // Ajuster la taille de rendu
  renderer.setSize(largeurFenetre, hauteurFenetre);
}

// Appeler la fonction pour ajuster la caméra et la taille de rendu au chargement de la page
ajusterCaméraEtRendu();

// Écouter l'événement de redimensionnement de la fenêtre
window.addEventListener("resize", function () {
  // Appeler la fonction pour ajuster la caméra et la taille de rendu lors du redimensionnement de la fenêtre
  ajusterCaméraEtRendu();
});

// Pour pouvoir faire tourner la planète
new OrbitControls(camera, renderer.domElement);

// Création étoiles
const stars = getStarfield({ numStars: 2000 });
scene.add(stars);

// Création zone cliquable
const spherePlanete = new THREE.SphereGeometry(90, 10, 10);
const material = new THREE.MeshBasicMaterial({
  color: 0xffffff,
});
const planet = new THREE.Mesh(spherePlanete, material);
scene.add(planet);

/**************************BTN-Help********************************* */
// Create a button element
const bottomRightButton = document.createElement("button");
bottomRightButton.id = "bottomRightButton"; // Set the button id
bottomRightButton.innerHTML = "Aide"; // Set the button text

// Style the button
bottomRightButton.style.position = "fixed";
bottomRightButton.style.bottom = "10px";
bottomRightButton.style.right = "10px";
bottomRightButton.style.padding = "10px";
bottomRightButton.style.backgroundColor = "#007bff";
bottomRightButton.style.color = "#fff";
bottomRightButton.style.border = "none";
bottomRightButton.style.borderRadius = "5px";
bottomRightButton.style.cursor = "pointer";

// Append the button to the body
document.body.appendChild(bottomRightButton);

// Add a click event listener to the button
// Function to open the help modal with pop animation
function openHelpModal() {
  const modal = document.getElementById("helpModal");
  modal.style.display = "block";
  modalContent.classList.add("pop");
}

// Function to close the help modal and remove pop class
function closeHelpModal() {
  const modal = document.getElementById("helpModal");
  modal.style.display = "none";
  modalContent.classList.remove("pop");
}

// Add a click event listener to the button
bottomRightButton.addEventListener("click", function () {
  // Display the help modal when the button is clicked
  openHelpModal();
});

// Add a click event listener to the close button in the modal
document.querySelector(".close").addEventListener("click", function () {
  // Close the help modal when the close button is clicked
  closeHelpModal();
});

// Add a click event listener to close the modal when clicking outside it
window.addEventListener("click", function (event) {
  const modal = document.getElementById("helpModal");
  if (event.target === modal) {
    closeHelpModal();
  }
});

/******************************************************************* */
//Instantiate a loader for the .gltf file
const loader = new GLTFLoader();
var object;
//Load the file
loader.load(
  `../img/planet/222.glb`,
  async function (gltf) {
    object = gltf.scene;
    scene.add(object);
    // Gérer le changement du curseur lors du survol de l'objet
    object.addEventListener("mouseover", function () {
      document.body.style.cursor = "pointer"; // Changer le curseur au survol
    });

    object.addEventListener("mouseout", function () {
      document.body.style.cursor = "auto"; // Revenir au curseur par défaut lorsque la souris quitte l'objet
    });
  },
  function (xhr) {
    //While it is loading, log the progress
    console.log((xhr.loaded / xhr.total) * 100 + "% loaded");
  },
  function (error) {
    //If there is an error, log it
    console.error(error);
  }
);
// Création satellite
const formeLune = new THREE.SphereGeometry(15, 8, 8);
const materialLune = new THREE.MeshBasicMaterial({
  map: new THREE.TextureLoader().load("../img/lune.jpg"),
});

const lune = new THREE.Mesh(formeLune, materialLune);
scene.add(lune);

const topLight = new THREE.DirectionalLight(0xffffff, 0.6); // (color, intensity)
topLight.position.set(500, 500, 500); //top-left
topLight.castShadow = true;
scene.add(topLight);

const ambientLight = new THREE.AmbientLight(0x333333, 1.2);
scene.add(ambientLight);
/************************************************************************* */
// Gestion ouverture menu
/*
let isMenuActive = false;
document.addEventListener("DOMContentLoaded", function () {
  // Attacher un gestionnaire d'événements au bouton
  var ouvrirMenu = document.getElementById("rondCurseur");
  ouvrirMenu.addEventListener("click", function () {
  const menu = document.getElementById("menu-planete");
  // Si le menu est déjà actif, masquez-le, sinon affichez-le
  if(isMenuActive){
    menu.classList.remove('visible');
    menu.classList.add('invisible');
  } else {
    menu.classList.remove('invisible');
    menu.classList.add('visible');
  }
  // Inversez l'état du menu
  isMenuActive = !isMenuActive;
  });
});*/
/*************************************************************** */
// Event listener for click
document.addEventListener("click", onDocumentClick, false);

// Déclarez une variable pour suivre l'état du menu
let isMenuActive = false;

// Click event handler
// Click event handler
function onDocumentClick(event) {
  const raycaster = new THREE.Raycaster();
  const mouse = new THREE.Vector2();

  // Calculate mouse position in normalized device coordinates
  mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
  mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

  // Update the picking ray with the camera and mouse position
  raycaster.setFromCamera(mouse, camera);

  // Check if the ray intersects with the planet
  const intersects = raycaster.intersectObject(planet);
  const menu = document.getElementById("menu-planete");

  // Vérifier si la popup d'aide est active
  const helpModal = document.getElementById("helpModal");
  const isHelpModalVisible = helpModal.style.display === "block";

  // Sélectionner tous les éléments avec la classe "barreProgression"
  var barreProgression = document.querySelectorAll(".barreProgression");

  if (intersects.length > 0 && !isHelpModalVisible) {
    // Si le menu est déjà actif, masquez-le, sinon affichez-le
    if (isMenuActive) {
      menu.classList.remove("visible");
      menu.classList.add("invisible");

      barreProgression.forEach(function (element) {
        element.classList.remove("apparition");
      });
    } else {
      menu.classList.remove("invisible");
      menu.classList.add("visible");

      barreProgression.forEach(function (element) {
        element.classList.add("apparition");
      });
    }
    // Inversez l'état du menu
    isMenuActive = !isMenuActive;
  } else if (!menu.contains(event.target) && isMenuActive) {
    // Masquez le menu si vous cliquez en dehors de l'objet et du menu lorsque le menu est actif
    menu.classList.remove("visible");
    menu.classList.add("invisible");
    isMenuActive = false; // Réinitialisez l'état du menu
  }
}

/************************************************* */
var r = 200;
var theta = 0;
var dTheta = (2 * Math.PI) / 10000;

// Appelle la fonction animate pour commencer l'animation.
animate();

// Fonction pour animer la scène.
function animate() {
  requestAnimationFrame(animate);
  theta += dTheta;
  lune.position.x = -r * Math.cos(theta);
  lune.position.z = r * Math.sin(theta);

  stars.rotation.y -= 0.0002;
  //planet.rotation.y += 0.001;
  object.rotation.y += 0.0003;
  renderer.render(scene, camera);
}
// Resize handling
function onWindowResize() {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
}

// Event listeners
window.addEventListener("resize", onWindowResize, false);
