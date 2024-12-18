<?php
include 'db.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

try {
    $stmt = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM products LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = $pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

    echo json_encode([
        'products' => $products,
        'total' => $total
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
