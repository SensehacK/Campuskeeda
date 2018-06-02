<?php
session_start(); 
ob_start();
include('../db.inc.php');
$query_string = "select name,address,phone_no,email_id,my_question,post_date from fun_contact_us"; 
$export_filename = "contact_detail.xls";
$result = mysql_query($query_string);
$count = mysql_num_fields($result);
$header = '';
for ($i = 0; $i < $count; $i++){
	$header .= mysql_field_name($result, $i)."\t";
}
while($row = mysql_fetch_row($result)){
	$line = '';
	foreach($row as $value){
		if(!isset($value) || $value == ""){
			$value = "\t";
		}else{
			$value = str_replace('"', '""', $value);
			$value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	}
	$data .= trim($line)."\n";
}
$data = str_replace("\r", "", $data);
if ($data == "") {
	$data = "\nNo Data Found\n";
}
// create table header showing to download a xls (excel) file
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$export_filename");
header("Cache-Control: public");
header("Content-length: ".strlen($data)); // tells file size
header("Pragma: no-cache");
header("Expires: 0");
// output data
echo $header."\n".$data;
?>