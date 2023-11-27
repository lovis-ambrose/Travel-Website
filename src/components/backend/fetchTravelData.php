<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

   $servername = "localhost";
   $dbname = "travel_website";
   $username = "root";
   $password = "P@ss2525";
   $conn = mysqli_connect($servername,$username,$password,$dbname);
   // Check connection
//    if (!$conn) {
//        die("Connection failed: " . mysqli_connect_error());
//    } else {
//     echo "Connected to DB\n";
//    }
        $sql = "SELECT * FROM travel";
        $d = array();
        $query = mysqli_query($conn, $sql);
      
        if(!$query){
            echo "Error";
        } else {
            while($row = mysqli_fetch_assoc($query)){
                array_push($d,$row);
            }
          echo json_encode($d);
        }
        

?>