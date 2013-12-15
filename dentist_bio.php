
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

<?php
                          
      require_once('connectvars.php');

      echo "<hr>";

    if(isset($_GET['firstname'])){
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $query = "SELECT * FROM dentist_data WHERE firstname = '$firstname' AND lastname = '$lastname'";
    }

    else if(isset($_GET['d_user_id'])){
      $d_user_id = $_GET['d_user_id'];
      $query = "SELECT * FROM dentist_data WHERE user_id = $d_user_id";
    }


    $data = mysql_query($query);
    if(mysql_num_rows($data) == 1){
        $row = mysql_fetch_array($data);



       echo "<strong>Name:</strong>&nbsp; " . ($row['firstname']) . " ";
       echo ($row['lastname']) . "</strong><br>"; 
       
       echo "<address> <strong>Address:</strong>&nbsp;". ($row['address']) .  ", "
       .($row['city']) .", ".($row['state']) . " " . ($row['zipcode']) . 
       "<br>
       <span class='glyphicon glyphicon-earphone'></span>&nbsp;" . ($row['phone']) . "<br>
       <span class='glyphicon glyphicon-envelope'></span><a href='mailto:" . ($row['email']) . "'>&nbsp;" . ($row['email']) . "</a></address>";
       echo "<hr>";

        echo "<br><br><b>Background:</b><br><p>" . $row['bio'] . "</p><br>";
    }
    mysql_close($connection);  
   // exit();
?>
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