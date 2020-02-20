<?php
set_time_limit(0);
header('Content-type: text/plain');
session_start();
include "../../admina/inc/config.php";
session_check();
?>
<?php

include_once '../../admina/inc/Classes/PHPExcel/IOFactory.php';
$file =$_GET["file"];
$site_id =$_GET["site_id"];
$start_date =$_GET["start_date"];
$end_date =$_GET["end_date"];
$end_date =$_GET["start_date"];
$total_working_days =$_GET["total_working_days"];

$time=strtotime($start_date);
$month=date("m",$time);
$year=date("Y",$time);
try {

    $objPHPExcel = PHPExcel_IOFactory::load("$file");
} catch (Exception $e) {

    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
}
$allDataInSheet = $objPHPExcel->getActiveSheet(0)->toArray(null, true, true, true);
 $DataInSheet = $objPHPExcel->getActiveSheet(0)->getCell('BB5')->getOldCalculatedValue();
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

$seperator = array('; ', ', ', ';', ',', ' ', ':', ': ');

for ($i = 5; $i <= $arrayCount; $i++) {
   echo $lop[] = $objPHPExcel->getActiveSheet(0)->getCell("BB$i")->getOldCalculatedValue();
    echo $employee[] = $objPHPExcel->getActiveSheet(0)->getCell("A$i")->getValue();
    
}
foreach($employee as $key=>$employee_id){
    if($employee_id !="")
    {
        $data =  array("employee_id" =>$employee_id,
            "site_id" =>$site_id,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "total_working_days" => $total_working_days,
            "lop" => $lop[$key],
            "status" => 'processed',
            "udate"=>  date("Y-m-d"));
            $db->insert("ihrm_temp_leave",$data);
    }
}
$data2 =array("status"=>'processed');
 $up = $db->update_custom("ihrm_documents",$data2,"file = '".$file."'");
 if ($in = true || $up = true) {
        $_SESSION["result"] = TRUE;
          
    } else {
        $_SESSION["result"] = FALSE;
    }

    die(header("location:../../admina/index.php/documents"));
  
?>