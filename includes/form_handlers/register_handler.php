<?php

//Declairing variables to prevent errors
$fname = $lname = $email = $email2 = $password = $password2 = $date = $error_array = array();

if(isset($_POST['register_button'])){
    //Registration form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //uppercase first letter
    $_SESSION['reg_fname'] = $fname; //stores firstname into a session

    //Last name
    $lname = strip_tags($_POST['reg_lname']); //remove html tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //uppercase first letter
    $_SESSION['reg_lname'] = $lname; //stores lastname into a session

    //email
    $email = strip_tags($_POST['reg_email']); //remove html tags
    $email = str_replace(' ', '', $email); //remove spaces
    $email = ucfirst(strtolower($email)); //uppercase first letter
    $_SESSION['reg_email'] = $email; //stores email into a session

    //email2
    $email2 = strip_tags($_POST['reg_email2']); //remove html tags
    $email2 = str_replace(' ', '', $email2); //remove spaces
    $email2 = ucfirst(strtolower($email2)); //uppercase first letter
    $_SESSION['reg_email2'] = $email2; //stores emails into a session

    //password
    $password = strip_tags($_POST['reg_password']); //remove html tags
    $password2 = strip_tags($_POST['reg_password2']); //remove html tags

    $date =  date("Y-m-d");//current date

    if($email == $email2){
        if( filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            //check if email already exists
            $email_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

            
            //count number of rows returned
            $num_rows = mysqli_num_rows($email_check);

            if($num_rows > 0){
                //echo "Email already in use";
                array_push($error_array, "Email already in use");
            }
        } else{
          array_push($error_array, "Invalid email format");
        }

    }
    else{
       //echo "Emails don't match";
       array_push($error_array, "Emails don't match");
    }

    if(strlen($fname) > 25 || strlen($fname) < 3) {
       // echo "Your first name must be between 3 and 25 characters";
       array_push($error_array, "Your first name must be between 3 and 25 characters");
    }
    if(strlen($lname) > 25 || strlen($lname) < 3) {
      //  echo "Your last name must be between 3 and 25 characters";
        array_push($error_array, "Your last name must be between 3 and 25 characters");
    }
    if($password != $password2) {
      // echo "Your passwords don't match";
        array_push($error_array, "Your passwords don't match");
    }else{
        if(preg_match('/[^A-Za-z0-9]/', $password)){
          //  echo "Your password can only contain english characters or numbers";
            array_push($error_array, "Your password can only contain english characters or numbers");
        }
    }
    if(strlen($password) > 30 || strlen($password) < 5){
      //  echo "Your password must be between 5 and 30 characters";
        array_push($error_array, "Your password must be between 5 and 30 characters");
    }
    //print_r($error_array);

    if(empty($error_array)){
        $password = md5($password);//Encrtpy password 

        //generating username by concatenating first and last name
        $username = strtolower($fname . "_" . "$lname");
        //print_r($username);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $row_count= mysqli_num_rows($check_username_query);//number of rows

      //  print_r($row_count);
        //die();

        $i=0;
        //if user exists add number to username   
        while($row_count > 0){
          $i++; //add 1 to i
          $username = $username . "_" . $i;
          //check if the new username exists if so start the loop again
          $check_username_query  = mysqli_query($con, "SELECT username FROM users WHERE username='$username");    
          }

          
      //Default profile picture assignment
              $rand = rand(1,2);
              if($rand == 1){
                $profile_pic = "assets/images/profile/defaults/head_deep_blue.png";
              }  else if ($rand == 2){
                $profile_pic = "assets/images/profile/defaults/head_emerald.png";
        }

        $insert_sql = "INSERT INTO users VALUES(
          NULL,'$fname','$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0','0', 'no',',' )";
        //finally insert into the database
        $query = mysqli_query($con, $insert_sql);

        if ($query) {
            array_push($error_array, "Your all set! Go ahead and login");
      
            //clear session varibles
            $_SESSION['reg_fname'] = $_SESSION['reg_lname'] = $_SESSION['reg_email'] = $_SESSION['reg_email2'] = '' ;
      
          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
          }

    }

   

}

//print_r($error_array);