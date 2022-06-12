<?php 
include('dbconnect.php');
// Initialize the session
session_start();
 
// if($_SESSION['userid']!=NULL){
//     // Haven't log in
//     header("Location: index.php");
// }
 
// Define variables and initialize with empty values
$userid = $password = "";
$userid_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if userid is empty
    if(empty(trim($_POST["userid"]))){
        $userid_err = "Please enter User ID.";
    } else{
        $userid = trim($_POST["userid"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($userid_err) && empty($password_err)){
        
        if ($_POST['usertype'] == "lecturer") {

            // Prepare a select statement
            $sql = "SELECT * FROM users WHERE userid = '$userid' and pass = '$password' ";
            
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            
            if($count == 1){  
                session_start();
                                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["userid"] = $row['userid'];
                $_SESSION["names"] = $row['names'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["pass"] = $row['pass'];
                                                    
                // Redirect user to welcome page
                header("location: index.php"); 
            }  
            else{  
                echo "<h1> Login failed. Invalid username or password or user.</h1>";  
            }
        } else if ($_POST['usertype'] == "student") {
        
           // Prepare a select statement
           $sql = "SELECT * FROM students WHERE userid = '$userid' and pass = '$password' ";
            
           $result = mysqli_query($conn, $sql);  
           $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
           $count = mysqli_num_rows($result);  
           
           if($count == 1){  
               session_start();
                               
               // Store data in session variables
               $_SESSION["loggedin"] = true;
               $_SESSION["userid"] = $row['userid'];
               $_SESSION["names"] = $row['names'];
               $_SESSION["email"] = $row['email'];
               $_SESSION["pass"] = $row['pass'];
                                                   
               // Redirect user to welcome page
               header("location: student_index.php"); 
           }  
           else{  
               echo "<h1> Login failed. Invalid username or password or user.</h1>";  
           }
        } else {
            echo "You did not select any User";
        }   

    }
    
    // Close connection
    mysqli_close($link);
}
?>