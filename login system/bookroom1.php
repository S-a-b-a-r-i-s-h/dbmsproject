<?php 
@include 'config.php';

if (isset($_POST["checkavailability"])) {
    $checkinDate = mysqli_real_escape_string($conn, $_POST['checkindate']);
    $checkoutDate = mysqli_real_escape_string($conn, $_POST['checkoutdate']);
    $roomNumber = 1;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);



    // $selectQuery = "SELECT * FROM bookings WHERE roomno = ? AND (checkindate = ? OR checkoutdate = ?)";
    // $result = mysqli_query($conn, $selectQuery);
    $selectQuery = "SELECT * FROM bookings WHERE roomno = ? AND (checkindate = ? OR checkoutdate = ?)";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param('iss', $roomNumber, $checkinDate, $checkoutDate);
    $stmt->execute();
    $result = $stmt->get_result();


    if(mysqli_num_rows($result) > 0){    
        header("Location: rooms.php");
    } 
    else {
        // $insertQuery1 = "INSERT INTO bookings(roomno,name,phoneno,checkindate,checkoutdate) VALUES('$roomNumber','$name','$phoneno','$checkinDate','$checkoutDate')";
        // $result1 = mysqli_query($conn, $insertQuery1);
        // header("Location: index.php");
        $insertQuery = "INSERT INTO bookings(roomno, name, phoneno, checkindate, checkoutdate) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($insertQuery);
        $stmt2->bind_param('issss', $roomNumber, $name, $phoneno, $checkinDate, $checkoutDate);
        $stmt2->execute();
        header("Location: index.php");
    }

    $conn->close();
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h4>Check Room Booking Availability</h4>
                <form method="post" action="">
                    <div class="row" style="margin-top: 40px;">
                        <div class="">
                            <label class="form-label"><b>Check-in date</b></label>
                            <input type="date" required name="checkindate" class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="">
                            <label class="form-label"><b>Check-out date</b></label>
                            <input type="date" required name="checkoutdate" class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 40px;">
                        <div class="">
                            <label class="form-label"><b>Name</b></label>
                            <input type="text" required name="name" class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="">
                            <label class="form-label"><b>PhoneNo</b></label>
                            <input type="text" required name="phoneno" class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="">
                            <input type="submit" name="checkavailability" class="form-control shadow-none">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>