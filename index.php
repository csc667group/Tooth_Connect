<?php
  require_once('connectvars.php');

  $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

  //$connection = mysql_connect("sfsuswe.com", "rsanch", "ASDasdqwe");
  if (!$connection) {
    die("Database connection failed:" . mysql_error());
  }

  $database = mysql_select_db(DB_NAME, $connection);
  if (!$database) {
    die("Database selection failed:" . mysql_error());
  }

  //$city = $_GET['search'];

  $query = "INSERT INTO patient_data VALUES ('rafael2', 'pjjass')"; // where city = '$city'"; //You don't need a ; like you do in SQL
  $result = mysql_query($query) or die("Query failed<br/><br/>" . mysql_error());

  if (isset($_POST['register'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM mismatch_user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO mismatch_user (username, password, join_date) VALUES ('$username', SHA('$password1'), NOW())";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';

        mysqli_close($dbc);
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
    }
  }

  mysqli_close($dbc);


?>


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

    <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="home_page.html"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="about_page.html"><i class="fa fa-book"></i> About</a></li>
          <li><a href="contact_page.html"><i class="fa fa-phone"></i> Contact</a></li>
        </ul>
        <h3 class="muted">Website name</h3>
      </div>
      <hr>


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="http://www.frumsatire.net/wp-content/uploads/2013/01/dentist.png" alt="..." >
      <div class="carousel-caption">
        <h2> Haven't created an account yet? Register below    </h2>
      </div>
    </div>

    <div class="item">
      <img src="http://drjoh.com/wp-content/uploads/2012/03/teeth-whitening-dentist-clinton-twp-mi1.jpg" alt="..." >
      <div class="carousel-caption">
        <h2> Haven't created an account yet? Register below    </h2>
      </div>
    </div>
    
    <div class="item">
      <img src="http://www.dbastaffing.com/wp-content/uploads/2012/05/Dentist.gif" alt="..." >
      <div class="carousel-caption">
        <h2> Haven't created an account yet? Register below    </h2>
      </div>
    </div>
   

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>



<hr>

<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control input-small" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control input-small" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
<a href="#" class="btn btn-info"><i class="fa fa-pencil"></i> Sign in</a>
<a href="selection_page.html" class="btn btn-info"><i class="fa fa-book"></i> Register</a>     
    </div>
  </div>
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
