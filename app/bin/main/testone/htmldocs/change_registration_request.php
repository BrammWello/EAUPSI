<?php

        include('dbconnect.php');
        
            $change= $_POST['change'];
            $studentname= $_POST['studentname'];
            $registrationclass = $_POST['registrationclass'];
            $regid = $_POST['regid'];
            $currentclasses = "";

            //get the current readings

            $sql = "SELECT * FROM `students` WHERE `names` = '$studentname' ";
            echo $sql;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $currentclasses = $row["classes"];
                }

                if ($change == 'accept'){

                    // see if it is empty first
                    if ($currentclasses == "") {
                        $currentclasses =  $registrationclass;
                        echo $currentclasses;

                        $sql = "UPDATE `students` SET `classes` = '$currentclasses' WHERE `students`.`names` = '$studentname'";
    
                        if(mysqli_query($conn, $sql)){
                            if(mysqli_query($conn, "UPDATE `registration` SET `registrationstatus` = 'accepted' WHERE `registration`.`registrationid` = '$regid'")) {
                                echo "You have admitted the person";
                            }
                        } else {
                            echo "ERROR: Hush! Sorry $sql. "
                                . mysqli_error($conn);
                        }

                    } else {
                        $stringtobreak = $currentclasses;
                        $str_arr = explode (",", $stringtobreak);
                        //check to see if class is already there
                        if(in_array($registrationclass, $str_arr)) {
                            echo "Already in class";
                        } else {
                            array_push($str_arr, $registrationclass);
                            $finalclassesstring = implode(",", $str_arr);

                            $sql = "UPDATE `students` SET `classes` = '$finalclassesstring' WHERE `students`.`names` = '$studentname'";
    
                            if(mysqli_query($conn, $sql)){
                                if(mysqli_query($conn, "UPDATE `registration` SET `registrationstatus` = 'accepted' WHERE `registration`.`registrationid` = '$regid'")) {
                                    echo "You have admitted the person";
                                }
                                
                            } else {
                                echo "ERROR: Hush! Sorry $sql. "
                                    . mysqli_error($conn);
                            }
                        }
                    }

                    
                } else if ($change == 'reject') {

                    $sql = "UPDATE `registration` SET `registrationstatus` = 'rejected' WHERE `registration`.`registrationid` = '$regid'";

    
                    if(mysqli_query($conn, $sql)){
                        echo "";
                    } else {
                        echo "ERROR: Hush! Sorry $sql. "
                            . mysqli_error($conn);
                    }
                }

            } else {
                echo "0 Requests";
            }
                


            

            
        
?>