<?php


require 'vendor/autoload.php';
require 'randomtp.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


        $first_name =  $_REQUEST['firstname'];
        $last_name = $_REQUEST['lastname'];
        $email = $_REQUEST['email'];
        $subject= $_REQUEST['subject'];

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
if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($subject) )  

$sql = "INSERT INTO message VALUES ('$first_name',
            '$last_name','$email','$subject')";

if(mysqli_query($conn, $sql)){
  if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($subject) )  
     
echo "<script type='text/javascript'>alert('Query submitted successfully');</script>";


}



mysqli_close($conn);
header("Location: randomtp.php");








?>