<?php

session_start();

$_SESSION['current_page'] = 'bmiCalculator.php';

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){
    //page will be shown only if user is logged in
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
        <link href="css/style-employee-general.css" rel="stylesheet">

        <title>BMI Calculator | KitchenDoodle</title>
        <script src="js/bmi.js"></script>

        <style>
            .main-container{
                padding-left: 3em;
                padding-right: 3em;
            }
            #result{
                margin-top: 1em;
                margin-bottom: 0em;
            }
            .bmi-table{
                max-width: 600px;
                overflow: hidden;
                box-shadow: 0 0 0 0.1em black;
            }
            .content > div {
                margin-bottom: 0em;
            }
            .content > div > div{
                margin-bottom: 1.5em;
            }
        </style>
    </head>

    <body>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="home.php" class="navbar-brand"> <img src="images/kd-logo.svg" alt="KD" class="navbar-brand-image"> </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="recommendationsPage.php" class="nav-link"> Recommendations </a>
                    </li>
                    <li class="nav-item">
                        <a href="recipeSearchPage.php" class="nav-link"> Recipe </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" id="navbarDropDownForNutrition" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            Nutrition 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownForAccount">
                            <a href="bmiCalculator.php" class="dropdown-item"> BMI Calculator </a>
                            <a href="calorieCounter.php" class="dropdown-item"> Calorie Counter </a>
                            <a href="ingredientSearchPage.php" class="dropdown-item"> Nutrition Chart </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="plans.php" class="nav-link"> Plans </a>
                    </li>
                    <li class="nav-item">
                        <a href="faq.php" class="nav-link"> FAQ </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" id="navbarDropDownForAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            Your Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownForAccount">
                            <a href="" class="dropdown-item"> Settings </a>
                            <a href="wishlist.php" class="dropdown-item"> Wishlist </a>
                            <a href="" class="dropdown-item"> Meal Planner </a>
                            <a href="" class="dropdown-item"> Order History </a>
                            <a href="" class="dropdown-item"> Delivery Tracker </a>
                            <a href="" class="dropdown-item disable"> Suport </a>
                            <div class="dropdown-divider"></div>
                            <a href="logoutProcess.php" class="dropdown-item"> Log Out </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar End -->


        <div class="container-fluid content main-container">
            
            <div class="row">
                <div class="col-md-6 col-12 d-flex justify-content-between" style="flex-direction: column;">
                    <div class="d-flex align-items-center" style="margin-bottom: 1em;">
                        <h4 class="text-info"> Calculate Your Body Mass Index (BMI) </h4>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="height">Height (in centimeter)</label>
                            <input class="form-control" type="number" step="0.01" id="height" name="height" placeholder="Enter your height" autocomplete="off">
                        </div>
                        
                        <div class="form-group">
                            <label for="weight">Weight (in kilogram)</label>
                            <input class="form-control" type="number" step="0.01" id="weight" name="weight" placeholder="Enter your weight" autocomplete="off">
                        </div>
                        <button id="calculateButton" class="btn btn-info" onclick="calculateBMI()"> Calculate &nbsp;<i class='fas fa-calculator'></i> </button>

                        <div id="result">
                            <!-- calculateBMI() Function call will show output here -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 d-flex justify-content-center">
                    <table class="table table-borderless rounded bmi-table">
                        <thead class="thead-dark">
                            <tr>
                                <th> BMI Score </th>
                                <th> Category </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-warning">
                                <th> Less than 18.5 </th>
                                <td> Underweight </td>
                            </tr>
                            <tr class="table-success">
                                <th> 18.5 to 24.9 </th>
                                <td> Normal Weight </td>
                            </tr>
                            <tr class="table-warning table-danger">
                                <th> 25 to 29.9 </th>
                                <td> Overweight </td>
                            </tr>
                            <tr class="transparent-orange-1 table-danger">
                                <th> 30 to 34.9 </th>
                                <td> Obesity - Class I </td>
                            </tr>
                            <tr class="transparent-orange-1 table-danger">
                                <th> 35 to 39.9 </th>
                                <td> Obesity - Class II </td>
                            </tr>
                            <tr class="transparent-red">
                                <th> 40 or More </th>
                                <td> Morbid Obesity </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col" id="info-div">

                </div>
            </div>
        </div>


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

    </body>
    </html>

    <?php

}
else{
    ?>
        <script> location.assign("login.php") </script>
    <?php
}

?>