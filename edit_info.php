

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

<h2 align="center"> Editing Info </h2>

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
  
        /*
         * Here, SQL retrieves data of current user,
         * and displays it in edit_info form
         */
  
        $t_user_id = $_SESSION['user_id']; //temporary variable for current user_id

          if($t_user_id < 1000) {    
              $query = "SELECT * FROM patient_data WHERE user_id = '$t_user_id'";
          } 
          else {
              $query = "SELECT * FROM dentist_data WHERE user_id = '$t_user_id'";
          }  

          $data = mysql_query($query);
          $row = mysql_fetch_array($data);    
    
        //TO BE DISPLAYED INITIALLY IN FORM
        $firstname = $row['firstname'];  
        $lastname = $row['lastname'];  
        $address = $row['address'];      
        $city = $row['city'];      
        $state = $row['state'];      
        $zipcode = $row['zipcode'];      
        $phone = $row['phone'];     
  ?>

<?php
  //SUBMITTED EDIT
  if (isset($_POST['submit'])) {

        $firstname = $_POST['firstname'];  
        $lastname = $_POST['lastname'];  
        $address = $_POST['address'];      
        $city = $_POST['city'];      
        $state = $_POST['state'];      
        $zipcode = $_POST['zipcode'];      
        $phone = $_POST['phone'];  


        //$t_user_id = $_SESSION['user_id']; //temporary variable for current user_id

         // if ($t_user_id === $row['user_id']) {
            // EMAIL SHOULD NOT HAVE BEEN CHANGED => ALWAYS TRUE

                if($_SESSION['user_id'] < 1000) {  
                    $query = "UPDATE patient_data 
                                SET firstname = '$firstname',
                                    lastname = '$lastname',
                                    address = '$address',
                                    city = '$city',
                                    state = '$state',
                                    zipcode = '$zipcode',
                                    phone = '$phone'                                    
                              WHERE user_id = $t_user_id";
                }

                else{
                    $query = "UPDATE dentist_data 
                                SET firstname = '$firstname',
                                    lastname = '$lastname',
                                    address = '$address',
                                    city = '$city',
                                    state = '$state',
                                    zipcode = '$zipcode',
                                    phone = '$phone'
                              WHERE user_id = $t_user_id";           
                }
                mysql_query($query);

            // Editing succeded
                if($t_user_id < 1000) {  
                    echo 'Editing information completed. <a href="Patient_Profile.php">Return to profile</a>.';
                }
                else{
                    echo 'Editing information completed. <a href="Dentist_Profile.php">Return to profile</a>.';            
                }
                mysql_close($connection);
                exit();
           // }


  }
  
  mysql_close($connection);
?>


<form role="form-inline" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    
  <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" class="form-control input-small" id="firstname" name="firstname" 
           value= "<?php if (!empty($row['firstname'])) {echo $row['firstname'];} ?>" placeholder ="First Name">
  </div>
    
  <div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" class="form-control input-small" name="lastname" 
           value= "<?php if (!empty($row['lastname'])) {echo $row['lastname'];} ?>" placeholder="Last Name">
  </div>  
    
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control input-small" name="address" 
           value="<?php if (!empty($row['address'])) {echo $row['address'];} ?>" placeholder="Address">
  </div>
    
  <div class="form-group">
    <label for="city">City</label>
    <input type="text" class="form-control input-small" name="city" 
           value="<?php if (!empty($row['city'])) {echo $row['city'];} ?>" placeholder="City">
  </div>
    
  <div class="form-group">
    <label for="state">State</label>
    <input type="text" class="form-control input-small" name="state" 
           value="<?php if (!empty($row['state'])) {echo $row['state'];} ?>" maxlength="2" placeholder="State">
  </div>
    
  <div class="form-group">
    <label for="zipcode">Zipcode</label>
    <input type="text" class="form-control input-small" name="zipcode" 
           value="<?php if (!empty($row['zipcode'])) {echo $row['zipcode'];} ?>" maxlength="5" placeholder="Zipcode">
  </div>
    
  <div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control input-small" name="phone" 
           value="<?php if (!empty($row['phone'])) {echo $row['phone'];} ?>" maxlength="10" placeholder="Phone Number">
  </div>
    
    
  <input type="submit" value="Finish Editing" id="submit" name="submit" />
  
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