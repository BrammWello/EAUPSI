<?php

        include('dbconnect.php');
        session_start();

        
            $classname= $_POST['classnamerequest'];
            $lecid= $_POST['lecid'];
            $lecname= $_POST['lecname'];
            $studentname = $_SESSION["names"];


            echo ('Your Email is: '   . $classname. '<br/>');
            echo ('Your Email is: '   . $classdate. '<br/>');
            echo ('Your Email is: '   . $studentname. '<br/>');


            //get current list first

            //send to db now
            try{
                $sql = "INSERT INTO `registration` (`registrationid`,`studentname`, `registrationclass`, `lecid`, `registrationstatus`) VALUES (NULL,'$studentname','$classname','$lecid','pending')";
                echo $sql;
                echo "about to send";
                if(mysqli_query($conn, $sql)){
                    $message = "You requested registration for " .$classname. " taught by " .$lecname;
                    echo "<script LANGUAGE='JavaScript'>
                    window.alert('". $message ."');
                    window.location.href='student_index.php';
                    </script>";
                } else {
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($conn);
                }
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }
            
        
?>