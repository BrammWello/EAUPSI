<?php
    include('dbconnect.php');
        if (($open = fopen("../../../../../../users.csv", "r")) !== FALSE) 
        {
        
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
            {        
                $records[] = $data; 
            }
        
        fclose($open);
        }
        
        //insert lecturers
        //reset table first 
        $resetquery = "TRUNCATE TABLE users";
        mysqli_query($conn, $resetquery);
        //run now
        if(is_array($records)){
            foreach ($records as $row) {
                $fieldVal1 = mysqli_real_escape_string($conn, $row[0]);
                $fieldVal2 = mysqli_real_escape_string($conn, $row[1]);
                $fieldVal3 = mysqli_real_escape_string($conn, $row[2]);
                $fieldVal4 = mysqli_real_escape_string($conn, $row[3]);
        
                $query ="INSERT INTO users (userid, names, email, pass) VALUES ( '". $fieldVal1."','".$fieldVal2."','".$fieldVal3."','".$fieldVal4."' )";
                mysqli_query($conn, $query);
            }
        }


        //now check if user is logged in
        session_start();
        // Check do the person logged in
        if($_SESSION['userid']==NULL){
            // Haven't log in
            header("Location: login.php");
        }else{
            // Logged in
            header("Location: index.php");
            echo "Successfully logged in!";
        }
    
    ?>