<!-- 
    File name: public.php
    Author: Yanni Ye
    Description: The php file to connect with postgreSQL database
-->
<?php 
    // Database connection details
    $host = 'localhost';
    $dbname = 'web_assign2';
    $username = 'postgres';
    $password = '990515';
    // Create a PDO connection to the database
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    
    // Define a function to handle SQL queries and errors
    function my_error($pdo, $sql){
        // Execute sql query
        $stmt = $pdo->query($sql);
    
        // Check if the query execution was successful
        if(!$stmt){
            $errorInfo = $pdo->errorInfo();
            echo 'SQL execution error with error number: ' . $errorInfo[1] . '<br/>';
            echo 'SQL execution error with error message: ' . $errorInfo[2] . '<br/>';
    
            
            exit;
        }
    
        return $stmt;
    }
    
    // Call the my_error function with the SQL query to set the search path
    my_error($pdo, 'SET search_path TO web_assign2');


