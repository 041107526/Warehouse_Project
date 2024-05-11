<!-- 
    File name: update.php
    Author: Yanni Ye
    Description: php file for modify function
-->
<?php
// Retrieve data from the POST request
$id = isset($_POST['id']) ? ($_POST['id']) : 0;
$productId = isset($_POST['productId']) ? ($_POST['productId']) : 0;
$productName = isset($_POST['productName']) ? trim($_POST['productName']) : 'noName';
$productAmount = isset($_POST['productAmount']) ? $_POST['productAmount'] : -1;
$productPrice = isset($_POST['productPrice']) ? ($_POST['productPrice']) : -1;
$stockStatus = isset($_POST['modifyStockStatus']) ? trim($_POST['modifyStockStatus']) : 'In Stock';
$stockInTime = isset($_POST['stockInTime']) ? $_POST['stockInTime'] : '0000-00-00';
$stockOutTime = isset($_POST['stockOutTime']) ? $_POST['stockOutTime'] : null;

// Check if required fields are empty
if (empty($productId) || empty($productName) || empty($productAmount) || empty($productPrice) || empty($stockInTime)) {
    header('Refresh:3;url=../index.php');
    exit ('Please fill in all required fields.');
}
// Include database connection file
include_once 'public.php';

// SQL query to update product information
$sql = "UPDATE public.products SET 
        product_id = :productId,
        product_name = :productName,
        quantity = :productAmount,
        price = :productPrice,
        status = :stockStatus,
        inbound_date = :stockInTime,
        outbound_date = :stockOutTime
        WHERE product_id = :id";

// Prepare the SQL statement
$stmt = $pdo->prepare($sql);

// Bind parameters to the statement
$stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
$stmt->bindParam(':productAmount', $productAmount, PDO::PARAM_INT);
$stmt->bindParam(':productPrice', $productPrice, PDO::PARAM_STR);
$stmt->bindParam(':stockStatus', $stockStatus, PDO::PARAM_STR);
$stmt->bindParam(':stockInTime', $stockInTime, PDO::PARAM_STR);
// Bind stockOutTime parameter based on its value
if ($stockOutTime === "") {
    $stmt->bindValue(':stockOutTime', null, PDO::PARAM_NULL);
} else {
    $stmt->bindParam(':stockOutTime', $stockOutTime, PDO::PARAM_STR);
}
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the SQL statement
$stmt->execute();

// Redirect after 3 seconds and display success message
header('Refresh:3;url=../index.php');
exit ('Product information modified successfully!');
?>