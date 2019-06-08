<?php
/**
 * Created by PhpStorm.
 * User: 13302
 * Date: 2019/6/7
 * Time: 21:16
 */
$host = "127.0.0.1";
$user="root";
$password="123456";
$databasename = "travel";
$database = new mysqli($host,$user,$password,$databasename);
if($database->connect_error<>0){
    echo("连接失败");
    echo($database->connect_error);
}
$continent=$_POST["continent"];
$database->query("SET NAMES UTF8");
$sql2="SELECT * FROM countries WHERE continent = '{$continent}'";
$result2 = $database->query($sql2);
if($result2===false){
    echo("发生了一个致命的错误");
    exit();
}
while($row = $result2->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
for ($i=0;$i<count($rows);$i++){
    echo "<option value='{$rows[$i]['ISO']}'>{$rows[$i]['CountryName']}</option>";
}