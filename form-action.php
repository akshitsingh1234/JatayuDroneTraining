<?php

        $first_name =  $_REQUEST['firstname'];
        $last_name = $_REQUEST['lastname'];
        $email = $_REQUEST['email'];
        $number= $_REQUEST['number'];

if(preg_match('/^[0-9]{11}+$/', $number)) {
    // the format /^[0-9]{11}+$/ will check for phone number with 11 digits and only numbers
    echo "Phone Number is Valid <br>";
  
  

$host = "localhost";
$dbname = "message_db";
$username = "root";
$password = "";
        
$conn = mysqli_connect(hostname: $host,
                       username: $username,
                       password: $password,
                       database: $dbname);
        
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}           
$sql = "INSERT INTO message VALUES ('$first_name',
            '$last_name','$email','$number')";

if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";
 
            echo nl2br("\n$first_name\n $last_name\n "
                . "$gender\n $address\n $email");
}

mysqli_close($conn);
header("Location: randomtp.php");
}
else{
    echo "Enter Phone Number with correct format <br>";
    }
?>