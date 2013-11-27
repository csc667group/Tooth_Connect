

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


      <?php include("header_bar.php"); ?>
        

    <hr>

<h2 align="center"> Patient Form </h2>

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
  if (isset($_POST['submit'])) {
 //     echo 'form submitted';
    // Grab the profile data from the POST
//    $username = mysqli_real_escape_string($connection, trim($_POST['username']));
//    $password1 = mysql_real_escape_string($connection, trim($_POST['password1']));
//    $password2 = mysql_real_escape_string($connection, trim($_POST['password2']));
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM patient_data WHERE username = '$username'";
      $data = mysql_query($query);
      if (mysql_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO patient_data (username,password) VALUES ('$username', SHA('$password1') )";
        mysql_query($query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="index.php">log in</a>.</p>';

        mysql_close($connection);
        exit();
      }

      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    
      if ($password1 != $password2) {
          echo 'Password fields are different';
      }
       
    }
  }
//  echo 'form not submitted';
  mysql_close($connection);
?>


<form class="form-inline" role="form">
  <div class="form-group">
    <label for="exampleInputEmail2">First Name</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="First Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">Last Name</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Last Name">
  </div>
</form>

<form class="form-inline" role="form">
  <div class="form-group">
    <label for="exampleInputEmail2">Address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">City</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="City">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">State</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="State">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">Zipcode</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Zipcode">
  </div>

</form>


<form role="form-inline" role="form" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control input-small" id="exampleInputEmail1" name="username" placeholder="First Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="password" class="form-control input-small" id="password1" name="password1" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password (Verify) </label>
    <input type="password" class="form-control input-small" id="password2" name="password2" placeholder="Verify Password">
  </div>

  <input type="submit" value="Register" id="submit" name="submit" />
  </form>


<br><br><hr>

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