<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Charge l'autoload de Composer

use Faker\Factory;

// Connexion à la base de données
$host = 'localhost';
$dbname = 'site';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $faker = Factory::create();

    // Insérer des données factices
    for ($i = 0; $i < 500; $i++) { 
        $name = $faker->words(3, true); 
        $description = $faker->sentence(10);
        $price = $faker->randomFloat(2, 5, 500); // Prix entre 5 et 500
        $image_url = 'assets/images/' . $faker->word() . '.png'; 
        $category = $faker->randomElement(['Vestes', 'Gilets', 'Enfants', 'Accessoires']); 

        // Préparer la requête d'insertion
        $sql = "INSERT INTO `products` (`category`, `name`, `description`, `price`, `image_url`) 
                VALUES (:category, :name, :description, :price, :image_url)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':category' => $category,  
            ':name' => $name,         
            ':description' => $description, 
            ':price' => $price,        
            ':image_url' => $image_url, 
        ]);
    }

    echo "500 produits générés avec succès dans la base de données.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
