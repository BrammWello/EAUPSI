<?php
    
    function registerUser() {

        include('dbconnect.php');
        # Check if name and email fileds are empty
        if(empty($_POST['first_name']) && empty($_POST['last_name']) && empty($_POST['email']) && empty($_POST['userID']) && empty($_POST['password']) && empty($_POST['password_repeat'])){
            # If the fields are empty, display a message to the user
            echo " <br/> Please fill in all the fields";
        # Process the form data if the input fields are not empty
        }else{
            $fname= $_POST['first_name'];
            $lname= $_POST['last_name'];
            $names = $fname . ' ' .$lname;
            $email= $_POST['email'];
            $userID= $_POST['userID'];
            $pass= $_POST['password'];
            echo ('Your Name is: '. $names. '<br/>');
            echo ('Your Email is: '   . $email. '<br/>');
            echo ('Your Email is: '   . $userID. '<br/>');
            echo ('Your Email is: '   . $pass. '<br/>');

            try {
            if ($_POST['usertype'] == "lecturer") {

                // Performing insert query execution
                // here our table name is college
                $sql = "INSERT INTO `users` (`userid`, `names`, `email`, `pass`) VALUES ('$userID','$names','$email','$pass')";
                
                echo "about to send";
                if(mysqli_query($conn, $sql)){
                    echo "<h3>data stored in a database successfully."
                        . " Please browse your localhost php my admin"
                        . " to view the updated data</h3>";

                        //sesssion dedtails
                        session_start();
                                
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["userid"] = $userID;
                        $_SESSION["names"] = $names;
                        $_SESSION["email"] = $email;
                        $_SESSION["pass"] = $pass;

                        header("location: index.php");
                } else {
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($conn);
                }
                
                // Close connection
                mysqli_close($conn);


            } else if ($_POST['usertype'] == "student") {

                // Performing insert query execution
                // here our table name is college
                $sql = "INSERT INTO `students` (`userid`, `names`, `email`, `pass`, `latecounts` , `earlycount`) VALUES ('$userID','$names','$email','$pass', 0, 0)";
                
                echo $sql;
                if(mysqli_query($conn, $sql)){
                    echo "<h3>data stored in a database successfully."
                        . " Please browse your localhost php my admin"
                        . " to view the updated data</h3>";

                        //sesssion dedtails
                        session_start();
                                
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["userid"] = $userID;
                        $_SESSION["names"] = $names;
                        $_SESSION["email"] = $email;
                        $_SESSION["pass"] = $pass;
                        $_SESSION["latecount"] = $latecount;

                        header("location: student_index.php");
                } else {
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($conn);
                }
                
                // Close connection
                mysqli_close($conn);
            } else {
                echo "You did not select any User";
            }

        }

        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
          }

        }
    }

    if(isset($_POST['submit']))
        {
            registerUser();
        }
 
?>