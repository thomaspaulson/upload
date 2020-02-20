<?php
require_once '../../admina/inc/Classes/PHPExcel.php';
$file =$_GET["file"];
$objPHPExcel = PHPExcel_IOFactory::load("$file");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
$objWriter->writeAllSheets();
$objWriter->save('php://output');
?>