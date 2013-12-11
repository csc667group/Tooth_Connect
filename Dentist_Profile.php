

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
        <!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap.min.css" rel="stylesheet">-->
        
        <!-- Bardhyl's link-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
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
            }
        </style>
        
        <link type="text/css" rel="stylesheet" href="home_page.css" />
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
<body>
        <div class="container">
                      <?php
                       //session_start();

                        // If the session vars aren't set, try to set them with a cookie
                        if (!isset($_SESSION['user_id'])) {
                          if (isset($_COOKIE['user_id']) && isset($_COOKIE['email'])) {
                            $_SESSION['user_id'] = $_COOKIE['user_id'];
                            $_SESSION['email'] = $_COOKIE['email'];
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
                          echo('<p align="right">Logged in as ' . $_SESSION['email'] . '<a href="Dentist_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
                        }
                      ?>

                                  <?php include("header_bar.php"); ?>
                          <hr>
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
?>
  <?php                       
                        //add appointment to appointments and remove from pending
                        if (isset($_POST['approve_appt'])) {
                                        $d_user_id=$_SESSION['user_id'];
                                        $user_id = $_POST['p_user_id'];
                                        $date = $_POST['appt_date'];
                                        $time = $_POST['appt_time'];
                                        $purpose = $_POST['purpose'];
                                        $quer = "INSERT INTO appointments (user_id, d_user_id, appt_date, appt_time, purpose)
                                            VALUES ( '$user_id', '$d_user_id', '$date', '$time', '$purpose')";
                                        $quer1 = "DELETE FROM temp_appointments WHERE user_id='$user_id' AND d_user_id='$d_user_id'
                                            AND appt_date='$date' AND appt_time='$time' AND purpose='$purpose'";
                                        mysql_query($quer);
                                        mysql_query($quer1);
                                        

                                    }
                                    
                        //decline appointment and remove from pending
                        if (isset($_POST['decline_appt'])) {
                                        $d_user_id=$_SESSION['user_id'];
                                        $user_id = $_POST['p_user_id'];
                                        $date = $_POST['appt_date'];
                                        $time = $_POST['appt_time'];
                                        $purpose = $_POST['purpose'];
                                        $quer = "DELETE FROM temp_appointments WHERE user_id='$user_id' AND d_user_id='$d_user_id'
                                            AND appt_date='$date' AND appt_time='$time' AND purpose='$purpose'";
                                        mysql_query($quer);
                                        

                                    }
                         //add a patient to current doctors list of patients
                         if (isset($_POST['add_patient'])) {
                                        $d_user_id=$_SESSION['user_id'];
                                        $user_id = $_POST['p_user_id'];
                                        $quer = "INSERT INTO list_of_patients (dentist_id, patient_id)  
                                            VALUES ('$d_user_id', '$user_id')";
                                        mysql_query($quer);
                                       
                         }
                         //Remove's a patient from dentists list of patients
                         if (isset($_POST['remove_patient'])) {
                                        $d_user_id=$_SESSION['user_id'];
                                        $user_id = $_POST['p_user_id'];
                                        $quer = "DELETE FROM list_of_patients WHERE dentist_id='$d_user_id' AND patient_id='$user_id'";
                                        mysql_query($quer);
                                        
                         }
                         //schedule an appointment
                         if (isset($_POST['create_appt'])) {
                                        $user_id = $_SESSION['user_id'];
                                        $p_user_id = $_POST['patient'];
                                        $appt_date = $_POST['date'];
                                        $appt_time = $_POST['time'];
                                        $purpose = $_POST['purpose'];
                                        $quer = "INSERT INTO appointments (d_user_id, user_id, appt_date, appt_time, purpose)
                                            VALUES ( '$user_id', '$p_user_id', '$appt_date', '$appt_time', '$purpose')";
                                        mysql_query($quer);

                                    }
?>
         
         
                   <ul style="list-style-type: none; width: 275px;">
                      <li>
                        <?php 
                          //echo('<p class="login">You are logged in as ' . $_SESSION['email'] . '. <a href="logout.php">Log out</a>.</p>');
                        ?>
                      </li>
                      <li>
                          <img src="images/img1.jpg" id="profilepic">
                      </li>
                    </ul>
    

                          <br>                 
            <!-- Search query -->                
            <form  method="post" action="Dentist_Profile.php?go"   id="searchform"> 
	      <input  type="text" name="name"> 
	      <a href="Dentist_Profile.php#search"><input  type="submit" name="submit" value="Search for Patient" ></a> 
	    </form> 
            <?php
                                 
            //Search for patients and add them to your list of patients
            if(isset($_POST['submit'])){ 
                if(isset($_GET['go'])){ 
                    if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){ 
                        $name=$_POST['name']; 
                        $sql="SELECT firstname, lastname, user_id FROM patient_data WHERE firstname LIKE '%" . $name .  "%' OR lastname LIKE '%" . $name ."%'"; 	  
                        $result=mysql_query($sql);   //-create  while loop and loop through result set 
                        while($row=mysql_fetch_array($result)){ 
                            $FirstName  =$row['firstname']; 
                            $LastName=$row['lastname']; 
                            echo  "".$FirstName . " " . $LastName ."";
                            echo "<form method=\"post\" >
                                    <input type=\"hidden\" name=\"p_user_id\" value=\"".$row['user_id']."\">
                                    <input type=\"submit\" id=\"add_patient\" name=\"add_patient\" value=\"Add To Patients\">  
                                  </form>";
                        } 
                    } else{ 
                        echo  "<p>Please enter a search query</p>"; 
                    } 
                } 
            } ?>
       <!-- <div class="container">-->
        <!-- /row -->
          
            <div class="row">
                
                  <h3 class=""></h3> 

                       <!-- tabs left -->
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#a" data-toggle="tab" class="" contenteditable="false">My Info</a>
                        </li>
                        <li class=""><a href="#b" data-toggle="tab" class="" contenteditable="false">My Patients</a>
                        </li>
                        <li class=""><a href="#r" data-toggle="tab" class="" contenteditable="false">Appointment Management</a>
                        </li>
                        <li class=""><a href="#c" data-toggle="tab" class="" contenteditable="false">Past Appointments</a>
                        </li>
                        <li class=""><a href="#d" data-toggle="tab" class="" contenteditable="false">Future Appointments</a>
                        </li>
                    </ul>

                     <!-- Content on the right side inserted in a column-->
                  <div class="col-md-8">   
                      <div class="tab-content">
                                
                                <?php  
                                
                          
                                //FIRST TAB: Dentist info
                                echo "<div class=\"tab-pane active\" id=\"a\">";
                              
                                /******** using user's user_id that is logged in   */
                                $queryA = "SELECT * FROM dentist_data WHERE user_id = '$_SESSION[user_id]' ";
                                $dataA = mysql_query($queryA);  
                                if (!$dataA) {
                                    die("query failed" . mysql_error());
                                }                                 
                                                             
                                
                                //should only do once, since user_id is specific for only 1 patient
                                if (mysql_num_rows($dataA) == 1) {

                                     $rowA = mysql_fetch_array($dataA);

                                     echo "<strong>Name:</strong> " . ($rowA['firstname']) . " ";
                                     echo ($rowA['lastname']) . "</strong><br>";
                                     echo "<strong>License #:</strong> " . ($rowA['licensenumber']) . "<br>";
                                     echo "<strong>Specialties:</strong> " . ($rowA['d_specialties']) . "<br>"; 
                                     echo "<address> <strong>Address:</strong>". ($rowA['address']) .  ", "
                                     .($rowA['city']) .", ".($rowA['state']) . " " . ($rowA['zipcode']) .
                                             "<br>
                                     <span class='glyphicon glyphicon-earphone'></span>&nbsp;" . ($rowA['phone']) . "<br>
                                     <span class='glyphicon glyphicon-envelope'></span><a href='mailto:#'>&nbsp;" . ($rowA['email']) . "</a></address>";
                                     echo "<hr>";
                                 }   
                                 
                                 echo "<br>";
                                echo "<form action = \"edit_info.php\">";
                                
                                /*
                                 * GOES TO editinfo BUTTON 
                                 * form action = "edit_info.php"
                                 * 
                                 * edit_info.php goes back to profile_page 
                                 * after user edits info
                                 */                                   
                                
                                    echo "<input type=\"submit\" value=\"Edit Account Information\" id=\"editinfo\" name=\"editinfo\" />"; 
                                    
                                echo "</form>";                         
                                    
                                
                                echo "</div>";
                                
                                //SECOND TAB: List of dentist's patients
                                echo "<div class=\"tab-pane\" id=\"b\">";
                                    
                                    // Here, dentist is able to see a list of patients (user_id, name, 
                                    //   and be able to modify patients' "medical records"
                                    //   i.e. update patient's history with checkup/wisdom teeth removal, etc

                                echo "<table border = \"1\">";
                                echo "<tr>";
                                echo "<th>Patient's Name</th>
                                      <th>Address</th>
                                      <th><span class='glyphicon glyphicon-earphone'></span>Phone Number</th>
                                      <th><span class='glyphicon glyphicon-envelope'></span>Email</th>
                                      <th>Remove Patient</th>";
                                echo "</tr>";


                                $queryB = "SELECT * FROM list_of_patients WHERE dentist_id = '$_SESSION[user_id]' ";
                                $dataB = mysql_query($queryB);  
                                if (!$dataB) {
                                    die("query failed" . mysql_error());
                                }                                 
                                                             
                                
                                
                                while ($rowB = mysql_fetch_array($dataB)) {

                                    $queryX = "SELECT * FROM patient_data WHERE user_id = '$rowB[patient_id]' ";
                                    
                                    $dataX = mysql_query($queryX);
                                    if (!$dataX) {
                                        die("query failed" . mysql_error());
                                    }  
                                    
                                    $rowX = mysql_fetch_array($dataX);
                                     
                                     echo "<tr>";
                                     echo "<td><strong>"; 

                                     $fullname = ($rowX['firstname']) . " " . ($rowX['lastname']);


                                     $p_user_id = $rowX['user_id'];
                                     echo "<a href= \"patient_info.php?p_user_id=$p_user_id\">".$fullname."</a>";


                                    echo "</strong></td>";



                                     echo "<td>". ($rowX['address']) .  ",<br>"
                                     .($rowX['city']) .", ".($rowX['state']) . " " . ($rowX['zipcode']) . 
                                     "</td>

                                     <td>" . ($rowX['phone']) . "</td>

                                     <td><a href='mailto:" . ($rowX['email']) . "'>" . ($rowX['email']) . "</a></td>";


                                    echo "<td>";
                                     

                                     echo "<form method=\"post\">
                                                <input type=\"hidden\" name=\"p_user_id\" value=\"".$rowX['user_id']."\">
                                                <input type=\"submit\" value=\"Remove Patient\"  name=\"remove_patient\">
                                          </form>";

                                     echo "</td><hr>";


                                     echo "</tr>";
                                      
                                 }                                 
                                
                                
                                    
                                echo "</table>";
                                echo "</div>";
                                
                                //TAB:Appointment Management
                                echo "<div class=\"tab-pane\" id=\"r\">";
                                
                                /******** using user's user_id that is logged in   */
                                $queryR = "SELECT * FROM dentist_data WHERE user_id = '$_SESSION[user_id]' ";
                                $dataR = mysql_query($queryR);  
                                if (!$dataR) {
                                    die("query failed" . mysql_error());
                                }                                 
                                if (mysql_num_rows($dataR) == 1) {
                                  //View current requests.
                                    $q="SELECT * FROM temp_appointments WHERE d_user_id = '$_SESSION[user_id]' ";
                                    $q2=  mysql_query($q);
                                    echo "<h4>Appointment Requests:</h4><hr>";
                                    //echo "<h6></h6><hr>"; Use this line to add a footer like thing Ex: ***I can do look like this***
                                    echo "<table id=\"currentrequeststable\" style=\"border:5px;\">
                                        <tr>
                                            <th style=\"width:200px;\">Patient</th>
                                            <th style=\"width:200px;\">Date</th>
                                            <th style=\"width:100px;\">Time</th>
                                            <th style=\"width:600px;\">Purpose</th>
                                        </tr>";
                                    //view records and allow dentist to approve or decline each requested appointments
                                        while ($rowq = mysql_fetch_array($q2)) {
                                            $p = "SELECT * FROM patient_data WHERE user_id = '$rowq[user_id]'  ";
                                            $p2 = mysql_query($p);
                                            $p3 = mysql_fetch_assoc($p2);
                                            echo "<tr>
                                                <td>".$p3['firstname']." ".$p3['lastname']."</td>
                                                <td>".$rowq['appt_date']."</td>
                                                <td>".$rowq['appt_time']."</td>
                                                <td>".$rowq['purpose']."</td>
                                            </tr>
                                            <tr>
                                                <td colspan=\"4\"><div class=\"form-group\">
                                                    <form method=\"post\">
                                                        <input type=\"hidden\" name=\"p_user_id\" value=\"".$rowq['user_id']."\">
                                                        <input type=\"hidden\" name=\"appt_date\" value=\"".$rowq['appt_date']."\">
                                                        <input type=\"hidden\" name=\"appt_time\" value=\"".$rowq['appt_time']."\">
                                                        <input type=\"hidden\" name=\"purpose\" value=\"".$rowq['purpose']."\">
                                                        <input type=\"submit\" value=\"Approve Appointment\"  name=\"approve_appt\">
                                                        <input type=\"submit\" value=\"Decline Appointment\"  name=\"decline_appt\">
                                                    </form>
                                                </td></div>
                                            </tr>";
                                        }
                                        echo "</table><br>";
                                    echo "<h4>Schedule Appointment:</h4><hr>";
                                echo "<form id=\'request_appt\' role=\"form-inline\" role=\"form\" enctype=\"multipart/form-data\" method=\"post\" action=".$_SERVER['PHP_SELF'].">";
                                
                                /*
                                 * dentist inputs appointment info
                                 * sends to appointments to be
                                 * viewed by user 
                                 * 
                                 */       
                                $queryDID = "SELECT * FROM list_of_patients WHERE dentist_id = '$_SESSION[user_id]' ";
                                $dataID = mysql_query($queryDID);  
                                if (!$dataID) {
                                    die("query failed" . mysql_error());
                                } 
                                    echo "<div class=\"form-group\">";
                                    echo "<label for=\"patient\">Patient</label><br>";
                                    echo "<select class=\"form-control input-small\" name=\"patient\" style=\"width:200px;\">";
                                    while ($rowDID = mysql_fetch_array($dataID)) {
                                        $id=$rowDID['patient_id'];
                                        $getD = "SELECT * FROM patient_data WHERE user_id = '$rowDID[patient_id]'  ";
                                        $querydent = mysql_query($getD);
                                        $dname = mysql_fetch_assoc($querydent);
                                        if (!$dname) {
                                            die("query failed" . mysql_error());
                                        }
                                        echo "<option value=\"" . $id . "\">". $dname['firstname'] ." ". $dname['lastname'] ."</option>";
                                    }
                                    echo "</select></div>";
                                    
                                    echo "<div class=\"form-group\">";
                                    echo "<label for=\"date\">Date</label><br>";
                                    echo "<input class=\"form-control input-small\" type=\"date\" name=\"date\"></div>";
                                    
                                    echo "<div class=\"form-group\">";
                                    echo "<label for=\"time\">Time</label><br>";
                                    echo "<input class=\"form-control input-small\" type=\"time\" name=\"time\" value=\"00:00:00\"></div>";
                                    
                                    echo "<div class=\"form-group\">";
                                    echo "<label for=\"purpose\">Purpose</label><br>";
                                    echo "<input class=\"form-control input-small\" type=\"text\" name=\"purpose\" style=\"width:600px;\"></div>";
                                    
                                    echo "<input type=\"submit\" value=\"Create Appointent\" id=\"create_appt\" name=\"create_appt\" />"; 
                                    
                                echo "</form>";
                                echo "</div>";
                                }
                                
                                //THIRD TAB: Past appointments
                                echo "<div class=\"tab-pane\" id=\"c\">";
                                    
                                     
                                        //Here, dentist is able to see a list of past appointments
                                        //from his patients' history.
                                
                                //GETTING ONLY PAST APPOINTMENTS                               
                                $queryC = "SELECT * FROM appointments WHERE d_user_id = '$_SESSION[user_id]' 
                                                    AND appt_Date < CURRENT_DATE
                                                    ORDER BY appt_Date DESC";
                                $dataC = mysql_query($queryC);  
                                if (!$dataC) {
                                    die("query failed" . mysql_error());
                                }   
                                
                                //Reading each appointment
                                while ($rowC = mysql_fetch_array($dataC)) {
                                
                                    $queryY = "SELECT * FROM patient_data WHERE user_id = '$rowC[user_id]' ";
                                    
                                    $dataY = mysql_query($queryY);
                                    if (!$dataY) {
                                        die("query failed" . mysql_error());
                                    }  
                                    
                                    $rowY = mysql_fetch_array($dataY);
                                     
                                     echo "<strong>Patient: " . ($rowY['firstname']) . " ";
                                     echo ($rowY['lastname']) . "</strong><br>";

                                     echo "Date: " . ($rowC['appt_Date']) . "<br>";
                                     echo "Time: " . ($rowC['appt_Time']) . "<br>";
                                     
                                     echo "Telephone #: " . ($rowY['phone']) . "<br>";
                                     echo "Email: " . ($rowY['email']) . "<br>";
                                     
                                     echo "Purpose: " . ($rowC['purpose']) . "<br>";                                     
                                    
                                     echo "<br>";
                                 }                                      
                                                              
                                    
                                echo "</div>";
                                
                                //FOURTH TAB: Future appointments
                                echo "<div class=\"tab-pane\" id=\"d\">";
                                
                                
                                //GETTING ONLY FUTURE APPOINTMENTS
                                $queryD = "SELECT * FROM appointments WHERE d_user_id = '$_SESSION[user_id]' 
                                            AND appt_Date > CURRENT_DATE
                                            ORDER BY appt_Date";
                                $dataD = mysql_query($queryD);  
                                if (!$dataD) {
                                    die("query failed" . mysql_error());
                                }   
                                
                                //Reading each appointment
                                while ($rowD = mysql_fetch_array($dataD)) {
                                    
                                    $queryZ = "SELECT * FROM patient_data WHERE user_id = '$rowD[user_id]' ";
                                    
                                    $dataZ = mysql_query($queryZ);
                                    if (!$dataZ) {
                                        die("query failed" . mysql_error());
                                    }  
                                    
                                    $rowZ = mysql_fetch_array($dataZ);
                                     
                                     echo "<strong>Appointment with: " . ($rowZ['firstname']) . " ";
                                     echo ($rowZ['lastname']) . "</strong><br>";

                                     echo "Date: " . ($rowD['appt_Date']) . "<br>";
                                     echo "Time: " . ($rowD['appt_Time']) . "<br>";
                                     
                                     echo "Address: " . ($rowZ['address']) . "<br>";
                                     echo "Telephone #: " . ($rowZ['phone']) . "<br>";
                                     echo "Email: " . ($rowZ['email']) . "<br>";
                                     
                                     echo "Purpose: " . ($rowD['purpose']) . "<br>";                                     

                                     echo "<br>";
                                 } 
                                echo "</div>";
                                
                                ?>

                        <!-- /right-content -->
                        </div>
                    <!-- /column -->
                    </div>
                <!-- /tabs-left -->
                </div>
            <!-- /row -->
            </div>
        <!-- /container -->
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