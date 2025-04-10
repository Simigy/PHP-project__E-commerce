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
        echo "ERROR: Role column does not exist in the users table.<br>";
        echo "Please run the update_admin.php script first.<br>";
        exit;
    }

    // Check if there are any admin users
    $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'");
    $adminCount = $stmt->fetchColumn();

    if ($adminCount == 0) {
        echo "ERROR: No admin users found in the database.<br>";
        echo "Please run the update_admin.php script to create an admin user.<br>";
        exit;
    }

    // List admin users
    $stmt = $pdo->query("SELECT id, name, email, role FROM users WHERE role = 'admin'");
    $adminUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Admin Users:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";
    foreach ($adminUsers as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['role']}</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Check if the admin routes are registered
    echo "<h2>Admin Routes:</h2>";
    echo "<ul>";
    echo "<li><a href='http://localhost/laravel%20project/e-commerce/public/admin/products' target='_blank'>Admin Products (localhost)</a></li>";
    echo "<li><a href='http://127.0.0.1:8000/admin/products' target='_blank'>Admin Products (127.0.0.1)</a></li>";
    echo "<li><a href='http://localhost/laravel%20project/e-commerce/public/admin/test' target='_blank'>Admin Test (localhost)</a></li>";
    echo "<li><a href='http://127.0.0.1:8000/admin/test' target='_blank'>Admin Test (127.0.0.1)</a></li>";
    echo "</ul>";

    echo "<h2>Instructions:</h2>";
    echo "<ol>";
    echo "<li>Make sure you're logged in as an admin user.</li>";
    echo "<li>Try accessing the admin routes using the links above.</li>";
    echo "<li>If you're still having issues, check the Laravel logs for errors.</li>";
    echo "</ol>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
