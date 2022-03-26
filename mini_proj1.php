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
$teacherid = $_POST["sql_query"];
$sql = "SELECT `classname`, `weeknum`, `classnum`, `teachername`
FROM `teacherandclass`
WHERE `teacherid` = '".$teacherid ."'
ORDER BY `classnum`, `weeknum`;";
$result = mysqli_query($conn, $sql) or die('MySQL query error');

#顯示查詢結果
$output_head = "<table border=1>";
$output_body ='<tr>';
$classnum_count = 1; #課堂計數器
$week_count = 1; #星期計數器
$classnum = ["一","二","三","四","五","六","七","八","九","十"]; 
while($row = mysqli_fetch_array($result)){
    
    for($i=$classnum_count; $i<=10; $i++){
    
        for($j=$week_count; $j<=6; $j++){
        
            if($week_count == 1)
            {
                $output_body .= "<td>"."第".$classnum[$classnum_count-1]."節課"."</td>";
            }
        
            if($classnum_count==$row["classnum"] && $week_count==$row["weeknum"])
            {
                $output_body .= "<td>".$row["classname"]."\n".$row["teachername"]."</td>";
                $week_count++;
                
                if($week_count > 6)
                      {
                          $week_count = 1;
                          $classnum_count ++;
                          $output_body .= "</tr><tr>";
                      }
                $i=11;$j=8;
            }
            elseif($classnum_count!=$row["classnum"] || $week_count!=$row["weeknum"])
            {
                $output_body .= "<td>"."\t"."</td>";
                $week_count++;
                
                      if($week_count > 6)
                      {
                          $week_count = 1;
                          $classnum_count ++;
                          $output_body .= "</tr><tr>";
                      }
            }
        }
    }
}
for($i=$classnum_count; $i<=10; $i++)
{   
    if($i == $classnum_count)
    {
         for($j=$week_count; $j<=6; $j++)
         {
              $output_body .= "<td>"."\t"."</td>"; 
         }
     }else
     {
          $output_body .= "<td>"."第".$classnum[$i-1]."節課"."</td>";
          for($j=1; $j<=6; $j++)
          {
              $output_body .= "<td>"."\t"."</td>"; 
          }
     }
     
     $output_body .= "</tr><tr>";
        
}

$output_body .="</tr>";
$columnName = ["     ","星期一","星期二","星期三","星期四","星期五","星期六"];
$output_columnName =  "<tr><td>".implode("</td><td>", $columnName)."</td></tr>";

$output_foot = "</table>";


#顯示課表
echo $output_head;
echo $output_columnName;
echo $output_body;
echo $output_foot;

?>
</pre>