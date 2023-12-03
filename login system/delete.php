
<?php
include "config.php";

// Check if "phone" key is set in the $_GET array
if (isset($_GET["phone"])) {
    $phone = (int)$_GET["phone"];

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM `employee` WHERE phone = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $phone);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: employee.php?msg=Data deleted successfully");
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

