<!-- 
    File name: modify.php
    Author: Yanni Ye
    Description: This PHP script retrieves product information based on the provided ID, prepares the data for modification, and includes the HTML content from the modify_html.php file for displaying the modification form
-->
<?php
// Retrieve the ID parameter from the URL
$id = isset($_GET['id']) ? ($_GET['id']) : 0;

// Check if ID is valid
if($id == 0){
    header('Refresh:3;url=index.php');
    echo 'The information to be modified does not exist!';
    exit;
}

// Include database connection file
include_once 'public.php';

// Prepare and execute SQL query to retrieve product information, bind with id
$sql = "SELECT * FROM public.products WHERE product_id = :id"; 
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT); 
$stmt->execute(); 
$product_info = $stmt->fetch(PDO::FETCH_ASSOC); 

// Include the HTML content for displaying the modification form
include_once 'modify_html.php';

