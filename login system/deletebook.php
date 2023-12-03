
<?php
include "config.php";

// Check if "phone" key is set in the $_GET array
if (isset($_GET["checkindate"])) {
    $checkindate = (string)$_GET["checkindate"];

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM `bookings` WHERE checkindate = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkindate);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: admin_page.php?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Error: Phone number not provided.";
}
?>

