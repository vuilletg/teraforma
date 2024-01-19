// Initialize Three.js components
let scene;
let camera;
let renderer;

// Main function
function main() {
  // Get the right div and canvas elements from the DOM
  const rightDiv = document.querySelector(".right");
  const canvas = document.querySelector("#c");

  // Create a new Three.js scene
  scene = new THREE.Scene();

  // Create a perspective camera with specified parameters
  camera = new THREE.PerspectiveCamera(
    45,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
  );
  camera.position.z = 2;
  scene.add(camera);

  // Create a WebGL renderer with antialiasing
  renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true });
  renderer.setSize(rightDiv.clientWidth, rightDiv.clientHeight);
  renderer.setPixelRatio(window.devicePixelRatio);

  // Configure renderer properties
  renderer.autoClear = false;
  renderer.setClearColor(0x000000, 0.0);

  // Create a sphere geometry for the Earth
  const earthgeometry = new THREE.SphereGeometry(0.6, 32, 32);

  // Create a Phong material for the Earth with texture and bump map
  const earthmaterial = new THREE.MeshPhongMaterial({
    roughness: 1,
    metalness: 0,
    map: new THREE.TextureLoader().load("../img/earthmap1k.jpg"),
    bumpMap: new THREE.TextureLoader().load("../img/earthbump.jpg"),
    bumpScale: 0.3,
  });

  // Create a mesh for the Earth using the geometry and material
  const earthmesh = new THREE.Mesh(earthgeometry, earthmaterial);
  scene.add(earthmesh);

  // Create an ambient light
  const ambientlight = new THREE.AmbientLight(0xffffff, 1);
  scene.add(ambientlight);

  // Create a point light
  const pointerlight = new THREE.PointLight(0xffffff, 0.9);
  pointerlight.position.set(5, 3, 5);
  scene.add(pointerlight);

  // Create a sphere geometry for clouds
  const cloudgeometry = new THREE.SphereGeometry(0.63, 32, 32);

  // Create a Phong material for clouds with a transparent texture
  const cloudmaterial = new THREE.MeshPhongMaterial({
    map: new THREE.TextureLoader().load("../img/earthCloud.png"),
    transparent: true,
  });

  // Create a mesh for clouds using the geometry and material
  const cloudmesh = new THREE.Mesh(cloudgeometry, cloudmaterial);
  scene.add(cloudmesh);

  // Create a large sphere for the background stars
  const stargeometry = new THREE.SphereGeometry(80, 64, 64);

  // Create a basic material for the stars with a galaxy texture on the back side
  const starmaterial = new THREE.MeshBasicMaterial({
    map: new THREE.TextureLoader().load("../img/galaxy.png"),
    side: THREE.BackSide,
  });

  // Create a mesh for the stars using the geometry and material
  const starmesh = new THREE.Mesh(stargeometry, starmaterial);
  scene.add(starmesh);

  // Animation function
  const animate = () => {
    requestAnimationFrame(animate);

    // Update the size of the renderer if the window size changes
    if (
      rightDiv.clientWidth !== window.innerWidth ||
      rightDiv.clientHeight !== window.innerHeight
    ) {
      camera.aspect = rightDiv.clientWidth / rightDiv.clientHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(rightDiv.clientWidth, rightDiv.clientHeight);
    }

    // Rotate the Earth, clouds, and stars for animation
    earthmesh.rotation.y -= 0.0015;
    cloudmesh.rotation.y -= 0.0019;
    starmesh.rotation.y += 0.0001;

    // Render the scene
    render();
  };

  // Render function
  const render = () => {
    renderer.render(scene, camera);
  };

  // Start the animation loop after the page is loaded
  animate();
}

function showForgotPasswordModal() {
  document.getElementById('forgotPasswordModal').style.display = 'block';
}

function closeForgotPasswordModal() {
  document.getElementById('forgotPasswordModal').style.display = 'none';
}

function sendPasswordRecoveryEmail() {
  const email = document.getElementById('email').value;

  // Simulez l'envoi de l'e-mail (c'est ici que vous connecteriez au backend)
  console.log(`E-mail de récupération envoyé à ${email}`);

  // Fermez la boîte de dialogue modale
  closeForgotPasswordModal();
}

// Call the main function when the window is fully loaded
window.onload = main;
