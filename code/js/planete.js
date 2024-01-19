// Variables
let camera, scene, renderer, planet;
console.log('verif');
// Initialization
function init() {
  // Scene
  scene = new THREE.Scene();

  // Camera
  camera = new THREE.PerspectiveCamera(
    75,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
  );
  camera.position.z = 3;

  // Button eyes and help
  const toggleButton_eyes = createButton("absolute", "10px", "10px");
  const toggleButton_help = createButton("absolute", "10px", "60px");

  // Image
  const image_eyes = createImage(
    "../img/visibility_FILL0_wght400_GRAD0_opsz24.png",
    "15px",
    "15px"
  );
  const image_help = createImage("../img/help_icon.png", "15px", "15px");

  // Add images to buttons
  toggleButton_eyes.appendChild(image_eyes);
  toggleButton_help.appendChild(image_help);

  // Add buttons to the document body
  document.body.appendChild(toggleButton_eyes);
  document.body.appendChild(toggleButton_help);

  // Event listeners for the toggle buttons
  toggleButton_eyes.addEventListener("click", togglePlanetVisibility);
  toggleButton_help.addEventListener("click", toggleHelpPopUp);

  // Toggle planet visibility function
  function togglePlanetVisibility() {
    planet.visible = !planet.visible;

    // Change the image of the button based on planet visibility
    image_eyes.src = planet.visible
      ? "../img/visibility_FILL0_wght400_GRAD0_opsz24.png"
      : "../img/visibility_off_FILL0_wght400_GRAD0_opsz24.png";
  }

  let popUp = null;

  // Toggle help pop-up function
  function toggleHelpPopUp() {
    // Check if the window is active
    if (document.hasFocus()) {
      // Check if the pop-up exists
      if (popUp) {
        // Pop-up exists, remove it
        document.body.removeChild(popUp);
        popUp = null; // Reset the reference
      } else {
        // Pop-up does not exist, create it
        popUp = createHelpPopUp();
        // Add the pop-up to the document body
        document.body.appendChild(popUp);
      }
    }
  }

  // Renderer
  renderer = new THREE.WebGLRenderer();
  renderer.setSize(window.innerWidth, window.innerHeight);
  document.body.appendChild(renderer.domElement);

  // Create the sphere (planet)
  const geometry = new THREE.SphereGeometry(1.5, 25, 25);

  // Load the texture
  const texture_planete = new THREE.TextureLoader().load("../img/atlas.jpg");

  // Create the material with the texture
  const material = new THREE.MeshBasicMaterial({ map: texture_planete });

  // Create the planet using the geometry and material
  planet = new THREE.Mesh(geometry, material);

  // Add the planet to the scene
  scene.add(planet);

  // Créez le chargeur GLTFLoader
  const modelLoader = new GLTFLoader();

  // Chargez le modèle 3D (ajustez le chemin vers votre modèle)
  modelLoader.load(
    "../asset/models/scene.gltf",
    (gltf) => {
      // Ajustez l'échelle, la position et la rotation du modèle chargé
      const model = gltf.scene;
      model.scale.set(0.1, 0.1, 0.1); // Ajustez l'échelle selon vos besoins
      model.position.set(1, 1, 1); // Ajustez la position selon vos besoins
      model.rotation.set(0, Math.PI, 0); // Ajustez la rotation selon vos besoins

      // Ajoutez le modèle à la planète
      planet.add(model);
    },
    undefined,
    (error) => {
      console.error("Erreur lors du chargement du modèle 3D", error);
    }
  );

  // Event listener for click
  document.addEventListener("click", onDocumentClick, false);

  // Animation
  animate();

  // Déclarez une variable pour suivre l'état du menu
  let isMenuActive = false;

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

    if (intersects.length > 0) {
      // Si le menu est déjà actif, masquez-le, sinon affichez-le
      /*isMenuActive
        ? (menu.style.display = "none") 
        : (menu.style.display = "block");*/
      if(isMenuActive){
        menu.classList.remove('visible');
        menu.classList.add('invisible');
      } else {
        menu.classList.remove('invisible');
        menu.classList.add('visible');
      }
      // Inversez l'état du menu
      isMenuActive = !isMenuActive;
    } else if (!menu.contains(event.target) && isMenuActive) {
      // Masquez le menu si vous cliquez en dehors de l'objet et du menu lorsque le menu est actif
      //menu.style.display = "none";
      menu.classList.remove('visible');
      menu.classList.add('invisible');
      isMenuActive = false; // Réinitialisez l'état du menu
    }
  }
}

// Create event listener to prevent hiding the menu when clicking on the planet
document
  .getElementById("menu-planete")
  .addEventListener("click", function (event) {
    event.stopPropagation();
  });

// Create event listener to hide the menu when clicking outside of it
document.addEventListener("click", function (event) {
  const menu = document.getElementById("menu-planete");
  if (!menu.contains(event.target)) {
    //menu.style.display = "none";
    menu.classList.remove('visible');
    menu.classList.add('invisible');
  }
});

// Animation function
function animate() {
  requestAnimationFrame(animate);

  // Rotate the planet
  planet.rotation.y += 0.002;

  // Render the scene
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

// Start the application
init();

// Helper functions for creating elements
function createButton(position, bottom, right) {
  const button = document.createElement("button");
  button.style.position = position;
  button.style.bottom = bottom;
  button.style.right = right;
  return button;
}

function createImage(src, width, height) {
  const image = document.createElement("img");
  image.src = src;
  image.style.width = width;
  image.style.height = height;
  return image;
}

function createHelpPopUp() {
  const popUp = document.createElement("div");
  popUp.style.position = "fixed";
  popUp.style.top = "20%";
  popUp.style.left = "50%";
  popUp.style.transform = "translate(-50%, -50%)";
  popUp.style.backgroundColor = "#fff";
  popUp.style.border = "1px solid #ccc";
  popUp.style.padding = "20px";
  popUp.style.zIndex = "1000";

  // Add text to the pop-up
  const popUpText = document.createTextNode(
    "Bienvenue sur TerraForma ! Pour bien commencer clique sur la planete, tu verras apparaitre les différents thèmes que tu dois completer ! Bonne chance !"
  );
  popUp.appendChild(popUpText);

  return popUp;
}
