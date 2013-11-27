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


<br><br>
<div class="row">
  <div class="col-sm-6 col-md-2">

  </div>
	
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail thumbnail1">
      <img src="http://www.emergencydentist247.com/images/pain-cartoon.jpg" alt="..." height="120" width="155">
      <div class="caption">
        <h3>Register as a Patient</h3>
       <p><a href="patient_form.php" class="btn btn-primary" role="button">Register</a>      </div>
    </div>
  </div>



  <div class="col-sm-6 col-md-4">
    <div class="thumbnail thumbnail2">
      <img src="http://t2conline.com/wp-content/uploads/2011/12/Dentist_-_Cartoon.jpg" alt="..." height="300" width="200">
      <div class="caption">
        <h3>Register as a Dentist</h3>
       <p><a href="dentist_form.php" class="btn btn-primary" role="button" class="icon basket">Register</a>      </div>
    </div>
  </div>



</div>
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