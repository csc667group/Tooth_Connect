

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Dentist Profile</title>
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
                height: 250px;
            }
        </style>
        
        <link type="text/css" rel="stylesheet" href="home_page.css" />
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
<body>
        <div class="container">
<?php/*
 //session_start();

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
  if ($_SESSION['user_id'] < 1000) {
    echo 'Cannot access this page. You are not a dentist!';
    exit();
  }
  if (isset($_SESSION['user_id'])) {   
    echo('<p align="right">Logged in as ' . $_SESSION['username'] . '<a href="Patient_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
  }*/
?>

            <?php include("header_bar.php"); ?>
    <hr>
         
         
         
         <ul style="list-style-type: none; width: 275px;">
        <li>
          <?php 
            //echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
          ?>
        </li>
        <li>
            <img src="images/img1.jpg" id="profilepic">
        </li>
    </ul>
    

       <!-- <div class="container">-->
        <!-- /row -->
          
            <div class="row">
                <div><!--class="col-md-6" this was here-->
                    <h3 class=""></h3> 

                <!-- tabs left -->
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#a" data-toggle="tab" class="" contenteditable="false">My Info</a>
                                </li>
                                <li class=""><a href="#b" data-toggle="tab" class="" contenteditable="false">My Patients</a>
                                </li>
                                <li class=""><a href="#c" data-toggle="tab" class="" contenteditable="false">Past Appointments</a>
                                </li>
                                <li class=""><a href="#d" data-toggle="tab" class="" contenteditable="false">Future Appointments</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                
                                <?php
                                
                                /*  TO DO: CONNECT WITH DENTIST_DATA
                                      I tried my best to implement this (4 hours), but it still doesnt work...
                                 *    Also, how are we going to be implementing dentist log in? 
                                 *      i saw that you had a check for user_id < 1000?
                                 *      but we have seperate ids for dentist and users for the purpose
                                 *      of connecting the two together in order to "interact"
                                 * 
                                */

/*                                    require_once('connectvars.php');

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
                                
*/                                
                                //FIRST TAB: Dentist info
                                echo "<div class=\"tab-pane active\" id=\"a\">";
                              
                              
                                /******** replace 1 with actual d_user_id that is logged in   */
/*                                $query = "SELECT * FROM dentist_data WHERE d_user_id = 1"; //'$_SESSION[user_id]' ";
                                $data = mysql_query($query); 
                     
                                if (!$data) {
                                    die("query failed" . mysql_error());
                                }               
                                //should only do once, since d_user_id is specific for only 1 dentist
                                if (mysql_num_rows($data) == 1) {
                                    echo "Name: " . ($row['d_firstName']) . " ";
                                    echo ($row['d_lastName']) . "<br><br>";

                                    echo "License #: " . ($row['d_licenseNumber']) . "<br><br>";
                                    echo "Address: " . ($row['d_address']) . "<br><br>";
                                    echo "Telephone #: " . ($row['d_telephoneNumber']) . "<br><br>";
                                    echo "Email: " . ($row['d_email']) . "<br><br>";
                                    echo "Specialties: " . ($row['d_specialties']) . "<br><br>";  
                                }
*/                                    
                                
                                echo "</div>";
                                
                                //SECOND TAB: List of dentist's patients
                                echo "<div class=\"tab-pane\" id=\"b\">";
                                    
                                    // Here, dentist is able to see a list of patients (user_id, name, 
                                    //   and be able to modify patients' "medical records"
                                    //   i.e. update patient's history with checkup/wisdom teeth removal, etc
                                
                                
                                
                                    
                                
                                echo "</div>";
                                
                                //THIRD TAB: Past appointments
                                echo "<div class=\"tab-pane\" id=\"c\">";
                                    
                                     
                                        //Here, dentist is able to see a list of past appointments
                                        //from his patients' history.
                                    
                                    
                                echo "</div>";
                                
                                //FOURTH TAB: Future appointments
                                echo "<div class=\"tab-pane\" id=\"d\">";
                                
                                    /* 
                                        Dentist can assign patient future appointment date,
                                        details for the appointment, etc.
                                    
                                    */
                                    
                                echo "</div>"
                                
                                ?><!--<div class="tab-pane active" id="a">Lorem ipsum dolor sit amet, charetra varius quam sit amet vulputate. Quisque
                    mauris augue, molestie tincidunt condimentum vitae, gravida a libero.</div>
                <div
                class="tab-pane" id="b">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor
                    accumsan. Aliquam in felis sit amet augue.</div>
            <div class="tab-pane" id="c">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra
                varius quam sit amet vulputate. Quisque mauris augue, molestie tincidunt
                condimentum vitae.</div>-->


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