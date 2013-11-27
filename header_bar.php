<!-- HEADER BAR -->

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