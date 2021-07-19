<?php

session_start();

$_SESSION['current_page'] = 'employeeHome.php';

if(
    //when the employee isn't logged in  then we will take him to login page
    
    !isset($_SESSION['emp_email']) ||
    empty($_SESSION['emp_email'])
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

        <title>Employee Login | KitchenDoodle</title>
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
        <div class="container-fluid login-container content" style="padding:4em 2em">
            <div class="d-flex justify-content-center d-flex align-items-center" style="flex-direction: column;">
            <img src="images/kd-logo-full-green.svg" alt="" class="full-logo" onclick="redirect('index.html')" style="cursor: pointer;"> 
                
                <h4 style="margin-top: 1em; margin-bottom:2em;">Employee Login</h4>
            </div>

            <form action="employeeLoginProcess.php" method="post">
                <div class="form-group">
                    <label for="myemail">Email</label>
                    <input class="form-control" type="email" id="myemail" name="myemail" placeholder="Your email">
                </div>

                <div class="form-group">
                    <label for="mypass">Password</label>
                    <input class="form-control" type="password" id="mypass" name="mypass" placeholder="Your password">
                </div>
                
                <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 1em;">
                    <a href="index.html" class="muted-link">Not an employee? </a>
                    <input class="btn btn-primary" type="submit" value="Click to Login">
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js " integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx " crossorigin="anonymous "></script>
        
    </body>
    </html>

    <?php
}
else{
    ?>
        <script> location.assign("employeeHome.php"); </script>
    <?php
}

?>