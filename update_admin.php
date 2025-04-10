<?php

// Database configuration
$host = 'localhost';
$dbname = 'e-commerce_offline';
$username = 'root';
$password = '';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the role column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'");
    $columnExists = $stmt->rowCount() > 0;

    if (!$columnExists) {
        // Add the role column if it doesn't exist
        $pdo->exec("ALTER TABLE users ADD COLUMN role VARCHAR(255) DEFAULT 'user' AFTER email");
        echo "Role column added successfully.<br>";
    } else {
        echo "Role column already exists.<br>";
    }

    // Update a user to have the admin role
    // Replace 'admin@example.com' with the email of the user you want to make an admin
    $email = 'admin@example.com'; // Change this to the email of the user you want to make an admin

    $stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "User with email '$email' has been updated to have the admin role.<br>";
    } else {
        echo "No user found with email '$email'.<br>";
    }

    // List all users and their roles
    $stmt = $pdo->query("SELECT id, name, email, role FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>All Users:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['role']}</td>";
        echo "</tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
