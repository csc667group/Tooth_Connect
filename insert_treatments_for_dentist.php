<!DOCTYPE html>
<html>
  <head>
    <title>Insert Treatment</title>
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

<?php

 require_once('connectvars.php');

  $dentist_id = $_GET['dentist_id'];
  $patient_id = $_GET['patient_id'];
  $tooth_id = $_GET['tooth_id'];


  if (isset($_POST['submit'])) {

    $treatmentCategoryID = $_POST['treatmentCategoryID'];
    $description = $_POST['description']; 
     
  
    if (!empty($treatmentCategoryID) && !empty($description)) {
      


        // The email is unique to patients and dentists, so insert the data into the database
        $query = "INSERT INTO treatment_records  (treatment_category_id, description, dentist_id, patient_id, tooth_id)
            VALUES ('$treatmentCategoryID', '$description','$dentist_id','$patient_id','$tooth_id')";
        mysql_query($query);

        // Confirm success with the user  patient_id="+$_GET[patient_id]+"&dentist_id="+$_GET[dentist_id]
        echo "<p>The new treatment has been successfully added.
         You\'re now ready to <a href=\"retrieve_treatments_for_dentist.php?patient_id=" . $patient_id ."&dentist_id=" . $dentist_id . ">go back</a>.</p>";
     
        mysql_close($connection);
        exit();
      }

      else {
        // An account already exists for this email, so display an error message
        echo "<font color='red'>Please add info.</font>";
        //$email = "";
      }
   
    
  }
//  echo 'form not submitted';
  mysql_close($connection);

?>



</br></br></br>
<form role="form-inline" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  
  
  <div class="form-group">
    <label for="treatmentCategoryID">Treatment Type</label></br>
    <select name="treatmentCategoryID">
    <option value=1>Health Problems</option>
    <option value=2>Filings</option>
    <option value=3>Crowns-Bridges</option>
    <option value=4>Implants</option>
    <option value=5>Extractions and Surgical Procedures</option>
    <option value=6>Root Canal Treatment</option>
    <option value=7>Dentures</option>
    <option value=8>X-Rays - Intraoral Images</option>
    <option value=9>General Procedures</option>
    </select>
  </div>

  <div class="form-group">
    <label for="description">Description &nbsp</label>
    <input type="text" class="form-control input-small" id="description" name="description" value="<?php if (!empty($description)) {echo $description;} ?>"  placeholder="Description">
  </div>  

  <input type="submit" class="btn btn-default" value="Add Treatment" id="submit" name="submit" />
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