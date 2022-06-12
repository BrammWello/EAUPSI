<?php
    
    function registerUser() {

        session_start();

        include('dbconnect.php');

        # Check if name and email fileds are empty
        if(empty($_POST['classname']) && empty($_POST['lecname'])){
            # If the fields are empty, display a message to the user
            echo " <br/> Please fill in all the fields";
        # Process the form data if the input fields are not empty
        }else{
            $classname= $_POST['classname'];
            $lecname= $_POST['lecname'];
            $lecid= $_SESSION["userid"];

            // Performing insert query execution
            // here our table name is college
            $sql = "INSERT INTO `classes` (`classname`, `lecname`, `lecid`) VALUES ('$classname','$lecname', '$lecid')";
            

            if(mysqli_query($conn, $sql)){
                // This is in the PHP file and sends a Javascript alert to the client
                $message = "You created " .$classname. " class with lecturer name as " .$lecname. " with lec id as ". $lecid;
                echo "<script LANGUAGE='JavaScript'>
                window.alert('". $message ."');
                window.location.href='profile.php';
                </script>";
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);
            }
            
            // Close connection
            mysqli_close($conn);
            
        }
    }

    if(isset($_POST['submit']))
        {
            registerUser();
        }
 
?>