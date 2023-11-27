<?php
    include "db_conn.php";
    $id = $_GET["id"];
    $sql = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: index.php?msg=Record deleted successfull");
    }
    else{
        echo "Failed to delete record" . mysqli_error($conn);
    }
?>