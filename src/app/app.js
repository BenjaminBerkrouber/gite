// JavaScript
const carousel = document.querySelector('.testimonial-carousel');
const items = document.querySelectorAll('.testimonial-item');

let currentPosition = 0;
const scrollSpeed = 0.5; // Modifier la valeur pour ajuster la vitesse de défilement (plus la valeur est élevée, plus le défilement est rapide)

function scrollCarousel() {
    currentPosition -= scrollSpeed;
    carousel.style.transform = `translateX(${currentPosition}px)`;

    if (currentPosition <= -(items.length * (items[0].offsetWidth + 20))) {
        currentPosition = 0;
        carousel.style.transform = `translateX(${currentPosition}px)`;
    }

    requestAnimationFrame(scrollCarousel);
}

scrollCarousel();

// JavaScript
function initMap() {
    // Coordonnées de l'adresse du gîte
    const latLng = [46.39205037513505, -0.7113108384502373]; // Remplacez les coordonnées par celles de votre adresse

    // Création de la carte
    const map = L.map('map').setView(latLng, 12);

    // Ajout de la couche de tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);

    // Ajout du marqueur à l'adresse du gîte
    L.marker(latLng).addTo(map);
}

// Appel de la fonction pour initialiser la carte
initMap();




