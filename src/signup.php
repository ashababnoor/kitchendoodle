<?php

session_start();

$_SESSION['current_page'] = 'home.php';

if( 
    !isset($_SESSION['myemail']) ||
    empty($_SESSION['myemail'])
){
    
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon -->
        <link rel="icon" href="images/kd-logo.svg" type="image/svg">

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Bootsrap Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-login.css" rel="stylesheet">
        <link href="css/style-landing-page.css" rel="stylesheet"> 

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>

        <title> Sign Up | KitchenDoodle</title>

        <style>
            
        </style>
    </head>
    <body>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-md navbar-light extra-padding">
            <a href="index.html" class="navbar-brand navbar-brand-x" id="nav-text"> 
                KitchenDoodle
                <!-- <img src="images/kd-logo-full-green.svg" alt="KD" class="navbar-brand-image">  -->
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="faq.php" class="nav-link"> FAQ </a>
                    </li>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link"> Sign Up </a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link"> Login </a>
                    </li>
                    <li class="nav-item">
                        <a href="employeeLogin.php" class="nav-link"> Employee </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Login Section -->
        <div class="container-fluid login-container content" style="padding: 2em 2em">
            <div class="d-flex justify-content-center d-flex align-items-center" style="flex-direction: column;">
                <img src="images/kd-logo-full-green.svg" alt="" class="full-logo" onclick="redirect('index.html')" style="cursor: pointer;"> 
                <h4 style="margin-top: 1em; margin-bottom:2em;">Create A New Account!</h4>
            </div>

            <form action="signupProcess.php" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="myfirstname">First Name</label>
                    <input class="form-control" type="text" id="myfirstname" name="myfirstname" placeholder="Your first name" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide a valid first name.
                    </div>
                </div>
                <div class="form-group">
                    <label for="mylastname">Last Name</label>
                    <input class="form-control" type="text" id="mylastname" name="mylastname" placeholder="Your last name" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide a valid last name.
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="date" id="dob" name="dob" placeholder="Your date of birth" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide a valid date of birth.
                    </div>
                </div>
                <div class="form-group">
                    <label for="myemail">Email</label>
                    <input class="form-control" type="email" id="myemail" name="myemail" placeholder="Your email" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide a valid email.
                    </div>
                </div>
                <div class="form-group">
                    <label for="mypass">Password</label>
                    <input class="form-control" type="password" id="mypass" name="mypass" placeholder="Your password" required onkeyup="checkPass()">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide a valid password.
                    </div>
                </div>
                <div class="form-group" id="passval-div">
                    <label for="mypassval">Re-type Password</label>
                    <input class="form-control" type="password" id="mypassval" name="mypassval" placeholder="Re-type your password" required onkeyup="checkPass()">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide the correct password.
                    </div>
                </div>
                <div class="form-group">
                    <label for="telno">Phone Number</label>
                    <input class="form-control" type="tel" id="telno" name="telno" placeholder="Your phone number" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please provide a valid mobile number.
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 1em;">
                    <a href="login.php" class="muted-link">Have an account? Log in instead! </a>
                    <input class="btn btn-primary" type="submit" value="Click to Signup">
                </div>
            </form>
        </div>
        <!-- Login Section End -->
        

        <!-- Footer Start -->
        <footer>
            <div class="row no-gutters text-center text-dark bg-light custom-footer">
                <div class="col-sm-4">
                    Contact Information
                </div>
                <div class="col-sm-4">
                    Copyright © 2021
                </div>
                <div class="col-sm-4">
                    <a href="index.html" class="">
                        <img src="images/kd-logo-full-grey.svg" alt="KD" class="footer-logo">
                    </a>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- JS Script for Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

        <script>
            function checkPass(){
                let pass = document.getElementById('mypass').value;
                let passval = document.getElementById('mypassval').value;
                let passval_field = document.getElementById('mypassval');
                let passval_div = document.getElementById('passval-div');
                // let dob = document.getElementById('dob').value;

                // console.log(dob);

                if(passval != ""){
                    if(pass != passval){
                        passval_field.classList.add('is-invalid');
                        passval_field.classList.remove('is-valid');
                    }
                    else if(pass != ""){
                        passval_field.classList.add('is-valid');
                        passval_field.classList.remove('is-invalid');
                    }
                }
            }
            // Starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    let pass = document.getElementById('mypass').value;
                    let passval = document.getElementById('mypassval').value;
                    let passval_field = document.getElementById('mypassval');

                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
            })();
        </script>

    </body>
    </html>

    <?php
}
else{
    ?>
        <script>
            alert("Please log out before going to the sign-up page!");
            location.assign("home.php"); 
        </script>
    <?php
}

?>