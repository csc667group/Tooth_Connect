
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

      <h3 align="center">Retrieving your Account Information</h3>
      
      <?php
          require_once('connectvars.php');
 
          $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
          if (!$connection) {
             die("Database connection failed:" . mysql_error());
          }
          $database = mysql_select_db(DB_NAME, $connection);
          if (!$database) {
             die("Database selection failed:" . mysql_error());
          }
          $email = $_GET['email'];
          if (isset($_POST['submit'])) {
 //     echo 'form submitted';
    // Grab the profile data from the POST
//    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
//    $password1 = mysql_real_escape_string($connection, trim($_POST['password1']));
//    $password2 = mysql_real_escape_string($connection, trim($_POST['password2']));
   
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if (!empty($email) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this email
      $query = "SELECT * FROM patient_data WHERE email = '$email'";
      $data = mysql_query($query);
      if(mysql_num_rows($data) == 0){
             $query = "SELECT * FROM dentist_data WHERE email='$email'";
             $data = mysql_query($query);
       } 
      if (mysql_num_rows($data) == 1) {
        // The email is unique, so insert the data into the database
        $query = "UPDATE patient_data SET password=SHA('$password1') WHERE email ='$email' ";
        mysql_query($query);

        // Confirm success with the user
        echo '<p>Your password has been successfully changed. You\'re now ready to <a href="index.php#signin">log in</a>.</p>';
        echo "<hr><div class=footer> <p>&copy; Copyrights 2013</p> </div>";
        mysql_close($connection);
        exit();
      }

      else {
        // An account already exists for this email, so display an error message
        echo "<font color='red'>Invalid email.</font>";
        $email = "";
      }
    }
    else {
      
      if ($password1 != $password2) {
          echo "<font color='red'>Password fields must be the same.<br/></font>";
      }
      if (empty($email) || empty($password1) || empty($password2)) {
            echo "<font color='red'>Missing fields.<br/></font>";
      }
       
    }
  }
//  echo 'form not submitted';
  mysql_close($connection);
?>
      
<form role="form-inline" role="form" method="post">

  <div class="form-group">
    <label for="exampleInputEmail1">Enter new password</label>
    <input type="password" class="form-control input-small"  name="password1" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Enter new password (Verify) </label>
    <input type="password" class="form-control input-small" name="password2" placeholder="Verify Password">
  </div>

  <input type="submit" value="Submit" id="submit" name="submit" />
  </form>


<hr>

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