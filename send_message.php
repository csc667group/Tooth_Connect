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
        

    <hr>

<h2 align="center"> Send Message </h2>    


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

    //TO DO: WHEN USER CLICKS ON EMAIL IN PROFILE PAGE, EMAIL SHOULD BE SENT HERE

    if(isset($_POST['submit'])){

        
        /*********
         * 
        TO DO: HOW TO GET CURRENT DATE AND TIME AND INSERT INTO MESSAGE DATA TABLE
         * 
        ***************/
        $date = "2013-11-22";
        $time = "09:00:00";
        $message = $_POST['message']; //message user wrote
        
        $sender = $_SESSION['user_id'];  //sender is user currently logged in 
        $email = $_POST['email'];   //received from form when message submitted

        //checking if email being sent exists, or form has empty fields
        $queryA = "SELECT * FROM dentist_data WHERE email = '$email' ";        
        $queryB = "SELECT * FROM patient_data WHERE email = '$email' ";

        $dataA = mysql_query($queryA);
        $dataB = mysql_query($queryB);


        if(!empty($email) && !empty($message) && (mysql_num_rows($dataA) == 1 || mysql_num_rows($dataB) == 1)){

            if($sender < 1000){
                $patientID = $sender;
                $result = mysql_fetch_array($dataA);
                $dentistID = $result['user_id'];
            }  

            else{
                $dentistID = $sender;
                $result = mysql_fetch_array($dataB);
                $patientID = $result['user_id'];
            }

            $queryM = "INSERT INTO messages (dentist_id, patient_id, sender_id, date, time, message)
                        VALUES ('$dentistID', '$patientID', '$sender', '$date', '$time', '$message')";

            mysql_query($queryM);

            //MESSAGE HAS BEEN SENT

            //have an inbox be linked back... for now, go to profile

            echo "Message has been sent. Go back to ";

            if($sender < 1000){
                echo "<a href = \"Patient_Profile.php\">profile.</a>";
            }
            else{
                echo "<a href = \"Dentist_Profile.php\">profile.</a>";
            }

            mysql_close($connection);
            exit();
        }

        else{
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo "<font color='red'> Enter a valid email.</font>";
            }
            if (empty($email) || empty($message)) {
                echo "<font color='red'>Missing fields.<br/></font>";
            }
            if (mysql_num_rows($dataA) == 0 && mysql_num_rows($dataB) == 0){
                echo "<font color='red'>Email does not exist.<br/></font>";
            }
        }
    }
    mysql_close($connection);
?>


<form role="form-inline" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
        <label for="email">TO: </label>
        <input type="text" class="form-control input-small" name="email" value="<?php if (!empty($email)) {echo $email;} ?>" placeholder="Email Address">
    </div>

    <div class="form-group">
        <label for="message"></label>
        <input type="text" class="form-control input-small" name="message" placeholder="Add a message...">
    </div>

  <input type="submit" value="SEND" id="submit" name="submit" />
</form>

<br><hr>
     <div class="footer">
        <p>&copy; Copyrights 2013</p>
      </div>
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>

