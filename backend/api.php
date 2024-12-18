<?php
include 'db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');


// Définir les paramètres de la pagination
$limit = 4;  // Nombre de produits par page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

try {

    $useMockData = false; // Change à `true` si tu veux simuler les données

    if (!$useMockData) {
        // Requête pour récupérer les produits de la base de données
        $query = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_ASSOC);

        // Requête pour compter le nombre total de produits
        $countQuery = $pdo->query("SELECT COUNT(*) AS total FROM products");
        $totalProducts = $countQuery->fetch(PDO::FETCH_ASSOC)['total'];
    } else {
        // Simuler des produits pour la démonstration
        $products = [
            [
                'name' => 'Produit 1',
                'image_url' => 'assets/images/image1.png',
                'price' => 17,
                'old_price' => 28.99,
                'promo' => true
            ],
            [
                'name' => 'Produit 2',
                'image_url' => 'assets/images/2.png',
                'price' => 16,
                'old_price' => 28.99,
                'promo' => false
            ],
            [
                'name' => 'Produit 3',
                'image_url' => 'assets/images/image3.png',
                'price' => 17,
                'old_price' => 28.99,
                'promo' => true
            ],
            [
                'name' => 'Produit 4',
                'image_url' => 'assets/images/image4.png',
                'price' => 30,
                'old_price' => 45.00,
                'promo' => true
            ],
            [
                'name' => 'Produit 5',
                'image_url' => 'assets/images/image1.png',
                'price' => 20,
                'old_price' => 32.99,
                'promo' => false
            ],
        ];

        $totalProducts = count($products);
        $products = array_slice($products, $offset, $limit);
    }

    // Calculer le nombre total de pages
    $totalPages = ceil($totalProducts / $limit);

    // Préparer la réponse JSON
    $response = [
        'products' => $products,
        'pagination' => [
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_products' => $totalProducts,
            'has_next' => $page < $totalPages,
            'has_previous' => $page > 1
        ]
    ];

    // Envoyer la réponse JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} catch (Exception $e) {
    // En cas d'erreur, retourner un message JSON
    http_response_code(500);
    echo json_encode(['error' => 'Erreur interne du serveur', 'message' => $e->getMessage()]);
}
?>
