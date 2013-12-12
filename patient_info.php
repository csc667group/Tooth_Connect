
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap-3.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


    <link type="text/css" rel="stylesheet" href="home_page.css" />
<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.css">

 </head>



  <body>




 <div class="container">
<?php
  session_start();
  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['email'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['email'] = $_COOKIE['email'];
      
    }
  }
  if (isset($_SESSION['user_id'])) {   
                    
    if($_SESSION['user_id'] < 1000) {          
       echo('<p align="right">Logged in as ' . $_SESSION['email'] . '<a href="Patient_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
      } else {
       echo('<p align="right">Logged in as ' . $_SESSION['email'] . '<a href="Dentist_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
      }
  } else {
       echo('<p align="right">You are not logged in | '. '<a href="index.php#signin"> Sign in </a> </p>');
  }        
?>
      <?php include("header_bar.php"); ?>

<?php
                          
                                    require_once('connectvars.php');

                                    // Connect to the database
                                    $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

                                    if (!$connection) {
                                      die("Database connection failed:" . mysql_error());
                                    }

                                    $database = mysql_select_db(DB_NAME, $connection);
                                    if (!$database) {
                                      die("Database selection failed:" . mysql_error());
                                    }  


 echo "<h3>Patient Info</h3>";


    $p_user_id = $_GET['p_user_id'];

    $query = "SELECT * FROM patient_data WHERE user_id = '$p_user_id'";
    $data = mysql_query($query);
    if(mysql_num_rows($data) == 1){
        $row = mysql_fetch_array($data);


       echo "<strong>Name:</strong>&nbsp; " . ($row['firstname']) . " ";
       echo ($row['lastname']) . "</strong><br>"; 
       
       echo "<address> <strong>Address:</strong>&nbsp;". ($row['address']) .  ", "
       .($row['city']) .", ".($row['state']) . " " . ($row['zipcode']) . 
       "<br>
       <span class='glyphicon glyphicon-earphone'></span>&nbsp;" . ($row['phone']) . "<br>
       <span class='glyphicon glyphicon-envelope'></span><a href='mailto:" . ($row['email']) . "'>&nbsp;" . ($row['email']) . "</a></address>";
       echo "<hr>";
    }
    mysql_close($connection);  
   // exit();  

        echo "
        <table border='0' cellpadding='1' cellspacing='1'>
            <tr>
              <td><a href='#' onclick='return getOutput(1, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth1.jpg' alt='tooth1' ></a></td>
              <td><a href='#' onclick='return getOutput(2, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth2.jpg' alt='tooth2' ></a></td>
              <td><a href='#' onclick='return getOutput(3, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth3.jpg' alt='tooth3' ></a></td>
              <td><a href='#' onclick='return getOutput(4, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth4.jpg' alt='tooth4' ></a></td>
              <td><a href='#' onclick='return getOutput(5, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth5.jpg' alt='tooth5' ></a></td>
              <td><a href='#' onclick='return getOutput(6, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth6.jpg' alt='tooth6' ></a></td>
              <td><a href='#' onclick='return getOutput(7, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth7.jpg' alt='tooth7' ></a></td>
              <td><a href='#' onclick='return getOutput(8, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth8.jpg' alt='tooth8' ></a></td>
              <td><a href='#' onclick='return getOutput(9, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth9.jpg' alt='tooth9' ></a></td>
              <td><a href='#' onclick='return getOutput(10, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth10.jpg' alt='tooth10' ></a></td>
              <td><a href='#' onclick='return getOutput(11, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth11.jpg' alt='tooth11' ></a></td>
              <td><a href='#' onclick='return getOutput(12, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth12.jpg' alt='tooth12' ></a></td>
              <td><a href='#' onclick='return getOutput(13, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth13.jpg' alt='tooth13' ></a></td>
              <td><a href='#' onclick='return getOutput(14, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth14.jpg' alt='tooth14' ></a></td>
              <td><a href='#' onclick='return getOutput(15, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth15.jpg' alt='tooth15' ></a></td>
              <td><a href='#' onclick='return getOutput(16, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth16.jpg' alt='tooth16' ></a></td>
            </tr>
            <tr>
              <td><a href='#' onclick='return getOutput(17, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth32.jpg' alt='tooth32' ></a></td>
              <td><a href='#' onclick='return getOutput(18, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth31.jpg' alt='tooth31' ></a></td>
              <td><a href='#' onclick='return getOutput(19, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth30.jpg' alt='tooth30' ></a></td>
              <td><a href='#' onclick='return getOutput(20, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth29.jpg' alt='tooth29' ></a></td>
              <td><a href='#' onclick='return getOutput(21, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth28.jpg' alt='tooth28' ></a></td>
              <td><a href='#' onclick='return getOutput(22, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth27.jpg' alt='tooth27' ></a></td>
              <td><a href='#' onclick='return getOutput(23, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth26.jpg' alt='tooth26' ></a></td>
              <td><a href='#' onclick='return getOutput(24, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth25.jpg' alt='tooth25' ></a></td>
              <td><a href='#' onclick='return getOutput(25, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth24.jpg' alt='tooth24' ></a></td>
              <td><a href='#' onclick='return getOutput(26, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth23.jpg' alt='tooth23' ></a></td>
              <td><a href='#' onclick='return getOutput(27, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth22.jpg' alt='tooth22' ></a></td>
              <td><a href='#' onclick='return getOutput(28, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth21.jpg' alt='tooth21' ></a></td>
              <td><a href='#' onclick='return getOutput(29, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth20.jpg' alt='tooth20' ></a></td>
              <td><a href='#' onclick='return getOutput(30, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth19.jpg' alt='tooth19' ></a></td>
              <td><a href='#' onclick='return getOutput(31, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth18.jpg' alt='tooth18' ></a></td>
              <td><a href='#' onclick='return getOutput(32, $p_user_id, $_SESSION[user_id]);'><img src='assets/img/tooth17.jpg' alt='tooth17' ></a></td>
            </tr>
        </table>";
        echo "<div id='output' style='color:#0000FF'><h3>Please click the tooth for treatment information!</h3></div>";
                                ///END OF THE FIFTH TAB
     
   
?>
<hr>


     <div class="footer">
        <p>&copy; Copyrights 2013</p>
      </div>

</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.0.2/dist/js/bootstrap.min.js"></script>



        <!-- JavaScript code for treatment details-->
        <script type="text/javascript">
        // handles the click event for link 1, sends the query
            function getOutput(toothID, patientID, dentistID) {

              getRequest(
                  //'retrieve_treatments_for_patient.php?tooth_id='+toothID+'&patient_id='+patientID, // URL for the PHP file
                  'retrieve_treatments_for_dentist.php?tooth_id='+toothID+'&patient_id='+patientID+'&dentist_id='+dentistID, 
                   drawOutput,  // handle successful request
                   drawError    // handle error
              );
              return false;
            }  
            // handles drawing an error message
            function drawError () {
                var container = document.getElementById('output');
                container.innerHTML = 'Bummer: there was an error!';
            }
            // handles the response, adds the html
            function drawOutput(responseText) {
                var container = document.getElementById('output');
                container.innerHTML = responseText;
            }
            // helper function for cross-browser request object
            function getRequest(url, success, error) {
                var req = false;
                try{
                    // most browsers
                    req = new XMLHttpRequest();
                } catch (e){
                    // IE
                    try{
                        req = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        // try an older version
                        try{
                            req = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                            return false;
                        }
                    }
                }
                if (!req) return false;
                if (typeof success != 'function') success = function () {};
                if (typeof error!= 'function') error = function () {};
                req.onreadystatechange = function(){
                    if(req .readyState == 4){
                        return req.status === 200 ? 
                            success(req.responseText) : error(req.status)
                        ;
                    }
                }
                req.open("GET", url, true);
                req.send(null);
                return req;
            }

        </script>
        <!-- End of JavaScript code for treatment details -->

  </body>
</html>

<!-- -->