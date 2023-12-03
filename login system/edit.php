<?php
include "config.php";
$phone = $_GET["phone"];

if (isset($_POST["submit"])) {
  $name = $_POST['name'];
  $designation = $_POST['designation'];
  $age = $_POST['age'];
  $salary = $_POST['salary'];

  $sql = "UPDATE `employee` SET `name`='$name',`designation`='$designation',`age`='$age',`salary`='$salary' WHERE phone = $phone";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: employee.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>

<!-- <?php
include "config.php";
$phone = $_GET["phone"];

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE `employee` SET `name`='$name',`designation`='$designation',`age`='$age',`salary`='$salary' WHERE id = $phone";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiss", $name, $designation, $age, $salary, $phone);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: employee.php?msg=Data updated successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?> -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>employee</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    employee addition
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `employee` WHERE phone = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Designation:</label>
            <input type="text" class="form-control" name="designation" value="<?php echo $row['designation'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Salary:</label>
            <input type="text" class="form-control" name="salary" value="<?php echo $row['salary'] ?>">
          </div>


        </div>

        <div class="mb-3">
          <label class="form-label">Age:</label>
          <input type="number" class="form-control" name="age" value="<?php echo $row['age'] ?>">
        </div>
        <div class="mt-3 mb-3">
          <label class="form-label">Phone:</label>
          <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>">
        </div>
        

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="employee.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>