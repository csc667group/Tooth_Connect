<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
	$data = $_POST['data'];
	echo 'The data inserted is: ' . $data . '<br />';

        $dbc = mysqli_connect('sfsuswe.com', 'rsanch', 'ASDasdqwe', 'student_rsanch')
                or die('Error connecting to MySQL server.');
        $query = "INSERT INTO baylife VALUES ($data)";
        $result = mysqli_query($dbc, $query)
                or die(mysql_error());
        echo 'closing database' . '<br />';
        mysqli_close($dbc);

        ?>

        </table>        
    </body>
</html>