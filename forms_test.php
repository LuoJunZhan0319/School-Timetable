<pre>
<form method="POST" action="mini_proj1.php">
  
  #老師課表查詢
  <input type="text" name="sql_query" size="40">
  
  <input type="submit" value="查詢">
</form>
<form method="POST" action="mini_proj2.php">
  #指定授課時數(<=,>=)的老師姓名/ID/授課時數
  <input type="text" name="sql_query2" size="40">
  
  <input type="submit" value="查詢">
</form>
<form method="POST" action="mini_proj3.php">

  #輸入課程名稱，輸出所有教授這門課的老師清單
  <input type="text" name="sql_query3" size="40">
  
  <input type="submit" value="查詢">

</form>
<form method="POST" action="mini_proj4.php">
  #代課老師查詢，輸入下列並填資訊:
  #星期
  <input type="text" name="weeknum" size="40">
  #節次
  <input type="text" name="classnum" size="40">
  #課程
  <input type="text" name="classname" size="40">
  #教師編號
  <input type="text" name="teacherid" size="40">
  
  <input type="submit" value="查詢">
</form>

</pre>