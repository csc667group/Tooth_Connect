
  <!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Patient Profile</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
        <!-- add backgrouond -->
        <link type="text/css" rel="stylesheet" href="home_page.css" />
        <link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.css">
 <!-- CSS code from Bootply.com editor -->     
        <style type="text/css">
            /* custom inclusion of left tab */
            .tabs-left > .nav-tabs {
                border-bottom: 0;
            }

            .tab-content > .tab-pane,
            .pill-content > .pill-pane {
                display: none;
            }

            .tab-content > .active,
            .pill-content > .active {
                display: block;
            }

            .tabs-left > .nav-tabs > li{
                float: none;
            }

            .tabs-left > .nav-tabs > li > a {
                 min-width: 74px;
                 margin-right: 0;
                 margin-bottom: 3px;
            }

            .tabs-left > .nav-tabs {
                float: left;
                margin-right: 19px;
                border-right: 1px solid #ddd;
            }

            .tabs-left > .nav-tabs > li > a {
                margin-right: -1px;
                -webkit-border-radius: 4px 0 0 4px;
                -moz-border-radius: 4px 0 0 4px;
                border-radius: 4px 0 0 4px;
            }

            .tabs-left > .nav-tabs > li > a:hover,
            .tabs-left > .nav-tabs > li > a:focus {
                border-color: #eeeeee #dddddd #eeeeee #eeeeee;
            }

            .tabs-left > .nav-tabs .active > a,
            .tabs-left > .nav-tabs .active > a:hover,
            .tabs-left > .nav-tabs .active > a:focus {
                border-color: #ddd transparent #ddd #ddd;
                *border-right-color: #ffffff;
            }
            
            #profilepic
            {
                width: 250px;
                heigth: 250px;
            }
        </style>
        
        <link type="text/css" rel="stylesheet" href="home_page.css" />
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
<body>
    

     <div class="container">
