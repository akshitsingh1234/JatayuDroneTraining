<?php


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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

$query="SELECT * FROM message";
$query_run=mysqli_query($conn, $query);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'First Name');
$sheet->setCellValue('B1', 'Last Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Phone Number');

$row_count=2;
foreach($query_run as $data)
{
$sheet->setCellValue('A'. $row_count, $data['firstname']);
$sheet->setCellValue('B'. $row_count, $data['lastname']);
$sheet->setCellValue('C'. $row_count, $data['email']);
$sheet->setCellValue('D'. $row_count, $data['number']);
$row_count++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('JatayuDroneTraining.xlsx');



mysqli_close($conn);
header("Location: randomtp.php");


}
else{
    echo "Enter Phone Number with correct format <br>";
    }



?>