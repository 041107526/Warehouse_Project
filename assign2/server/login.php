<?php
session_start(); // Start the session at the beginning

// Require public.php to connect with database
require_once 'public.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // Or 'email' if users log in with email
    $password = $_POST['password'];

    if (empty($name) || empty($password)) {
        // Handle error - Redirect back to login with error message
        echo "Please fill all fields.";
        exit;
    }

    // Fetch the user from the database
    $stmt = $pdo->prepare("SELECT * FROM public.users WHERE name = ?"); // Adjust based on your login criteria
    $stmt->execute([$name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        // Password is correct, so start a new session and
        // Save the user info in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name']; // Adjust as needed
        
        // Redirect to the desired page after login
        header("Location: ../index.php"); // Adjust the redirect location as necessary
        exit;
    } else {
        // Incorrect credentials, handle as needed
        echo "Invalid login credentials.";
        exit;
    }
}
?>
