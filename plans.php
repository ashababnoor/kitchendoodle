<?php

session_start();

$_SESSION['current_page'] = 'plans.php';

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
        <link href="css/style-home.css" rel="stylesheet">
        <link href="css/style-plans.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>

        <title>Plans &amp; Pricing | KitchenDoodle</title>
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


        <div class="content main-container">
            <div class="column-container">
                <div>
                    <h4 class="text-info"> Plans &amp; Pricing </h4>
                    <hr>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="card-outer-container">
                        <div class="plan-card-container">
                            <div class="plan-card">
                                <div class="card-front">
                                    <img src="images/pricing-card-spiral-01.jpg" alt="Plan: Standard">
                                </div>
                                <div class="card-back">
                                    <div class="plan-card-content">
                                        <h4 class="card-title"> Standard Plan </h4>
                                        <hr>
                                        <ul class="plan-list">
                                            <li>Most suitable for bachelors and newly-weds.</li>
                                            <li>Pick any number of serving size for each meal.</li>
                                            <li>Quick and easy with guaranteed satisfaction!</li>
                                        </ul>
                                        <h6>Delivery Charge: <del>70Tk.</del> <b style="font-size: 1.3em;">FREE</b> </h6>
                                        <p style="font-size: 0.9em;">(on orders worth 1,000Tk. or more)</p>
                                        <button class="btn plan-button" onclick="redirect('selectMeals.php?plan=standard')">Select Meals</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="plan-card-container">
                            <div class="plan-card">
                                <div class="card-front">
                                    <img src="images/pricing-card-spiral-02.jpg" alt="Plan: Bulk">
                                </div>
                                <div class="card-back">
                                    <div class="plan-card-content">
                                        <h4 class="card-title"> Bulk Plan </h4>
                                        <hr>
                                        <ul class="plan-list">
                                            <li>Perfect for families and large gatherings.</li>
                                            <li>Minimum serving size <b>04</b> for each meal.</li>
                                            <li>Enjoy 10&percnt; discount on every meal!</li>
                                        </ul>
                                        <h6>Delivery Charge: <del>70Tk.</del> <b style="font-size: 1.3em;">FREE</b> </h6>
                                        <p style="font-size: 0.9em;">(on orders worth 1,000Tk. or more)</p>
                                        <button class="btn plan-button" onclick="redirect('selectMeals.php?plan=bulk')">Select Meals</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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