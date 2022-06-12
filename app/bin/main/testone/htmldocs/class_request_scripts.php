<?php

        include('dbconnect.php');
        session_start();

        
            $classname= $_POST['classnamerequest'];
            $classdate= $_POST['classdaterequest'];
            $lecid= $_POST['lecid'];
            $studentname = $_SESSION["names"];


            echo ('Your Email is: '   . $classname. '<br/>');
            echo ('Your Email is: '   . $classdate. '<br/>');
            echo ('Your Email is: '   . $studentname. '<br/>');

            //send to db now

            $sql = "INSERT INTO `requests` (`requestid`,`studentname`, `requestclass`, `requestdate`, `lecid`, `status`) VALUES (NULL,'$studentname','$classname','$classdate','$lecid','pending')";
                echo $sql;
                echo "about to send";
                if(mysqli_query($conn, $sql)){
                    $message = "You requested attendance for " .$classname. " on " .$classdate;
                    echo "<script LANGUAGE='JavaScript'>
                    window.alert('". $message ."');
                    window.location.href='student_index.php';
                    </script>";
                } else {
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($conn);
                }
        
?>