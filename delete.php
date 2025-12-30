<?php
// ১. ডাটাবেস কানেকশন ফাইলটি এখানে ইনক্লুড করুন (যেমন: db_config.php)
include "process.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // ২. ডিলিট কোয়েরি চালানো
    $sql = "DELETE FROM orders WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Deleted Successfully";
    } else {
        echo "Delete Failed: " . mysqli_error($conn);
    }
} else {
    echo "No ID found!";
}
