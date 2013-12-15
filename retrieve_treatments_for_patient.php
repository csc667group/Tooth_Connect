<?php

require_once('connectvars.php');

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
            
            //GETTING NAME OF TEETH
            $queryT = "SELECT * FROM teeth WHERE id = '$_GET[tooth_id]'";
            $dataT = mysql_query($queryT);
            if (!$dataT) {
                die("query failed" . mysql_error());
            }            
            $rowT = mysql_fetch_array($dataT); 
            
            echo "<br><br>";
            
            echo "<div class='row'>";            
                echo "<strong>Teeth #" . $_GET['tooth_id'] . ": " . $rowT['tooth'] ."</strong><br><br>";
                echo "<table class='table table-striped' >";
                echo "<tr>";
                echo "<th>Treatment Type</th>
                      <th>Time</th>
                      <th>Dentist</th>
                      <th>Description</th>";
                echo "</tr>";               
            
            
            while($rowX = mysql_fetch_array($dataX)){
             
                echo "<div class='row'><tr>                 
                       <td>" . ($rowX['treatment_category']) . "</td>
                       <td>" . ($rowX['cur_timestamp']) . "</td>
                       <td>" . ($rowX['whole_name']) . "</td>                
                       <td>" . ($rowX['description']) . "</td>
                       </tr></div>";
             }
             echo "</table>";
                                       
                                      
        echo "</div>";


?>