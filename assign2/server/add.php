<!-- 
    File name: add.php
    Author: Yanni Ye
    Description: php file for add function
-->
<?php
// Retrieve data from the form using POST method
$productId = isset($_POST['productId']) ? $_POST['productId'] : 0;
$productName = isset($_POST['productName']) ? trim($_POST['productName']) : 'noName';
$productAmount = isset($_POST['productAmount']) ? $_POST['productAmount'] : -1;
$productPrice = isset($_POST['productPrice']) ? $_POST['productPrice'] : -1;
$stockStatus = isset($_POST['addStockStatus']) ? trim($_POST['addStockStatus']) : 'In Stock';
$stockInTime = isset($_POST['stockInTime']) ? $_POST['stockInTime'] : '0000-00-00';
$stockOutTime = isset($_POST['stockOutTime']) ? $_POST['stockOutTime'] : null;
// Check if required fields are empty
if(empty($productId) || empty($productName) || empty($productAmount) || empty($productPrice) || empty($stockInTime)){
    header('Refresh:3;url=index.php');
    exit('Please fill in all required fields.');
}
// Include the database connection file
include_once 'public.php';
// Prepare SQL statement for inserting data into the products table
$sql = "INSERT INTO public.products (product_id, product_name, quantity, price, status, inbound_date, outbound_date)
        VALUES (:productId, :productName, :productAmount, :productPrice, :stockStatus, :stockInTime, :stockOutTime)";

$stmt = $pdo->prepare($sql);
// Bind parameters to the SQL statement
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
$stmt->bindParam(':productAmount', $productAmount, PDO::PARAM_INT);
$stmt->bindParam(':productPrice', $productPrice, PDO::PARAM_STR);
$stmt->bindParam(':stockStatus', $stockStatus, PDO::PARAM_STR);
$stmt->bindParam(':stockInTime', $stockInTime, PDO::PARAM_STR);
if ($stockOutTime === "") {
    $stmt->bindValue(':stockOutTime', null, PDO::PARAM_NULL);
} else {
    $stmt->bindParam(':stockOutTime', $stockOutTime, PDO::PARAM_STR);
}
// Execute the SQL statement
$stmt->execute();
// Redirect the user after successful data insertion
header('Refresh:3;url=../index.php');
exit('Product information added successfully!');
?>