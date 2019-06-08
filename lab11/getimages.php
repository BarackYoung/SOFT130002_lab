<?php
/**
 * Created by PhpStorm.
 * User: 13302
 * Date: 2019/6/7
 * Time: 21:27
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
$database->query("SET NAMES UTF8");
$continent = $country=$searchstr="";
$sql="";
$continent=$_POST["continent"];
$country=$_POST["country"];
$searchstr=$_POST["searchstr"];
if ($continent==""){
    $sql="SELECT * FROM imagedetails ";
}elseif ($continent!=""&$country==""){
    $sql="SELECT * FROM imagedetails WHERE ContinentCode='{$continent}'";
}elseif ($continent!=""&$country!=""&$searchstr==""){
    $sql="SELECT * FROM imagedetails WHERE ContinentCode='{$continent}' AND CountryCodeISO='{$country}'";
}elseif ($continent!=""&$country!=""&$searchstr!=""){
    $sql="SELECT * FROM imagedetails WHERE ContinentCode='{$continent}' AND CountryCodeISO='{$country}' AND Title='{$searchstr}'";
}
$result = $database->query($sql);
if($result===false){
    echo("发生了一个致命的错误");
    exit();
}
if ($result->num_rows===0){
    echo "没有找到符合以上条件的照片";
    exit();
}
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}

for ($i=0;$i<count($rows);$i++){
    echo "<li>
              <a href='detail.php?id={$rows[$i]['ImageID']}' class='img-responsive'>
                <img src='images/square-medium/{$rows[$i]['Path']}' alt='{$rows[$i]['Title']}' style='width: 225px'>
                <div class='caption'>
                  <div class='blur'></div>
                  <div class='caption-text'>
                    <p>{$rows[$i]['Title']}</p>
                  </div>
                </div>
              </a>
            </li>  ";
}