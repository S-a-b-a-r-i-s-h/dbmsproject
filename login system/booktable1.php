<?php 
@include 'config.php';

if (isset($_POST["checkavailability"])) {
    $Date = mysqli_real_escape_string($conn, $_POST['date']);
    $selectedtime = mysqli_real_escape_string($conn, $_POST['time']);
    $tableNumber = 1;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);



    // $selectQuery = "SELECT * FROM bookings WHERE roomno = ? AND (checkindate = ? OR checkoutdate = ?)";
    // $result = mysqli_query($conn, $selectQuery);
    $selectQuery = "SELECT * FROM tablebookings WHERE tableno = ? AND date = ? AND time = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param('iss', $tableNumber, $Date, $selectedtime);
    $stmt->execute();
    $result = $stmt->get_result();


    if(mysqli_num_rows($result) > 0){    
        header("Location: tables.php");
    } 
    else {
        // $insertQuery1 = "INSERT INTO bookings(roomno,name,phoneno,checkindate,checkoutdate) VALUES('$roomNumber','$name','$phoneno','$checkinDate','$checkoutDate')";
        // $result1 = mysqli_query($conn, $insertQuery1);
        // header("Location: index.php");
        $insertQuery = "INSERT INTO tablebookings(tableno, name, phoneno, date, time) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($insertQuery);
        $stmt2->bind_param('issss', $tableNumber, $name, $phoneno, $Date, $selectedtime);
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
   <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-ryeeO9dbn46L3As+Kq8FyNb6L6R2v0jzcU8U3q+6OLvQlX6U6zLoj3pNmNTROjFt" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"></script>

   <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h4>Check Table Booking Availability</h4>
                <form method="post" action="">
                    <div class="row" style="margin-top: 40px;">
                        <div class="">
                            <label class="form-label"><b>Date</b></label>
                            <input type="date" required name="date" class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <label for="time"> <b>Time</b> </label>
                        <select name="time" id="time" style="border:1px solid gray; border-radius:7px; width: 50%; height: 40px; margin-left:10px;">
                        <option value="morning">Morning</option>
                        <option value="afternoon">Afternoon</option>
                        <option value="evening">Evening</option>
                        <option value="night">Night</option>
                        </select>
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