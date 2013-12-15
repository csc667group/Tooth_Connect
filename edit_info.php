

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

  define('GW_UPLOADPATH', 'images/');
  define('GW_MAXFILESIZE', 262144);      // 256 KB

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
        $email = $row['email']; 
  ?>

<?php
  //DELETE ACCOUNT instead of edit
    if (isset($_POST['delete_account'])) { 
        $querydelete="DELETE FROM patient_data WHERE user_id='$t_user_id'";
        mysql_query($querydelete);
        $logout_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/logout.php';
        header('Location: ' . $logout_url);
        mysql_close($connection);
        exit();     
    }

  //SUBMITTED EDIT
  if (isset($_POST['submit'])) {

      
        $profilepic = $_FILES['profilepic']['name'];
        $profilepic_type = $_FILES['profilepic']['type'];
        $profilepic_size = $_FILES['profilepic']['size'];       
      
        $firstname = $_POST['firstname'];  
        $lastname = $_POST['lastname'];  
        $address = $_POST['address'];      
        $city = $_POST['city'];      
        $state = $_POST['state'];      
        $zipcode = $_POST['zipcode'];      
        $phone = $_POST['phone'];  

        
    if (!empty($profilepic)) {
      if ((($profilepic_type == 'image/gif') || ($profilepic_type == 'image/jpeg') || ($profilepic_type == 'image/pjpeg') || ($profilepic_type == 'image/png'))
        && ($profilepic_size > 0) && ($profilepic_size <= GW_MAXFILESIZE)) {
        if ($_FILES['profilepic']['error'] == 0) {
          // Move the file to the target upload folder
          $target = GW_UPLOADPATH . $profilepic;
          //$profilepic=str_replace(' ','|',$profilepic);
          if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $target)) {
          
            if($_SESSION['user_id'] < 1000) {  
                $query = "UPDATE patient_data 
                              SET profilepic = '$profilepic'                                   
                              WHERE user_id = $t_user_id";
            } else {
                $query = "UPDATE dentist_data 
                              SET profilepic = '$profilepic'                                   
                              WHERE user_id = $t_user_id";
            }
            mysql_query($query);

            // Confirm success with the user

            echo '<img src="' . GW_UPLOADPATH . $profilepic . '" alt="Profile pic image" /></p>';

           
            //$profilepic = "";
           
          }
          else {
                echo 'temp: ' . $_FILES['profilepic']['tmp_name'];
                echo phpinfo();
            echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
          }
        }
      }
      else {
        echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
      }

      // Delete the temporary profile pic image file
      @unlink($_FILES['profilepic']['tmp_name']);
    }
    

          
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
  
  function valid_password($pass) {
   $r1='/[A-Z]/';  
   $r2='/[a-z]/';  
   $r3='/[0-9]/';  
   $o = array();
   if(preg_match_all($r1,$pass,$o)<2) return FALSE;

   if(preg_match_all($r2,$pass,$o)<2) return FALSE;

   if(preg_match_all($r3,$pass,$o)<2) return FALSE;

   if(strlen($pass)<6) return FALSE;

   return TRUE;
}  
  
