<?php
// Require public.php to connect with database
require_once 'public.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic validation
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['employeeId']) || empty($_POST['password']) || $_POST['password'] !== $_POST['password2']) {
        // Handle error - In production, use a more sophisticated validation/error handling approach
        echo "Invalid input or passwords do not match.";
        exit;
    }

    // Hash the password
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email or employee ID already exists
    $stmt = $pdo->prepare("SELECT * FROM public.users WHERE email = ? OR employee_id = ?");
    $stmt->execute([$_POST['email'], $_POST['employeeId']]);
    if ($stmt->rowCount() > 0) {
        echo "A user with the given email or employee ID already exists.";
        exit;
    }

    // Insert the user
    $stmt = $pdo->prepare("INSERT INTO public.users (name, email, employee_id, password_hash) VALUES (?, ?, ?, ?)");
    $success = $stmt->execute([$_POST['name'], $_POST['email'], $_POST['employeeId'], $passwordHash]);

    if ($success) {
        // Redirect to login page on success
        header("Location: ../html/login.html");
        exit;
    } else {
        echo "An error occurred during registration.";
    }
}
?>
