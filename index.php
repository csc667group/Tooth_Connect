

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
          <li class='active'>
          <?php 
             if (isset($_SESSION['user_id'])) {
                 if($_SESSION['user_id'] < 1000) {          
                    echo '<a href="Patient_Profile.php"><i class="fa fa-home"></i> Home</a>';
                 } else if ($_SESSION['user_id'] > 1000) {
                    echo '<a href="Dentist_Profile.php"><i class="fa fa-home"></i> Home</a>';
                 }
             } else {
                 echo '<a href="index.php"><i class="fa fa-home"></i> Home</a>';
             }
          ?>
          </li>
          <li><a href="about_page.php"><i class="fa fa-book"></i> About</a></li>
          <li><a href="contact_page.php"><i class="fa fa-phone"></i> Contact</a></li>
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
//  $query = "INSERT INTO patient_data VALUES ('rafael2', 'pjjass')"; // where city = '$city'"; //You don't need a ; like you do in SQL
//  $result = mysql_query($query) or die("Query failed<br/><br/>" . mysql_error());

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";  
 
  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
  //  echo '<h2 style = "align=right;">Currently not logged in</h2>';
    if (isset($_POST['submit'])) {
 //       echo 'submit is clicked';
      // Grab the user-entered log-in data
//      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
//      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];
  //      echo 'value of user_username is ' . $user_username. ' ' ;
  //      echo 'value of password is ' . $user_password. ' ' ;
      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT * FROM patient_data WHERE username='$user_username' AND password='$user_password'";
        $data = mysql_query($query);
        if (!$data) {
            die("query failed" . mysql_error());
        }       
    //    echo '<br/> number of rows ' .mysql_num_rows($data) . '. ';
        if (mysql_num_rows($data) == 1) {
          echo '<br/> more than one row of data ';
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysql_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Patient_Profile.php';
          header('Location: ' . $home_url);
      //    echo 'user is logged in successfully';
        }
        else {
          // The username/password are incorrect so set an error message
          echo "<font color='red'>You must enter a valid username and password to log in.</font>";
        }
      }
      else {
           if ((empty($user_username)) && (!empty($user_password)) ) {
               echo "<font color='red'>Username field is empty.</font>";
           } else if ( ((empty($user_password)) && (!empty($user_username))) ) {
               echo "<font color='red'>Password field is empty.</font>";
           } else {
        // The username/password weren't entered so set an error message
             echo "<font color='red'>Username and Password field are empty.</font>";
           }
      }
    } else {
     //   echo 'submit not working';
    }
  } else {
    echo('<p class="login"><h2 style = "align=right;">You are logged in as</h2> ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
  }

?>

<br/>
<form class="form-horizontal" role="form" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control input-small" placeholder="username" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control input-small" placeholder="Password" name="password">
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
          <input type="submit" value="Sign in" name="submit" />
          <a href="selection_page.php"><input type="button" value="Register"  onclick="selection_page.html"/></a>
<!-- <a href="#" class="btn btn-info"><i class="fa fa-pencil"></i> Sign in</a>
<a href="selection_page.html" class="btn btn-info"><i class="fa fa-book"></i> Register</a>     
-->

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
