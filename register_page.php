<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

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
    <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li>
          <?php session_start();
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

<h2 align="center"> Register </h2>




<form role="form-inline" role="form">
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="first" class="form-control" id="exampleInputEmail1" placeholder="First Name">
  </div>
  <div class="form-group>
    <label for="exampleInputEmail1">Last Name</label>
    <input type="last" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
       <p><a href="selection_page.html" class="btn btn-primary" role="button" class="icon basket">Submit</a>      </form>








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