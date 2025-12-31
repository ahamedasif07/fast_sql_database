<?php
// updat
// ৩. ডাটা আপডেট করার অংশ
include "process.php";
if ($action == "update") {
    $id    = $_POST['id'];
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $email = $_POST['email'];
    $city  = $_POST['city'];

    $sql = "UPDATE orders SET 
            firstName='$fName', 
            lastName='$lName', 
            email='$email', 
            city='$city' 
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
    exit();
}
