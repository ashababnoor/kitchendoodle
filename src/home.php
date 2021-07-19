<?php

session_start();

$_SESSION['current_page'] = 'home.php';

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
        <link href="css/style-recipe.css" rel="stylesheet">
        <link href="css/style-home.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>

        <title>Home | KitchenDoodle</title>
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
                <div class="greetings">
                    <h4>
                        Hello, <?php echo $_SESSION['myfirstname'], ' ', $_SESSION['mylastname']; ?>
                    </h4>
                </div>
                <hr>
                <div class="card-columns">

                    <div class="card alert-success card-green">
                        <img class="card-img-top" src="images/card-recipe-sm.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Recipes</h5>
                            <p class="card-text">
                                Search recipes from our library of thousands of recipes, with easy to follow step-by-step instructions, list of ingredients and amount, calorie information and video tutorial.
                            </p>
                            <a href="recipeSearchPage.php" class="btn-sm btn-success"> Learn More </a>
                        </div>
                    </div>

                    <div class="card alert-warning card-yellow">
                        <img class="card-img-top" src="images/card-calorie-sm-1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Calorie Counter</h5>
                            <p class="card-text">
                                Want to know how much calorie you should take for your ideal weight and how to distribute calories to macros? Then check out our calorie counter.
                            </p> 
                            <a href="calorieCounter.php" class="btn-sm btn-warning"> Learn More </a>
                        </div>
                    </div>

                    <div class="card alert-primary card-blue">
                        <img class="card-img-top" src="images/card-plans-sm.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Plans</h5>
                            <p class="card-text">
                                Take a look at our plans and pick the one most suitable for you. Affordable and fresh straight from locals.
                            </p>
                            <a href="plans.php" class="btn-sm btn-primary"> Learn More </a>
                        </div>
                    </div>
                

                    <div class="card alert-success card-green">
                        <img class="card-img-top" src="images/card-bmi-sm-2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">BMI Calculator</h5>
                            <p class="card-text">
                                Curious about your health condition? Calculate your BMI with our BMI calculator and get suggestions based on your physical structure.
                            </p>
                            <a href="bmiCalculator.php" class="btn-sm btn-success"> Learn More </a>
                        </div>
                    </div>

                    <div class="card alert-warning card-yellow">
                        <img class="card-img-top" src="images/card-yellow-sm-1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Food & Nutrition</h5>
                            <p class="card-text">
                                Search for food information from our records and take a look at their nutritional and caloric information. As well as recipes that use these food items.
                            </p>
                            <a href="ingredientSearchPage.php" class="btn-sm btn-warning"> Learn More </a>
                        </div>
                    </div>

                    <div class="card alert-primary card-blue">
                        <img class="card-img-top" src="images/card-faq-sm.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">FAQ</h5>
                            <p class="card-text">
                                Curious about something? Don't know where to find what? Explore our FAQ section and find the answer you are looking for.
                            </p>
                            <a href="faq.php" class="btn-sm btn-primary"> Learn More </a>
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