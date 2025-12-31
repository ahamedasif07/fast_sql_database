<?php
// ডাটাবেস কানেকশন
$conn = mysqli_connect("localhost", "root", "", "dummy_database");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// টেবিল না থাকলে অটোমেটিক তৈরি হবে
$table_sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(255),
    city VARCHAR(50),
    state VARCHAR(50),
    zip VARCHAR(20),
    notes TEXT
)";
mysqli_query($conn, $table_sql);

// AJAX থেকে আসা Action চেক করা
$action = $_POST['action'] ?? '';

// ১. ডাটা সেভ করার অংশ
if ($action == "insert") {
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addr  = $_POST['address'];
    $city  = $_POST['city'];
    $state = $_POST['state'];
    $zip   = $_POST['zip'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO orders (firstName, lastName, email, phone, address, city, state, zip, notes) 
            VALUES ('$fName', '$lName', '$email', '$phone', '$addr', '$city', '$state', '$zip', '$notes')";

    if (mysqli_query($conn, $sql)) {
        echo "success"; // এটিই AJAX রিসিভ করবে
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}

// ২. ডাটা তুলে আনার অংশ (view.php এর জন্য)
if ($action == "fetch") {
    $sql = "SELECT * FROM orders ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $count = 1; // সিরিয়াল নম্বর শুরু করার জন্য
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$count}</td> 
                    <td>{$row['firstName']} {$row['lastName']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['city']}</td>
                  <td>
        <button 
            class='edit-btn'
            data-id='{$row['id']}'
            data-fname='{$row['firstName']}'
            data-lname='{$row['lastName']}'
            data-email='{$row['email']}'
            data-city='{$row['city']}'
        >Edit</button>

        <button 
            class='delete-btn' 
            data-id='{$row['id']}'
        >Delete</button>
    </td>

                  </tr>";
            $count++; // প্রতি লুপে ১ করে বাড়বে
        }
    } else {
        echo "<tr><td colspan='4' align='center'>No data found.</td></tr>";
    }
    exit();
}

// delete data \
if ($action == "delete") {
    $id = $_POST['id'];
    $sql = "DELETE FROM orders WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Deleted Successfully";
    } else {
        echo "delete failde";
    }
    exit();
}
