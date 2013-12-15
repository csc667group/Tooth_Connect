
<?php
  // Define database connection constants
  define('DB_HOST', 'sfsuswe.com');
  define('DB_USER', 'rsanch');
  define('DB_PASSWORD', 'ASDasdqwe');
  define('DB_NAME', 'student_rsanch');
  
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
  
?>
