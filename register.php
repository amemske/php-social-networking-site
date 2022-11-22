<?php 
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Social Feed!</title>
    <!-- CSS only -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="assets/css/custom.css">
  </head>
<body>
<div class="container">
  <main>
    
  <div class="row g-5 mt-5 ">
  <div class="col-md-6 col-lg-6 m-auto ">
      <h1 class="logo text-center">JamiiFeed</h1>
      <h3 class="text-center">Connecting you with your world</h3>
      
    </div>

  </div>

    <div class="row g-5 mt-5 ">

    <div class="col-md-6 col-lg-6 m-auto box py-4">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <h4 class="mb-3">Enter login details</h4>

    <div class="form-floating">
      <input type="email" class="form-control" 
      value="<?php 
             if(isset($_SESSION['log_email'])){
                echo $_SESSION['log_email'];
             }?>" name="log_email" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mt-2">
      <input type="password" class="form-control" name="log_password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="mt-4 w-100 btn btn-lg btn-primary"  name="login_button" type="submit">Sign in</button>

    <div class="text-danger mt-2">
      <?php 
      if(in_array("Email or password is incorect", $error_array)) echo "Email or password is incorect";?>
    </div>
    
  </form>
  </div>
        
      </div>
      <div class="row g-5 mt-5 ">
      <div class="col-md-6 col-lg-6 m-auto box py-4">
        <h4 class="mb-3">Sign up details</h4>
        <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" name="reg_fname" class="form-control" id="firstName" placeholder="" 
              value="<?php 
             if(isset($_SESSION['reg_fname'])){
                echo $_SESSION['reg_fname'];
             }?>" required="">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
              <div  class="text-danger">
                <?php if (in_array("Your first name must be between 3 and 25 characters", $error_array)) echo "Your first name must be between 3 and 25 characters";?>
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" name="reg_lname" class="form-control" id="lastName" placeholder="" 
              value="<?php 
             if(isset($_SESSION['reg_lname'])){
                echo $_SESSION['reg_lname'];
             }?>" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
              <div  class="text-danger">
                <?php if (in_array("Your last name must be between 3 and 25 characters", $error_array)) echo "Your last name must be between 3 and 25 characters" ;?>
              </div>
              
            </div>

         

            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="reg_email" class="form-control" id="email" placeholder="you@example.com"
              value="<?php 
             if(isset($_SESSION['reg_email'])){
                echo $_SESSION['reg_email'];
             }?>">
              <div class="invalid-feedback">
                Please enter a valid email address.
              </div>
              <div>
               
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Confirm email</label>
              <input type="email" name="reg_email2" class="form-control" id="email" placeholder="you@example.com" 
              value="<?php 
             if(isset($_SESSION['reg_email2'])){
                echo $_SESSION['reg_email2'];
             }?>">
              <div class="invalid-feedback">
                The email addresses don't match.
              </div>
              <div  class="text-danger">
                <?php if (in_array("Email already in use", $error_array)) echo "Email already in use";
                else if (in_array("Emails don't match", $error_array)) echo "Emails don't match";
                else if (in_array("Invalid email format", $error_array)) echo "Invalid email format";?>
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Password</label>
              <input type="password" name="reg_password" class="form-control" id="password" placeholder="Enter your password" required="">
              
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Confirm Password</label>
              <input type="password" name="reg_password2" class="form-control" id="address2" placeholder="Enter your password"> 
              <div class="invalid-feedback">
              The passwords don't match.
              </div>

              <div>
              <div class="text-danger">
                <?php if (in_array("Your passwords don't match", $error_array)) echo "Your passwords don't match";
                else if (in_array("Your password can only contain english characters or numbers", $error_array)) echo "Your password can only contain english characters or numbers";
                else if (in_array("Your password must be between 5 and 30 characters", $error_array)) echo "Your password must be between 5 and 30 characters";?>
              </div>
                
              </div>
             
            </div>

          
          </div>

       


          <button class="w-100 btn btn-primary btn-lg mt-4" name="register_button" type="submit">Register</button>

          <div class="text-success">
                <?php if (in_array("Your all set! Go ahead and login", $error_array)) echo "Your all set! Go ahead and login";?>
              </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">© 2017–2022 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
    
</body>
</html>