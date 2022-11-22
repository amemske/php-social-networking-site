<?php

if(isset($_POST['login_button'])){
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);//sanitize email

    $_SESSION['log_email'] = $email;//store emails in session
    $password = md5($_POST['log_password']);//get password

//check whether credentials are the same
    $database_query_results = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password='$password'");
    $login_query_rows = mysqli_num_rows($database_query_results); //count number of rows

    if($login_query_rows == 1){
        $resultsArray = mysqli_fetch_array($database_query_results);//fetch results into an array
        $username = $resultsArray['username'];//get the username from the array

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'");
        
        if( mysqli_num_rows($user_closed_query) == 1){
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email' ");
        }

        $_SESSION['username'] = $username; //store the username in a session
        header("Location: index.php");//redirect
        exit();

    } else{
        array_push($error_array, "Email or password is incorect");//push to error array
    }
}