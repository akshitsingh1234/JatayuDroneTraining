<?php


require 'vendor/autoload.php';

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
$sql = "INSERT INTO message VALUES ('$first_name',
            '$last_name','$email','$subject')";

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
$sheet->setCellValue('D1', 'Subject');

$row_count=2;
foreach($query_run as $data)
{
$sheet->setCellValue('A'. $row_count, $data['firstname']);
$sheet->setCellValue('B'. $row_count, $data['lastname']);
$sheet->setCellValue('C'. $row_count, $data['email']);
$sheet->setCellValue('D'. $row_count, $data['subject']);
$row_count++;

}
$spreadsheet->getActiveSheet()->getStyle('A1:E999')
    ->getAlignment()->setWrapText(true); 
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);

$writer = new Xlsx($spreadsheet);
$writer->save('JatayuDroneTraining.xlsx');



mysqli_close($conn);
header("Location: randomtp.php");






?>