<?php
 session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  if (!isset($_SESSION['user_id']) ) { 
    echo '<p class="login">Please <a href="index.php">log in</a> to access this page.</p>';
    exit();
  }
  if ($_SESSION['user_id'] > 1000) {
    echo 'Cannot access this page. You are not a patient!';
    exit();
  }
  if (isset($_SESSION['user_id'])) {   
    echo('<p align="right">Logged in as ' . $_SESSION['username'] . '<a href="Patient_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
  }          
?>  
             <!-- HEADER BAR -->
      <?php include("header_bar.php"); ?>

      <hr>
    <ul style="list-style-type: none;" style="width: 275px;">
        <li>
              
        </li>
        <li>
            <img src="images/img1.jpg" id="profilepic">
        </li>
    </ul>
    

        <div class="container">
        <!-- /row -->
          
            <div class="row">
                <div><!--class="col-md-6" this was here-->
                    <h3 class=""></h3> 

                <!-- tabs left -->
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#a" data-toggle="tab" class="" contenteditable="false">My Info</a>
                                </li>
                                <li class=""><a href="#b" data-toggle="tab" class="" contenteditable="false">My Dentist</a>
                                </li>
                                <li class=""><a href="#c" data-toggle="tab" class="" contenteditable="false">Past Appointments</a>
                                </li>
                                <li class=""><a href="#d" data-toggle="tab" class="" contenteditable="false">Future Appointments</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <?php
                                    require_once('connectvars.php');

                                    // Connect to the database
                                    $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

                                    //$connection = mysql_connect("sfsuswe.com", "rsanch", "ASDasdqwe");
                                    if (!$connection) {
                                      die("Database connection failed:" . mysql_error());
                                    }

                                    $database = mysql_select_db(DB_NAME, $connection);
                                    if (!$database) {
                                      die("Database selection failed:" . mysql_error());
                                    }                                 
                                
                                
                                //FIRST TAB: My Info
                                echo "<div class=\"tab-pane active\" id=\"a\">";
                                
                                /******** using user's user_id that is logged in   */
                                $query = "SELECT * FROM patient_data WHERE user_id = '$_SESSION[user_id]' ";
                                $data = mysql_query($query);  
                                if (!$data) {
                                    die("query failed" . mysql_error());
                                }                                 
                                                             
                                
                                //should only do once, since user_id is specific for only 1 patient
                                if (mysql_num_rows($data) == 1) {

                                     $row = mysql_fetch_array($data);
                                     echo "Name: " . ($row['firstName']) . " ";
                                     echo ($row['lastName']) . "<br><br>";

                                     echo "Address: " . ($row['address']) . "<br><br>";
                                     echo "Telephone #: " . ($row['telephoneNumber']) . "<br><br>";
                                     echo "Email: " . ($row['email']) . "<br><br>";
                                 }                                
                                    
                                echo"</div>";
                                
                                //SECOND TAB: My dentists
                                echo "<div class=\"tab-pane\" id=\"b\">My Dentist(s)<br><br>";
                                
                                /*
                                 * From current patient's user_id, it is sent to be searched in 
                                 * "list_of_patients" in order to find dentists that patient is
                                 * associated with.
                                 * 
                                 * Afterwards, while loop reads through dentist_id from "list_of_patients"
                                 * and prints out info of each of the patient's dentists
                                 */
                                
                                $queryx = "SELECT * FROM list_of_patients WHERE patient_id = '$_SESSION[user_id]' ";
                                $datax = mysql_query($queryx);  
                                if (!$datax) {
                                    die("query failed" . mysql_error());
                                }                                 
                                                             
                                
                                //
                                while ($rowx = mysql_fetch_array($datax)) {

                                    $query = "SELECT * FROM dentist_data WHERE d_user_id = '$rowx[dentist_id]' ";
                                    
                                    $data = mysql_query($query);
                                    if (!$data) {
                                        die("query failed" . mysql_error());
                                    }  
                                    
                                    $row = mysql_fetch_array($data);
                                     
                                     echo "Name: " . ($row['d_firstName']) . " ";
                                     echo ($row['d_lastName']) . "<br><br>";

                                     echo "License #: " . ($row['d_licenseNumber']) . "<br>";                                     
                                     echo "Address: " . ($row['d_address']) . "<br>";
                                     echo "Telephone #: " . ($row['d_telephoneNumber']) . "<br>";
                                     echo "Email: " . ($row['d_email']) . "<br>";
                                     echo "Specialties: " . ($row['d_specialties']) . "<br>"; 
                                     echo "<br><br>";
                                 }                                  
                                
                                echo "</div>";
                                
                                //THIRD TAB: My Past APpointments
                                echo "<div class=\"tab-pane\" id=\"c\">";
                                
                                $queryy = "SELECT * FROM appointments WHERE user_id = '$_SESSION[user_id]' ";
                                $datay = mysql_query($queryy);  
                                if (!$datay) {
                                    die("query failed" . mysql_error());
                                }   
                                
                                //Reading each appointment
                                while ($rowy = mysql_fetch_array($datay)) {

                                    //TODO: PRINT ONLY IF PAST APPOINTMENTS
                                    $query = "SELECT * FROM dentist_data WHERE d_user_id = '$rowy[d_user_id]' ";
                                    
                                    $data = mysql_query($query);
                                    if (!$data) {
                                        die("query failed" . mysql_error());
                                    }  
                                    
                                    $row = mysql_fetch_array($data);
                                     
                                     echo "Appointment with: " . ($row['d_firstName']) . " ";
                                     echo ($row['d_lastName']) . "<br><br>";

                                     echo "Date: " . ($rowy['appt_Date']) . "<br>";
                                     echo "Time: " . ($rowy['appt_Time']) . "<br>";
                                     echo "Purpose: " . ($rowy['purpose']) . "<br>";
                                      
                                     echo "Address: " . ($row['d_address']) . "<<br>";
                                     echo "Telephone #: " . ($row['d_telephoneNumber']) . "<br>";
                                     echo "Email: " . ($row['d_email']) . "<br>";

                                     echo "<br>";
                                 }                                      
                                
                                
                                
                                
                                echo "</div>";
                                
                                
                                //FOURTH TAB: My Future Appointments
                                echo "<div class=\"tab-pane\" id=\"d\">";
                                echo "</div>";
                                ?>
                            </div>
                        </div>
    <!-- /tabs -->
                </div>
            </div>
    <!-- /row -->
        </div> 
        <hr class="">
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/js/bootstrap.min.js"></script>


        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
            $(document).ready(function() {
            });
        
        </script>
        
    </body>
</html>