function valid_phone($number) {
    // 555-555-5555
 
    if ( preg_match( '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $number) ) {
        return TRUE;
    } 
    return FALSE;    
}
  mysql_close($connection);
?>


<form role="form-inline" role="form" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
  <label for="profilepic">Upload profile pic:</label>   
  <input type="file" id="profilepic" name="profilepic" placeholder="Upload profile pic" />
  <hr />  
   
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
    <label for="state">State</label><br>
    <select name="state">
	<option value="AL" <?php if (!empty($row['state']) & $row['state']=="AL") {echo "selected=\"selected\"";} ?>>AL</option>
	<option value="AK" <?php if (!empty($row['state']) & $row['state']=="AK") {echo "selected=\"selected\"";} ?>>AK</option>
	<option value="AZ" <?php if (!empty($row['state']) & $row['state']=="AZ") {echo "selected=\"selected\"";} ?>>AZ</option>
	<option value="AR" <?php if (!empty($row['state']) & $row['state']=="AR") {echo "selected=\"selected\"";} ?>>AR</option>
	<option value="CA" <?php if (!empty($row['state']) & $row['state']=="CA") {echo "selected=\"selected\"";} ?>>CA</option>
	<option value="CO" <?php if (!empty($row['state']) & $row['state']=="CO") {echo "selected=\"selected\"";} ?>>CO</option>
	<option value="CT" <?php if (!empty($row['state']) & $row['state']=="CT") {echo "selected=\"selected\"";} ?>>CT</option>
	<option value="DE" <?php if (!empty($row['state']) & $row['state']=="DE") {echo "selected=\"selected\"";} ?>>DE</option>
	<option value="DC" <?php if (!empty($row['state']) & $row['state']=="DC") {echo "selected=\"selected\"";} ?>>DC</option>
	<option value="FL" <?php if (!empty($row['state']) & $row['state']=="FL") {echo "selected=\"selected\"";} ?>>FL</option>
	<option value="GA" <?php if (!empty($row['state']) & $row['state']=="GA") {echo "selected=\"selected\"";} ?>>GA</option>
	<option value="HI" <?php if (!empty($row['state']) & $row['state']=="HI") {echo "selected=\"selected\"";} ?>>HI</option>
	<option value="ID" <?php if (!empty($row['state']) & $row['state']=="ID") {echo "selected=\"selected\"";} ?>>ID</option>
	<option value="IL" <?php if (!empty($row['state']) & $row['state']=="IL") {echo "selected=\"selected\"";} ?>>IL</option>
	<option value="IN" <?php if (!empty($row['state']) & $row['state']=="IN") {echo "selected=\"selected\"";} ?>>IN</option>
	<option value="IA" <?php if (!empty($row['state']) & $row['state']=="IA") {echo "selected=\"selected\"";} ?>>IA</option>
	<option value="KS" <?php if (!empty($row['state']) & $row['state']=="KS") {echo "selected=\"selected\"";} ?>>KS</option>
	<option value="KY" <?php if (!empty($row['state']) & $row['state']=="KY") {echo "selected=\"selected\"";} ?>>KY</option>
	<option value="LA" <?php if (!empty($row['state']) & $row['state']=="LA") {echo "selected=\"selected\"";} ?>>LA</option>
	<option value="ME" <?php if (!empty($row['state']) & $row['state']=="ME") {echo "selected=\"selected\"";} ?>>ME</option>
	<option value="MD" <?php if (!empty($row['state']) & $row['state']=="MD") {echo "selected=\"selected\"";} ?>>MD</option>
	<option value="MA" <?php if (!empty($row['state']) & $row['state']=="MA") {echo "selected=\"selected\"";} ?>>MA</option>
	<option value="MI" <?php if (!empty($row['state']) & $row['state']=="MI") {echo "selected=\"selected\"";} ?>>MI</option>
	<option value="MN" <?php if (!empty($row['state']) & $row['state']=="MN") {echo "selected=\"selected\"";} ?>>MN</option>
	<option value="MS" <?php if (!empty($row['state']) & $row['state']=="MS") {echo "selected=\"selected\"";} ?>>MS</option>
	<option value="MO" <?php if (!empty($row['state']) & $row['state']=="MO") {echo "selected=\"selected\"";} ?>>MO</option>
	<option value="MT" <?php if (!empty($row['state']) & $row['state']=="MT") {echo "selected=\"selected\"";} ?>>MT</option>
	<option value="NE" <?php if (!empty($row['state']) & $row['state']=="NE") {echo "selected=\"selected\"";} ?>>NE</option>
	<option value="NV" <?php if (!empty($row['state']) & $row['state']=="NV") {echo "selected=\"selected\"";} ?>>NV</option>
	<option value="NH" <?php if (!empty($row['state']) & $row['state']=="NH") {echo "selected=\"selected\"";} ?>>NH</option>
	<option value="NJ" <?php if (!empty($row['state']) & $row['state']=="NJ") {echo "selected=\"selected\"";} ?>>NJ</option>
	<option value="NM" <?php if (!empty($row['state']) & $row['state']=="NM") {echo "selected=\"selected\"";} ?>>NM</option>
	<option value="NY" <?php if (!empty($row['state']) & $row['state']=="NY") {echo "selected=\"selected\"";} ?>>NY</option>
	<option value="NC" <?php if (!empty($row['state']) & $row['state']=="NC") {echo "selected=\"selected\"";} ?>>NC</option>
	<option value="ND" <?php if (!empty($row['state']) & $row['state']=="ND") {echo "selected=\"selected\"";} ?>>ND</option>
	<option value="OH" <?php if (!empty($row['state']) & $row['state']=="OH") {echo "selected=\"selected\"";} ?>>OH</option>
	<option value="OK" <?php if (!empty($row['state']) & $row['state']=="OK") {echo "selected=\"selected\"";} ?>>OK</option>
	<option value="OR" <?php if (!empty($row['state']) & $row['state']=="OR") {echo "selected=\"selected\"";} ?>>OR</option>
	<option value="PA" <?php if (!empty($row['state']) & $row['state']=="PA") {echo "selected=\"selected\"";} ?>>PA</option>
	<option value="RI" <?php if (!empty($row['state']) & $row['state']=="RI") {echo "selected=\"selected\"";} ?>>RI</option>
	<option value="SC" <?php if (!empty($row['state']) & $row['state']=="SC") {echo "selected=\"selected\"";} ?>>SC</option>
	<option value="SD" <?php if (!empty($row['state']) & $row['state']=="SD") {echo "selected=\"selected\"";} ?>>SD</option>
	<option value="TN" <?php if (!empty($row['state']) & $row['state']=="TN") {echo "selected=\"selected\"";} ?>>TN</option>
	<option value="TX" <?php if (!empty($row['state']) & $row['state']=="TX") {echo "selected=\"selected\"";} ?>>TX</option>
	<option value="UT" <?php if (!empty($row['state']) & $row['state']=="UT") {echo "selected=\"selected\"";} ?>>UT</option>
	<option value="VT" <?php if (!empty($row['state']) & $row['state']=="VT") {echo "selected=\"selected\"";} ?>>VT</option>
	<option value="VA" <?php if (!empty($row['state']) & $row['state']=="VA") {echo "selected=\"selected\"";} ?>>VA</option>
	<option value="WA" <?php if (!empty($row['state']) & $row['state']=="WA") {echo "selected=\"selected\"";} ?>>WA</option>
	<option value="WV" <?php if (!empty($row['state']) & $row['state']=="WV") {echo "selected=\"selected\"";} ?>>WV</option>
	<option value="WI" <?php if (!empty($row['state']) & $row['state']=="WI") {echo "selected=\"selected\"";} ?>>WI</option>
	<option value="WY" <?php if (!empty($row['state']) & $row['state']=="WY") {echo "selected=\"selected\"";} ?>>WY</option>
    </select>

  </div>
    
  <div class="form-group">
    <label for="zipcode">Zipcode</label>
    <input type="text" class="form-control input-small" name="zipcode" 
           value="<?php if (!empty($row['zipcode'])) {echo $row['zipcode'];} ?>" maxlength="5" placeholder="Zipcode">
  </div>
    
  <div class="form-group">
    <label for="phone">Phone Number</label> (xxx-xxx-xxxx)
    
    <input type="text" class="form-control input-small" name="phone" value="<?php if (!empty($phone)) {echo $phone;} ?>" maxlength="15" placeholder="xxx-xxx-xxxx">
  </div>
    
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="text" class="form-control input-small" name="email" value="<?php if (!empty($email)) {echo $email;} ?>" placeholder="Email Address">
  </div>
    
  <div class="form-group">
    <label for="password1">Password </label>  (must contain at least 2 uppercase, 2 lowercase, 2 digits and at least 6 characters in length)
    <input type="password" class="form-control input-small"  name="password1" placeholder="Password"> 
  </div>

  <div class="form-group">
    <label for="password2">Password </label> (Verify) 
    <input type="password" class="form-control input-small" name="password2" placeholder="Verify Password">
  </div>  
    
  <input type="submit" value="Finish Editing" id="submit" name="submit" />
  <input type="submit" value="DELETE ACCOUNT" id="delete_account" name="delete_account" onclick="return confirm('Are you SURE You want to DELETE your account?\nThis will successfully delete your account and return you to the homepage.');"/>
  
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