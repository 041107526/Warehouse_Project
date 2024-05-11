<!-- 
    File name: modify_html.php
    Author: Yanni Ye
    Description: the srtucture of modify page
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
    <!-- import javascript file -->
    <script src="../js/test.js" defer></script>
</head>

<body>
    <!-- Modify Product Modal -->
    <div id="modifyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModifyModal()">&times;</span>
            <h2>Modify Product</h2>
            <!-- Form for modifying product information -->
            <form action="update.php" method="post" id="modifyForm">
                <div class="content">
                    <div class="left">
                        <!-- Hidden input field for product ID -->
                        <input type="hidden" name="id" value="<?php echo $product_info['product_id'] ?>">
                        <label for="modifyProductId">Product ID*</label>
                        <input type="text" id="modifyProductId" name="productId"
                            value="<?php echo isset($product_info['product_id']) ? trim($product_info['product_id']) : ''; ?>">
                        <label for="modifyProductName">Product Name*</label>
                        <input type="text" id="modifyProductName" name="productName"
                            value="<?php echo isset($product_info['product_name']) ? $product_info['product_name'] : ''; ?>">
                        <label for="modifyProductQuantity">Quantity*</label>
                        <input type="number" id="modifyProductQuantity" name="productAmount" step="any"
                            value="<?php echo isset($product_info['quantity']) ? $product_info['quantity'] : ''; ?>">
                        <label for="modifyProductAmount">Amount*</label>
                        <input type="number" id="modifyProductAmount" name="productPrice" step="any"
                            value="<?php echo isset($product_info['price']) ? $product_info['price'] : ''; ?>">
                    </div>
                    <div class="right">
                        <label>Status</label>
                        <!-- Dropdown for product status -->
                        <select id="modifyStockStatus" name="modifyStockStatus">
                            <option value="In Stock" <?php echo isset($product_info['status']) && $product_info['status'] == 'Shipped' ? 'selected' : ''; ?>
                                name="inStock">Inbound</option>
                            <option value="Shipped" <?php echo isset($product_info['status']) && $product_info['status'] == 'In Stock' ? 'selected' : ''; ?>
                                name="outOfStock">Shipped</option>
                        </select>
                        <label for="modifyStockInTime">Inbound Date*</label>
                        <input type="date" id="modifyStockInTime" name="stockInTime"
                            value="<?php echo isset($product_info['inbound_date']) ? $product_info['inbound_date'] : ''; ?>">
                        <label for="modifyStockOutTime">Outbound Date</label>
                        <input type="date" id="modifyStockOutTime" name="stockOutTime"
                            value="<?php echo isset($product_info['outbound_date']) ? $product_info['outbound_date'] : ''; ?>">
                    </div>
                </div>
                <div class="buttons">
                    <!-- Buttons for saving changes or canceling -->
                    <button type="submit" id="saveModify">SAVE CHANGES</button>
                    <button type="button" onclick="cancelModifyChanges()" id="cancelModify">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>