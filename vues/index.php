<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../assets/images/logo.png" alt="">
        </div> 
        <div class="navbar">
            <nav>
                <ul class="nav-links">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#A-propos">A-propos</a></li>
                    <li><a href="#Echarpes">Echarpes</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#promos">Promos</a></li>
                    <li><a href="#FAQ">FAQ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="container"> 
        <div class="hero">
           
        </div>
        <div class="ashley">
            <img src="../assets/images/promo.png" alt="Gallery Image 1">
            <img src="../assets/images/livraison.png" alt="Gallery Image 2">
            <img src="../assets/images/echarpe.png" alt="Gallery Image 3">
        </div>
    </div>

    <div class="center-text"><h6 class="section-title"> NOS PRÉFÉRÉS </h6></div>

    <!-- Slider -->
    <div class="slider-container">
        <div class="nav-arrow left" id="prev">&lt;</div>
        <div class="nav-arrow right" id="next">&gt;</div>

        <div class="slider-track" id="slider-track">
            <!-- Les produits seront ajoutés ici dynamiquement -->
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 MyWebsite. All rights reserved.</p>
    </footer>

    <script>
// Variables pour la pagination
let currentPage = 1;

// Fonction pour charger les produits
function loadProducts(page = 1) {
    fetch(`../backend/api.php?page=${page}`)
        .then(response => response.json())
        .then(data => {
            // Vérifiez si les données retournées sont correctes
            if (!data || !data.products) {
                console.error('Données incorrectes reçues:', data);
                return;
            }

            const sliderTrack = document.getElementById('slider-track');
            sliderTrack.innerHTML = ''; // Réinitialise les produits à chaque chargement

            // Parcours des produits
            data.products.forEach(product => {
                sliderTrack.innerHTML += `
                    <div class="product-card">
                        ${product.promo ? '<div class="promo-tag">Promo</div>' : ''}
                        <img src="${product.image_url}" alt="${product.name}">
                        <div class="quick-view">Aperçu rapide</div>
                        <p>
                            ${product.old_price ? `<del>${product.old_price}€</del>` : ''}
                            <span>${product.price}€</span>
                        </p>
                    </div>
                `;
            });

            // Gérer la pagination (optionnel)
            console.log('Pagination:', data.pagination);
        })
        .catch(error => console.error('Erreur de chargement des produits:', error));
}

// Fonction pour gérer la navigation dans le slider
function handleNavigation(direction) {
    if (direction === 'next') {
        currentPage++;
    } else if (direction === 'prev' && currentPage > 1) {
        currentPage--;
    }
    loadProducts(currentPage);
}

// Événements pour les flèches de navigation
document.getElementById('next').addEventListener('click', () => handleNavigation('next'));
document.getElementById('prev').addEventListener('click', () => handleNavigation('prev'));

// Charge les produits au démarrage
loadProducts(currentPage);

    </script>
</body>
</html>
