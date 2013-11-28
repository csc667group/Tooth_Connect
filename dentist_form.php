

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
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
      
    }
  }
  if (isset($_SESSION['user_id'])) {   
                    
    if($_SESSION['user_id'] < 1000) {          
      echo('<p align="right">Logged in as ' . $_SESSION['username'] . '<a href="Patient_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
      } else {
      echo('<p align="right">Logged in as ' . $_SESSION['username'] . '<a href="Dentist_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
      }
  } else {
      echo('<p align="right">You are not logged in | '. '<a href="index.php#signin"> Sign in </a> </p>');
  } 
?>

      <?php include("header_bar.php"); ?>
        

    <hr>

<h2 align="center"> Dentist Form </h2>

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

    $firstname = $_POST['firstname'];  
    $lastname = $_POST['lastname'];  
    $address = $_POST['address'];      
    $city = $_POST['city'];      
    $state = $_POST['state'];      
    $zipcode = $_POST['zipcode'];      
    $phone = $_POST['phone'];  
    $email = $_POST['email'];      
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
  
    if (!empty($username) && !empty($password1) && !empty($password2)&& ($password1 == $password2)  && !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM dentist_data WHERE username = '$username'";
      $data = mysql_query($query);
      if (mysql_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO dentist_data (username,password,firstname,lastname,address,email,phone)
            VALUES ( '$username', SHA('$password1'), '$firstname','$lastname','$address','$email','$phone')";
        mysql_query($query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="index.php#signin">log in</a>.</p>';

        mysql_close($connection);
        exit();
      }

      else {
        // An account already exists for this username, so display an error message
        echo "<font color='red'>An account already exists for this username. Please use a different address.</font>";
        $username = "";
      }
    }
    else {
      if (empty($username) || empty($password1) || empty($password2) || empty($email)) {
        echo "<font color='red'>Missing fields.<br/></font>";
      }
      if ($password1 != $password2) {
          echo "<font color='red'>Password fields must be the same.<br/></font>";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "<font color='red'> Enter a valid email.</font>";
      }
       
    }
  }
//  echo 'form not submitted';
  mysql_close($connection);
?>


<form role="form-inline" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" class="form-control input-small" id="firstname" name="firstname" value="<?php if (!empty($firstname)) {echo $firstname;} ?>"  placeholder="First Name">
  </div>
  <div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" class="form-control input-small" name="lastname" value="<?php if (!empty($lastname)) {echo $lastname;} ?>"placeholder="Last Name">
  </div>    
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control input-small" name="address" value="<?php if (!empty($address)) {echo $address;} ?>" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="city">City</label>
    <input type="text" class="form-control input-small" name="city" value="<?php if (!empty($city)) {echo $city;} ?>" placeholder="City">
  </div>
  <div class="form-group">
    <label for="state">State</label>
    <input type="text" class="form-control input-small" name="state" value="<?php if (!empty($state)) {echo $state;} ?>" maxlength="2" placeholder="State">
  </div>
  <div class="form-group">
    <label for="zipcode">Zipcode</label>
    <input type="text" class="form-control input-small" name="zipcode" value="<?php if (!empty($zipcode)) {echo $zipcode;} ?>" maxlength="5" placeholder="Zipcode">
  </div>
  <div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control input-small" name="phone" value="<?php if (!empty($phone)) {echo $phone;} ?>" placeholder="Phone Number">
  </div>
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="text" class="form-control input-small" name="email" value="<?php if (!empty($email)) {echo $email;} ?>" placeholder="Email Address">
  </div>

    
    
    <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control input-small" name="username" value="<?php if (!empty($username)) {echo $username;} ?>" placeholder="User name">
  </div>
  <div class="form-group">
    <label for="password1">Password</label>
    <input type="password" class="form-control input-small"  name="password1" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="password2">Password (Verify) </label>
    <input type="password" class="form-control input-small" name="password2" placeholder="Verify Password">
  </div>

  <input type="submit" value="Register" id="submit" name="submit" />
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