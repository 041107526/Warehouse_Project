<!-- 
    File name: search.php
    Author: Peiwen Liu
    Description: php file for search function
-->
<?php
session_start();
// Conect to database
$host = 'localhost';
$dbname = 'web_assign2';
$username = 'postgres';
$password = '990515';

// Get the search query from the URL parameter 'query' or set it to empty string if not provided
$searchQuery = $_GET['query'] ?? '';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to search for products based on product name or product ID
    $sql = "SELECT * FROM products WHERE product_name LIKE :query OR product_id::text LIKE :query";
    $stmt = $pdo->prepare($sql);

    // Use % wildcards for partial matching
    $queryParam = '%' . $searchQuery . '%';
    $stmt->bindParam(':query', $queryParam, PDO::PARAM_STR);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Store results in session
    $_SESSION['filteredResults'] = $results;

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Redirect back to index.php
header('Location: ../index.php');
exit;
?>
