<html>
<head>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" class="init">
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>
	
</head>

<pre>
<?php
#連接資料庫
error_reporting(E_ALL & ~E_NOTICE);
$dbhost = '127.0.0.1'; #MySQL IP
$dbuser = 'root'; #帳號
$dbpass = '';
$dbname = 'school'; #資料庫名稱

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection'); 
mysqli_query($conn, "SET NAMES 'utf8'"); #編碼
mysqli_select_db($conn, $dbname); #選擇要使用的資料庫

#提取使用者post資料，並於資料庫查詢
$class_search = $_POST["sql_query3"];
$sql = "SELECT teachername, MIN(DISTINCT(teacherid)) as teacherid FROM `teacherandclass`
 WHERE classname LIKE '%$class_search%' GROUP BY teacherid;";
$result = mysqli_query($conn, $sql) or die('MySQL query error');

#顯示查詢結果
$output_head = "<table id='example'>";
$output_body ='';
while($row = mysqli_fetch_array($result)){
	$output_body .=  "<tr>";
	foreach($row as $key => $each){
		if(is_numeric($key)){
			$output_body .=  "<td>".$each."</td>";
		}elseif(!is_numeric($key)){
			$columnName[$key] = $key;
		}//end if
	}//end foreach
	$output_body .=  "</tr>";	
}

$output_columnName =  "<thead><tr><td>".implode("</td><td>", $columnName)."</td></tr></thead>";

$output_foot =  "</table>";


#顯示課表
echo $output_head;
echo $output_columnName;
echo $output_body;
echo $output_foot;

?>
</pre>