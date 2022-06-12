<?php

        include('dbconnect.php');
        
            $change= $_POST['change'];
            $studentname= $_POST['studentname'];
            $requestid = $_POST['requestid'];
            $currentearly = NULL;
            $currentlate = NULL;

            echo ('Your Email is: '   . $change. '<br/>');
            echo ('Your Email is: '   . $studentname. '<br/>');
            echo ('Your Email is: '   . $currentearly. '<br/>');
            echo ('Your Email is: '   . $requestid. '<br/>');

            //send to db now

            //get the current readings

            $sql = "SELECT * FROM `students` WHERE `names` = '$studentname' ";
            echo $sql;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $currentearly = $row["earlycount"];
                    $currentlate = $row["latecount"];
                }

                if ($change == 'accept'){

                    $currentearly =  $currentearly + 1;

                    $sql = "UPDATE `students` SET `earlycount` = '$currentearly' WHERE `students`.`names` = '$studentname'";
    
                    if(mysqli_query($conn, $sql)){
                        echo "<h3>data stored in a database successfully."
                            . " Please browse your localhost php my admin"
                            . " to view the updated data</h3>";

                            $sql2 = "UPDATE `requests` SET `status` = 'accepted' WHERE `requests`.`requestid` = '$requestid'";

                            if(mysqli_query($conn, $sql2)){
                                header("location: table.php");
                            } else {
                                echo "ERROR: Hush! Sorry $sql. "
                                    . mysqli_error($conn);
                            }
                    } else {
                        echo "ERROR: Hush! Sorry $sql. "
                            . mysqli_error($conn);
                    }
                } else if ($change == 'reject') {
                    $currentlate =  $currentlate + 1;

                    $sql = "UPDATE `students` SET `latecounts` = '$currentlate' WHERE `students`.`names` = '$studentname'";

                    echo $sql;
    
                    if(mysqli_query($conn, $sql)){
                        echo "<h3>data stored in a database successfully."
                            . " Please browse your localhost php my admin"
                            . " to view the updated data</h3>";
    
                            $sql2 = "UPDATE `requests` SET `status` = 'rejected' WHERE `requests`.`requestid` = '$requestid'";

                            if(mysqli_query($conn, $sql2)){
                                header("location: table.php");
                            } else {
                                echo "ERROR: Hush! Sorry $sql. "
                                    . mysqli_error($conn);
                            }
                    } else {
                        echo "ERROR: Hush! Sorry $sql. "
                            . mysqli_error($conn);
                    }
                }

            } else {
                echo "0 Classes";
            }
                


            

            
        
?>