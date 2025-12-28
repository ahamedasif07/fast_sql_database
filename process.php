<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "dummy_database";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['firstName'] . ' ' . $_POST['lastName'];
    echo $name;







    $create_sql = "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(50) NOT NULL,
        lastName VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address VARCHAR(255) NOT NULL,
        city VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        zip VARCHAR(20) NOT NULL,
        notes TEXT,
        created_at DATETIME NOT NULL
    )";

    $conn->query($create_sql);

    $firstName  = $_POST['firstName'];
    $lastName   = $_POST['lastName'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $city       = $_POST['city'];
    $state      = $_POST['state'];
    $zip        = $_POST['zip'];
    $notes      = $_POST['notes'];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO orders 
        (firstName, lastName, email, phone, address, city, state, zip, notes, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssss",
        $firstName,
        $lastName,
        $email,
        $phone,
        $address,
        $city,
        $state,
        $zip,
        $notes,
        $created_at
    );

    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit();
    }

    $stmt->close();
    $conn->close();
}
