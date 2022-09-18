
<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 




if(isset($_GET['button1']))
{

if (!file_exists('C:\Jatayu Excel')) {
    mkdir('C:\Jatayu Excel', 0777, true);
}
 
  




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

$spreadsheet->getActiveSheet()->getStyle("A1:D1")->getFont()->setBold( true );
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);

$sheet->getStyle('A')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
$sheet->getStyle('B')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
$sheet->getStyle('C')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
$sheet->getStyle('D')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

$sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);




$writer = new Xlsx($spreadsheet);

$writer->save('C:\Jatayu Excel\JatayuDroneTraining '.date('Y'.'-'.'m'.'-'.'d'.' '.'H'.'_'.'i'.'_'.'s').'.'.'xlsx');

echo "<script type='text/javascript'>alert('Spreadsheet downloaded at C/Jatayu Excel directory at topmost of the pile named as JatayuDroneTraining followed by date and time in hours_minutes_second format');</script>";

mysqli_close($conn);
}

 ?>


<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form method="get">
<input type="submit" name="button1" value="Submit"/>
</form>

</head>
</html>

