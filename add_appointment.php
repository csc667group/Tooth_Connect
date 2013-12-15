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
                    
    if (!isset($_SESSION['user_id']) ) { 
      echo '<p class="login">Please <a href="index.php">log in</a> to access this page.</p>';
      exit();
    }
    if ($_SESSION['user_id'] < 1000) {
      echo 'Cannot access this page. You are not a dentist!';
      exit();
    }
        if (isset($_SESSION['user_id'])) {   
          echo('<p align="right">Logged in as ' . $_SESSION['email'] . '<a href="Patient_Profile.php"> [<i class="fa fa-user"></i> Profile] </a>     ' . '<a href="logout.php"> [<i class="fa fa-minus-circle"></i> Log out]</a></p>');
        }   
  }
?>

      <?php include("header_bar.php"); ?>
        

    <hr>

<h2 align="center"> Send Message </h2>    


<?php

  require_once('connectvars.php');

    //TO DO: WHEN USER CLICKS ON EMAIL IN PROFILE PAGE, EMAIL SHOULD BE SENT HERE

    if(isset($_POST['submit'])){
        
        /* STEVEN SHOULD DO THIS SINCE HE DID REQUEST APPT. SIMILAR.*/
        echo YAY;
        
    }
    
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
