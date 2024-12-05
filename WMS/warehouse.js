// Scene, camera en renderer
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

// Controleer of de renderer correct is ingesteld
if (!renderer) {
    console.error('Renderer is niet goed geïnitialiseerd.');
} else {
    console.log('Renderer werkt correct.');
}

// Licht
const light = new THREE.AmbientLight(0xffffff, 0.8);
scene.add(light);

// Camera positie
camera.position.set(0, 5, 10);

// Vloer
const floorGeometry = new THREE.PlaneGeometry(50, 50);
const floorMaterial = new THREE.MeshBasicMaterial({ color: 0x808080, side: THREE.DoubleSide });
const floor = new THREE.Mesh(floorGeometry, floorMaterial);
floor.rotation.x = Math.PI / 2;
scene.add(floor);

// Functie om een locatie met label te maken
const createLocation = (x, y, z, name) => {
    // Maak een kubus
    const geometry = new THREE.BoxGeometry(1, 1, 1);
    const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
    const cube = new THREE.Mesh(geometry, material);

    cube.position.set(x, y, z);
    scene.add(cube);

    // Label met naam van locatie
    const canvas = document.createElement('canvas');
    canvas.width = 256;
    canvas.height = 64;
    const context = canvas.getContext('2d');
    context.fillStyle = 'white';
    context.fillRect(0, 0, canvas.width, canvas.height);
    context.font = '20px Arial';
    context.fillStyle = 'black';
    context.fillText(name, 10, 40);

    const texture = new THREE.CanvasTexture(canvas);
    const labelMaterial = new THREE.SpriteMaterial({ map: texture });
    const sprite = new THREE.Sprite(labelMaterial);
    sprite.scale.set(3, 1, 1);
    sprite.position.set(x, y + 1, z);

    scene.add(sprite);
};

// Voeg een paar voorbeeldlocaties toe
createLocation(-5, 0.5, 0, "A1");
createLocation(0, 0.5, 0, "A2");
createLocation(5, 0.5, 0, "A3");

// OrbitControls toevoegen (voor het roteren van de camera)
const controls = new THREE.OrbitControls(camera, renderer.domElement);

// Renderloop
function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}
animate();

// Locaties ophalen via fetch
fetch('get_locations.php')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP-fout! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        data.forEach(item => {
            const { location, product_name, quantity } = item;
            const [x, y, z] = location.split(',').map(Number); // Locatie uit database
            createLocation(x, y, z, `${product_name} (${quantity})`);
        });
    })
    .catch(error => {
        console.error('Fout bij het ophalen van locaties:', error);
    });
