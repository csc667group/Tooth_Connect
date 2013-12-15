<?php

require_once('connectvars.php');


            $tooth_id = $_GET['tooth_id'];
            $patient_id = $_GET['patient_id'];
            $dentist_id = $_GET['dentist_id'];



            $queryX = "SELECT  tc.treatment_category, tr.description, tr.cur_timestamp, tth.tooth,CONCAT_WS(' ', dd.firstname, dd.lastname) AS whole_name
                        FROM treatment_records tr                                                
                        INNER JOIN treatment_category tc
                        ON tr.treatment_category_id=tc.id
                        INNER JOIN teeth tth
                        ON tr.tooth_id=tth.id
                        INNER JOIN dentist_data dd
                        ON tr.dentist_id=dd.user_id
                        WHERE tr.tooth_id = '$tooth_id'
                        AND patient_id = '$patient_id'
                        ORDER BY tr.cur_timestamp DESC
                        ; ";//AND patient_id = '$_SESSION[user_id]'
                         //WHERE user_id = '$_SESSION[user_id]' ";
            
            $dataX = mysql_query($queryX);
            if (!$dataX) {
                die("query failed" . mysql_error());
            }
            
/*
            echo "
            <hr>
            <div class='row>'
            <div class='form-group'>
                <div class='col-sm-offset-2 col-sm-10'>
                <div class='span3'>
                   
                    <button type='post' href=\"insert_treatments_for_dentist.php?itooth_id=" . $_GET['tooth_id'] . "&ipatient_id=" . $_GET['patient_id'] . "&identist_id=" . $_GET['dentist_id'] . "\" class='btn btn-success'>Add Treatment</button>
                     </div>
               </div>
            </div>
            </div>";*/
            
            
            echo "<br><a href=\"insert_treatments_for_dentist.php?tooth_id=" . $tooth_id . "&patient_id=" 
                    . $patient_id . "&dentist_id=" . $dentist_id. "\">ADD TREATMENT</a>";

  
            //GETTING NAME OF TEETH
            $queryT = "SELECT * FROM teeth WHERE id = '$tooth_id'";
            $dataT = mysql_query($queryT);
            if (!$dataT) {
                die("query failed" . mysql_error());
            }            
            $rowT = mysql_fetch_array($dataT); 
            
            
            
            echo "<div class='row'>";            
                echo "Teeth #" . $tooth_id . ": " . $rowT['tooth'] ."<br><br>";
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