<?php
require "db_conn.php";

if(isset($_POST["submit"])){
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
            require_once "db_conn.php";

            // Check if user exists
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $rowCount = mysqli_num_rows($result);

                if ($rowCount > 0) {
                    array_push($errors, "Email already registered");
                }
            } else {
                array_push($errors, "Error checking email");
            }

            if (empty($errors)) {
                $sql = "INSERT INTO users (first_name, last_name, email, gender) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $gender);
                    mysqli_stmt_execute($stmt);

                    echo "<div class='alert alert-success'>You are successfully registered</div>";
                } else {
                    array_push($errors, "Error inserting user");
                }
            }
        }

        // Display errors
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
 }
?>