<!-- 
    File name: index.php
    Author: Yi Yao, Yanni Ye, Peiwen Liu
    Description: php file for index page
-->
<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Function page of this website"> 
    <meta name="author" content="">
    <title>WAREHOUSE | Product Registration & Management</title>

    <!-- Import javascript and css file -->
    <link rel="stylesheet" href="css/style_index.css">
    <script src="js/test.js" defer></script>
    <!-- The source of icons applied in this file -->
    <script src="https://kit.fontawesome.com/55c5047899.js" crossorigin="anonymous"></script> 
</head>
<body>
    <div id="headerDiv">
        <header>
            <!-- Header contains company name and navigation -->
            <h2>WAREHOUSE | Product Registration & Management</h2>
            <nav>
                <a href="html/home.html">Home Page</a>
                <a href="/services">
                    <i class="fa-regular fa-bell"></i>
                </a>
                <a href="/contact">
                    <i class="fa-regular fa-user"></i>
                </a>
            </nav>
        </header>
    </div>

    <main>
    <?php include_once('server/public.php') ?>

        <h2>Dashboard</h2>
        <!-- Connect to database to display dynamic data，PHP code is needed here -->
        <div class="grid-container">
            <div class="dashboard">
                <div class="data">
                    <!-- query from database and display the total value -->
                    <div>   
                        <?php
                        try {
                            $sql = "SELECT CAST(SUM(quantity*price)AS integer) AS total FROM public.products WHERE status='In Stock'";  
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $total = $result['total'];
                            echo "$$total";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Total Value</p>
                </div>
                <div class="data">
                    <!-- query from database and display the inbound data -->
                    <div>
                        <?php
                        try {
                            $sql = "SELECT SUM(quantity) AS inbound FROM public.products WHERE inbound_date BETWEEN '2024-03-01' AND '2024-03-31'";  
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $inbound = $result['inbound'];
                            echo $inbound;
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Inbound This Month</p>
                </div>
                <div class="data" id="outbound">
                    <!-- query from database and display the outbound data -->
                    <div>
                        <?php
                        try {
                            $sql = "SELECT SUM(quantity) AS outbound FROM public.products WHERE outbound_date BETWEEN '2024-03-01' AND '2024-03-31'";  
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $outbound = $result['outbound'];
                            echo $outbound;
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Outbound This Month</p>
                </div>
                <div class="data" id="utilizationRate">
                    <!-- query from database and display the shelf utilization rate -->
                    <div>
                        <?php
                        try {
                            $sql = "SELECT CAST((CAST(SUM(quantity) AS FLOAT) / 2000) * 100 AS NUMERIC(10,2)) AS rate FROM public.products WHERE status='In Stock'";  
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $rate = $result['rate'];
                            echo "$rate%";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Shelf Utilization Rate</p>
                </div>
            </div>

            <div class="rightside">
            <!-- query from database and display the category distribution percentages data -->
            <div id="categoryPercentage">
                    <p>Electronics</p>
                    <div>
                        <?php
                        try {
                            $sql = "SELECT ROUND(COUNT(*) * 100.0 / (SELECT COUNT(*) FROM public.products), 2) AS electronics FROM public.products WHERE product_id LIKE 'A%'";
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $electronics = $result['electronics'];
                            echo "$electronics%";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Smart home</p>
                    <div>
                        <?php
                        try {
                            $sql = "SELECT ROUND(COUNT(*) * 100.0 / (SELECT COUNT(*) FROM public.products), 2) AS smart_home FROM public.products WHERE product_id LIKE 'B%'";
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $smart_home = $result['smart_home'];
                            echo "$smart_home%";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Accessories</p>
                    <div>
                        <?php
                        try {
                            $sql = "SELECT ROUND(COUNT(*) * 100.0 / (SELECT COUNT(*) FROM public.products), 2) AS accessories FROM public.products WHERE product_id LIKE 'C%'";
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $accessories = $result['accessories'];
                            echo "$accessories%";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Category Distribution Percentages</p>
                </div>

                <!-- Average inventory days div -->
                <div id="averageDays">
                    <!-- query from database and display the shelf utilization average days of inventory -->
                    <div>
                        <?php
                        try {
                            $sql = "SELECT TRUNC(AVG((EXTRACT(epoch FROM CURRENT_TIMESTAMP) - EXTRACT(epoch FROM inbound_date)) / 86400)) AS average FROM public.products";  
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $average = $result['average'];
                            echo "$average Days";
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <p>Average days of inventory</p>
                </div>
            </div>

            <?php
            // start session
            session_start();

            try {
                // Initialize an empty array for results
                $results = [];

                if (isset($_SESSION['filteredResults']) && !empty($_SESSION['filteredResults'])) {
                    // If there are filtered results in the session, use them
                    $results = $_SESSION['filteredResults'];
                    // Optionally, you can unset the session variable if you don't want the filter to persist
                    // unset($_SESSION['filteredResults']);
                } else {
                    // If there are no filters applied, execute the default query
                    $sql = "SELECT * FROM public.products ORDER BY inbound_date ASC";
                    $stmt = $pdo->query($sql);
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
            <div class="container">
            <div class="buttonArea">
                <div>
                    <h3>Inventory List</h3>
                </div>
                <div id="searchDiv">
                    <!-- Search function button-->
                    <form action="server/search.php" method="get">
                        <input type="text" id="searchQuery" name="query" placeholder="search products">     
                        <button type="submit" class="button" id="searchButton">Search</button>
                    </form>
                </div>
                <div>
                    <!-- Filter function button, display a pop-up window after click the "Filter" button -->
                    <!-- Conditions list, allow to do multiple select -->
                    <button class="button" id="filterButton" onclick="displayFilterModal()">Filter</button>
                </div>
                    <!-- pop-up window of fliterButton -->
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeFilterModal()">&times;</span>
                            <h2>Filter Porduct</h2>
                            <form id="filterForm" action="server/filter.php" method="get">
                                <div class="content">
                                    <div class="left">
                                        <label for="filterProductId" class="ID">Product ID</label>
                                        <input type="text" id="filterProductId" class="IDinput" name="filterProductId">
                                        <label for="filterProductName" class="name">Product Name</label>
                                        <input type="text" id="filterProductName" name="filterProductName">
                                        <label for="filterStockStatus" class="status">Status</label>
                                        <select id="filterStockStatus" name="filterStockStatus" onchange="toggleDateInputs()">
                                            <option value="all">All</option>
                                            <option value="inStock">In Stock</option>
                                            <option value="shipped">Shipped</option>
                                        </select>
                                        <label id="stockTimeStartLabel" for="filterStockTimeStart">Commencement Date</label>
                                        <input type="date" id="filterStockTimeStart" name="filterStockTimeStart">
                                        <label id="stockTimeEndLabel" for="filterStockTimeEnd">Termination Date</label>
                                        <input type="date" id="filterStockTimeEnd" name="filterStockTimeEnd">
                                        </div>
                                    <div class="right">
                                        <label for="filterMinQuantity" class="min-quantity">Min Quantity</label>
                                        <input type="number" id="filterMinQuantity" name="minQuantity" placeholder="Min">
                                        <label for="filterMaxQuantity" class="max-quantity">Max Quantity</label>
                                        <input type="number" id="filterMaxQuantity" name="maxQuantity" placeholder="Max">
                                        <label for="filterMinPrice" class="min-price">Min Price</label>
                                        <input type="number" id="filterMinPrice" name="minPrice" placeholder="Min">
                                        <label for="filterMaxPrice" class="max-price">Max Price</label>
                                        <input type="number" id="filterMaxPrice" name="maxPrice" placeholder="Max">
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button type="submit" id="saveFilter">SEARCH</button>
                                    <button type="button" onclick="cancelFilterChanges()" id="cancleFitlter">DISCARD</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <!-- Add function button-->
                <div>
                    <button class="button" id="addButton" onclick="displayAddModal()">Add</button>
                </div>
                    <!-- pop-up window of addButton -->
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeAddModal()">&times;</span>
                            <h2>Add Product</h2>
                            <form action="server/add.php" method="post"  id="productForm">
                                <div class="content">
                                    <div class="left">
                                        <label for="addProductId">Product ID*</label>
                                        <input type="text" id="addProductId" name="productId">
                                        <label for="addProductName">Product Name*</label>
                                        <input type="text" id="addProductName" name="productName">
                                        <label for="addProductQuantity">Quantity*</label>
                                        <input type="number" id="addProductQuantity" name="productAmount" step="any">
                                        <label for="addProductAmount">Amount*</label>
                                        <input type="number" id="addProductAmount" name="productPrice" step="any">
                                    </div>
                                    <div class="right">
                                        <label>Status</label>
                                        <select id="addStockStatus" name="addStockStatus">
                                            <option value="In Stock" name="inStock">Inbound</option>
                                            <option value="Shipped" name="outOfStock">Shipped</option>
                                        </select>
                                        <label for="stockInTime">Inbound Date*</label>
                                        <input type="date" id="stockInTime" name="stockInTime">
                                        <label for="stockOutTime">Outbound Date</label>
                                        <input type="date" id="stockOutTime" name="stockOutTime">
                                    </div>
                                </div>
                                <div class="buttons">
                                    <!-- onclick="saveAddChanges() -->
                                    <button type="submit" id="saveAdd">SAVE CHANGES</button>
                                    <button type="button"  onclick="cancelAddChanges()" id="cancelAdd">DISCARD</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>

            <!-- Product list div -->
            
            <div class="tableArea">
                <!-- Display inventory products dynamically use table structure -->
                <table class="tableContainer">
                    <thead class='tableHead'>
                        <tr>
                            <th class='th-colId'>Product ID</th>
                            <th class='th-colName'>Product Name</th>
                            <th class='th-colQuantity'>Quantity</th>
                            <th class='th-colPrice'>Price</th>
                            <th class='th-colStatus'>Status</th>
                            <th class='th-colInbound'>Inbound Date</th>
                            <th class='th-colOutbound'>Outbound Date</th>
                            <th class='th-blank'></th>
                            <th class='th-colModify'></th>
                            <th class='th-colDelete'></th>
                        </tr>
                    </thead>
                    <tbody class='tableBody'>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td class='td-colId'><?= htmlspecialchars($row['product_id']) ?></td>
                                <td class='td-colName'><?= htmlspecialchars($row['product_name']) ?></td>
                                <td class='td-colQuantity'><?= htmlspecialchars($row['quantity']) ?></td>
                                <td class='td-colPrice'><?= htmlspecialchars($row['price']) ?></td>
                                <td class='td-colStatus'><?= htmlspecialchars($row['status']) ?></td>
                                <td class='td-colInbound'><?= htmlspecialchars($row['inbound_date']) ?></td>
                                <td class='td-colOutbound'><?= htmlspecialchars($row['outbound_date']) ?></td>
                                <td class='th-blank'></th>
                                <td class='td-colModify'><a class='dataLink' href='server/modify.php?id=<?= $row['product_id'] ?>'>Modify</a></td>
                                <td class='td-colDelete'><a class='dataLink' href='server/delete.php?id=<?= $row['product_id'] ?>'>Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>



    </main>

    <div>
        <footer>
            <p>&copy; 2024 WAREHOUSE. All rights reserved.</p>
            <p>Contact us at <a href="mailto:info@companyName.com">info@warehouse.com</a></p>
        </footer>
    </div>
</body>
</html>