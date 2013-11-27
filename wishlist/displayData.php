<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
	$key = $_POST['key'];
	echo 'The key entered is: ' . $key . '<br />';

        $dbc = mysqli_connect('sfsuswe.com', 'rsanch', 'ASDasdqwe', 'student_rsanch')
                or die('Error connecting to MySQL server.');
        $query = "SELECT description FROM wishes WHERE wisher_id = $key";
        $result = mysqli_query($dbc, $query)
                or die(mysql_error());
 
        $row = $result->fetch_array(); 
        $num_results = $result->num_rows; 
        if ($num_results > 0){ 
            while( $row ){
                echo $row['description'] . '<br/>';
                $row = $result->fetch_array();
            }
        } else{ 
                echo 'No data found.';
        }                       
        mysqli_close($dbc);

        ?>

        </table>        
    </body>
</html>
