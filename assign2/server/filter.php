<!-- 
    File name: filter.php
    Author: Peiwen Liu
    Description: php file for filter function
-->
<?php
session_start();
// Connect to database
$host = 'localhost';
$dbname = 'web_assign2';
$username = 'postgres';
$password = '990515';

try {
    // Create a PDO connection to the database
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Construct the base SQL query for filtering products
    $sql = "SELECT * FROM products WHERE 1=1";
    // Add conditions based on filter parameters provided via GET request
    if (!empty($_GET['filterProductId'])) {
        $sql .= " AND product_id = :productId";
    }
    if (!empty($_GET['filterProductName'])) {
        $sql .= " AND product_name LIKE :productName";
    }
    if (isset($_GET['minQuantity']) && $_GET['minQuantity'] !== '') {
        $sql .= " AND quantity >= :minQuantity";
    }
    if (isset($_GET['maxQuantity']) && $_GET['maxQuantity'] !== '') {
        $sql .= " AND quantity <= :maxQuantity";
    }
    if (isset($_GET['minPrice']) && $_GET['minPrice'] !== '') {
        $sql .= " AND price >= :minPrice";
    }
    if (isset($_GET['maxPrice']) && $_GET['maxPrice'] !== '') {
        $sql .= " AND price <= :maxPrice";
    }
    if (isset($_GET['filterStockStatus']) && $_GET['filterStockStatus'] != 'all') {
        if ($_GET['filterStockStatus'] == 'inStock') {
            $sql .= " AND status = 'In Stock'";
        } elseif ($_GET['filterStockStatus'] == 'shipped') {
            $sql .= " AND status = 'Shipped'";
        }
    }

    // New conditions for filtering based on stock times
    if (isset($_GET['filterStockTimeStart']) && $_GET['filterStockTimeStart'] !== '') {
        $sql .= " AND inbound_date >= :filterStockTimeStart";
    }
    if (isset($_GET['filterStockTimeEnd']) && $_GET['filterStockTimeEnd'] !== '') {
        $sql .= " AND outbound_date <= :filterStockTimeEnd";
    }


    $stmt = $pdo->prepare($sql);

    // Binding existing parameters
    if (!empty($_GET['filterProductId'])) {
        $stmt->bindValue(':productId', $_GET['filterProductId']);
    }
    if (!empty($_GET['filterProductName'])) {
        $productName = "%" . $_GET['filterProductName'] . "%";
        $stmt->bindValue(':productName', $productName);
    }
    if (isset($_GET['minQuantity']) && $_GET['minQuantity'] !== '') {
        $stmt->bindValue(':minQuantity', $_GET['minQuantity'], PDO::PARAM_INT);
    }
    if (isset($_GET['maxQuantity']) && $_GET['maxQuantity'] !== '') {
        $stmt->bindValue(':maxQuantity', $_GET['maxQuantity'], PDO::PARAM_INT);
    }
    if (isset($_GET['minPrice']) && $_GET['minPrice'] !== '') {
        $stmt->bindValue(':minPrice', $_GET['minPrice']);
    }
    if (isset($_GET['maxPrice']) && $_GET['maxPrice'] !== '') {
        $stmt->bindValue(':maxPrice', $_GET['maxPrice']);
    }

    // New parameter bindings for stock times
    if (isset($_GET['filterStockTimeStart']) && $_GET['filterStockTimeStart'] !== '') {
        $stmt->bindValue(':filterStockTimeStart', $_GET['filterStockTimeStart']);
    }
    if (isset($_GET['filterStockTimeEnd']) && $_GET['filterStockTimeEnd'] !== '') {
        $stmt->bindValue(':filterStockTimeEnd', $_GET['filterStockTimeEnd']);
    }


    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['filteredResults'] = $results;
    header('Location: ../index.php'); // Ensure correct redirection to your index page
    exit;

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
