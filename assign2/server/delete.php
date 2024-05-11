<!-- 
    File name: delete.php
    Author: Yi Yao
    Description: php file for delete function
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style_index.css">
    <!-- Styling for the modal dialog -->
    <style>
        .modal {
            display: block;
        }
    </style>
    <script src="../js/test.js" defer></script>
</head>

<body>
    <?php 
    // require the database connection file
    require_once 'public.php';
    // Check if 'id' parameter is set in the URL
    if(!isset($_GET['id'])) {
        header("Location: index.php");
    }
    $id = $_GET['id'];
    // Retrieve product information based on the product ID
    $sql = "SELECT * FROM public.products WHERE product_id = '$id'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Process form submission for product deletion
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "DELETE FROM public.products WHERE product_id = '$id'";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        // Redirect after successful deletion
        if ($result) {
            header('Refresh:2;url=../index.php');
            exit ('Product information deleted successfully!');
        } else {
            echo 'Error deleting product!';
        }

    } else {
        // Display product details 
        $sql = "SELECT * FROM public.products WHERE product_id = '$id'";
    }

    ?>

    <!-- Delete confirmation window -->
    <div id="deleteModal" class="modal">
        <div class="modal-content" id="delete-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <h2>Confirm Delete</h2>
            <p>Are you sure you want to delete this product: <?php echo $row['product_name'] ?>?</p>
            <form id="deleteForm" action="delete.php?id=<?php echo $id ?>" method="POST">
                <div class="buttons">
                    <button type="submit" id="saveDelete">DELETE</button>
                    <button type="button" onclick="cancelDeleteChanges()" id="cancelDelete">CANCEL</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>






