<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click Update after making any changes.</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="#" method="post" style="width:50vw; min-width:300px;">
            <?php
            include "db_conn.php";

            $id = $_GET["id"];
            $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if(isset($_POST["update"])){
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email"];
                $gender = $_POST["gender"];

                $errors = array();

                // Data validation
                if (empty($first_name) || empty($last_name) || empty($email) || empty($gender)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }

                // Database operations
                if (empty($errors)) {
                    $sql = "UPDATE users SET first_name=?, last_name=?, email=?, gender=? WHERE id=?";
                    $stmt = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ssssi", $first_name, $last_name, $email, $gender, $id);
                        mysqli_stmt_execute($stmt);

                        header("Location: index.php?msg=User information updated successfully");
                        // echo "<div class='alert alert-success'>User information updated successfully</div>";
                    } else {
                        array_push($errors, "Error updating user information");
                    }

                    mysqli_stmt_close($stmt);
                }

                // Display errors
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
            }
        ?>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name:</label>
                        <input class="form-control" type="text" name="first_name" value="<?php echo $row['first_name']?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name:</label>
                        <input class="form-control" type="text" name="last_name" value="<?php echo $row['last_name']?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input class="form-control" type="email" name="email" value="<?php echo $row['email']?>">
                </div>
                <div class="form-group mb-3">
                    <label>Gender:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="male" value="Male" <?php echo ($row['gender']=='Male')?"checked":"";?>>
                    <label for="male" class="form-input-label">Male</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="female" value="Female"<?php echo ($row['gender']=='Female')?"checked":"";?>>
                    <label for="female" class="form-input-label">Female</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
