<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here
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
$sql2="SELECT * FROM countries";
$result2 = $database->query($sql2);
if($result2===false){
    echo("发生了一个致命的错误");
    exit();
}
while($row = $result2->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control" id="select">
                <option value="0">Select Continent</option>
                <?php
                //Fill this place

                //****** Hint ******
                //display the list of continents
                $sql="SELECT * FROM continents ";
                $result = $database->query($sql);
                while($row = $result->fetch_assoc()) {
                  echo '<option class="option" value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }
                ?>
              </select>
                  <script>
                      var continent="";
                      var country="";
                      var searchstr = "";
                      // window.onload=function () {
                      //     var select = document.getElementById("select");
                      //     select.onchange=function(){
                      //         var selvalue = select.value;
                      //         alert(rows)
                      //     }
                      // }
                      $(document).ready(function () {
                          findimges();
                          var select=$("#select");
                          select.change(function () {
                              var selvalue = select.val();
                              continent=selvalue;
                              findcountries();
                              findimges();
                          })
                          var selectcountries=$("#selectcountries");
                          selectcountries.change(function () {
                              var selval = selectcountries.val();
                              country = selval;
                              findimges();
                          })
                          $("#Filter").click(function () {
                              searchstr = $("#search").val();
                              findimges();
                          })
                      })
                      function findcountries() {
                          $.ajax({
                              url: "selectcountries.php",
                              data: {
                                  continent: continent,
                              },
                              type: "POST",
                              dataType: "TEXT",
                              success: function (data) {
                                 $("#selectcountries").html(data);
                              }
                          })
                      }
                      function findimges() {
                          $.ajax({
                              url: "getimages.php",
                              data: {
                                  continent: continent,
                                  country:country,
                                  searchstr:searchstr
                              },
                              type: "POST",
                              dataType: "TEXT",
                              success: function (data) {
                                  $("#images").html(data);
                              }
                          })
                      }
                  </script>
              <select name="country" class="form-control" id="selectcountries">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place

                //****** Hint ******
                /* display list of countries */


                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title id="search">
              <button type="button" class="btn btn-primary" id="Filter">Filter</button>
              </div>
            </form>

          </div>
        </div>     


		<ul class="caption-style-2" id="images">

        </ul>

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>