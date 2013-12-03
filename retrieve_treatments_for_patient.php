<?php

require_once('connectvars.php');

                                    // Connect to the database
                                    $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

                                    if (!$connection) {
                                      die("Database connection failed:" . mysql_error());
                                    }

                                    $database = mysql_select_db(DB_NAME, $connection);
                                    if (!$database) {
                                      die("Database selection failed:" . mysql_error());
                                    } 
//$tooth_id=1;
            $queryX = "SELECT  tc.treatment_category, tr.description, tr.cur_timestamp, tth.tooth,CONCAT_WS(' ', dd.firstname, dd.lastname) AS whole_name
                        FROM treatment_records tr                                                
                        INNER JOIN treatment_category tc
                        ON tr.treatment_category_id=tc.id
                        INNER JOIN teeth tth
                        ON tr.tooth_id=tth.id
                        INNER JOIN dentist_data dd
                        ON tr.dentist_id=dd.user_id
                        WHERE tr.tooth_id = '$_GET[tooth_id]'
                        AND patient_id = '$_GET[patient_id]'
                        ORDER BY tr.cur_timestamp DESC
                        ; ";//AND patient_id = '$_SESSION[user_id]'
                         //WHERE user_id = '$_SESSION[user_id]' ";
            
            $dataX = mysql_query($queryX);
            if (!$dataX) {
                die("query failed" . mysql_error());
            }  
            
            while($rowX = mysql_fetch_array($dataX)){
             
             
         echo "<br><div class='row'>                                            
                    <div class='col-md-10' >
                        <strong>Treatment type: </strong> " . ($rowX['treatment_category']) . "<br>
                        <strong >Time: </strong> " . ($rowX['cur_timestamp']) . "<br>
                        <strong>Tooth: </strong> " . ($rowX['tooth']) . "<br>
                        <strong >Dentist: </strong> " . ($rowX['whole_name']) . "<br><br>                
                        <strong>Description: </strong>" . ($rowX['description']) . "                               
                    </div>          
                </div> 
                <hr>
                ";
              }
                                       
                                      
        echo "</div>";


?>