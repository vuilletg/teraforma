import * as THREE from "three";

import getStarfield from "./creationEtoiles.js";
import { getFresnelMat } from "./getFresnelMat.js";
import { OrbitControls } from 'jsm/controls/OrbitControls.js';
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.z = 250;
camera.position.y = 80;

const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
const rightDiv = document.querySelector(".right");
rightDiv.appendChild(renderer.domElement);



function ajusterCaméraEtRendu() {
  var largeurFenetre = rightDiv.clientWidth;
  var hauteurFenetre = rightDiv.clientHeight;

  // Ajuster la caméra en fonction du nouveau rapport d'aspect
  camera.aspect = largeurFenetre / hauteurFenetre;
  camera.updateProjectionMatrix();

  // Ajuster la taille de rendu
  renderer.setSize(largeurFenetre, hauteurFenetre);
}
// Pour pouvoir faire tourner la planète
new OrbitControls(camera, renderer.domElement);

//Instantiate a loader for the .gltf file
const loader = new GLTFLoader();
var object1, object2, object3, object4;
// Créer un conteneur pour les objets
const container = new THREE.Object3D();
container.position.set(300, 0, 0);
scene.add(container);
container.rotation.set(180,0,0);

const ellipseGeometry = new THREE.EllipseCurve(
    0, 0,
    400, 400,
    0, 2 * Math.PI,
    false,
    0
  );
  
  const ellipsePath = new THREE.Path(ellipseGeometry.getPoints(100));
  const pathGeometry = new THREE.BufferGeometry().setFromPoints(ellipsePath.getPoints());
  const pathMaterial = new THREE.LineDashedMaterial({
    color: 0x7C7C7C, dashSize: 5, gapSize: 2
  });
  const path = new THREE.Line(pathGeometry, pathMaterial);
  path.computeLineDistances(); 
  container.add(path);
//Load the file
loader.load(
  `../img/planet/` + planeteAleatoire() + `.glb`, 
  function (gltf) {
    object1 = gltf.scene;
    scene.add(object1);
    object1.scale.set(0.60,0.60,0.60)
    object1.position.set(400, 0, 0);
    container.add(object1);
  }
);
loader.load(
  `../img/planet/` + planeteAleatoire() + `.glb`, 
  function (gltf) {
    object2 = gltf.scene;
    scene.add(object2);
    object2.scale.set(0.60,0.60,0.60)
    object2.position.set(0, 400, 0);
    container.add(object2);
  }
);
loader.load(
  `../img/planet/` + planeteAleatoire() + `.glb`, 
  function (gltf) {
    object3 = gltf.scene;
    scene.add(object3);
    object3.scale.set(0.60,0.60,0.60)
    object3.position.set(-400, 0, 0);
    container.add(object3);
  }
);
loader.load(
  `../img/planet/` + planeteAleatoire() + `.glb`, 
  function (gltf) {
    object4 = gltf.scene;
    scene.add(object4);
    object4.scale.set(0.60,0.60,0.60)
    object4.position.set(0, -400, 0);
    container.add(object4);
  }
);
const formeSoleil = new THREE.SphereGeometry(170, 30, 30);
const materialSoleil = new THREE.MeshBasicMaterial({ 
  map: new THREE.TextureLoader().load("../img/soleil.jpg")
});
const soleil = new THREE.Mesh(formeSoleil, materialSoleil);
container.add(soleil);

const fresnelMatSoleil = getFresnelMat({rimHex: 0xFC5010});
const glowMesh = new THREE.Mesh(formeSoleil, fresnelMatSoleil);
glowMesh.scale.setScalar(1.05);
container.add(glowMesh);

// Appeler la fonction pour ajuster la caméra et la taille de rendu au chargement de la page
ajusterCaméraEtRendu();

// Écouter l'événement de redimensionnement de la fenêtre
window.addEventListener('resize', function () {
  // Appeler la fonction pour ajuster la caméra et la taille de rendu lors du redimensionnement de la fenêtre
  ajusterCaméraEtRendu();
});


// Création étoiles
const stars = getStarfield({ numStars: 2000 });
scene.add(stars);

const topLight = new THREE.DirectionalLight(0xffffff, 0.6); // (color, intensity)
topLight.position.set(500, 500, 500); //top-left
topLight.castShadow = true;
scene.add(topLight);

const ambientLight = new THREE.AmbientLight(0x333333, 1.2);
scene.add(ambientLight);

/************************************************* */
// Fonction pour animer la scène.
function animate() {
  requestAnimationFrame(animate);
  container.rotation.z -= 0.001;

  stars.rotation.y -= 0.0002;
  object1.rotation.y += 0.0015;
  object2.rotation.x += 0.0015;
  object3.rotation.y += 0.0015;
  object4.rotation.x += 0.0015;
  renderer.render(scene, camera);
}
// Resize handling
function onWindowResize() {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
}

animate();

// Event listeners
window.addEventListener("resize", onWindowResize, false);

function planeteAleatoire() {
    const nombre1 = Math.floor(Math.random() * 3);
    const nombre2 = Math.floor(Math.random() * 3);
    const nombre3 = Math.floor(Math.random() * 3);
  
    return `${nombre1}${nombre2}${nombre3}`;
}