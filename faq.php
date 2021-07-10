<?php

session_start();

$_SESSION['current_page'] = 'faq.php';

if(
    (
        isset($_SESSION['myemail']) &&
        !empty($_SESSION['myemail']) )
    // ) ||
    // (
    //     isset($_SESSION['emp_email']) &&
    //     !empty($_SESSION['emp_email'])
    // )
){
    $customer_navbar_visibility = "";
    $general_navbar_visibility = "hidden-section";
}
else{
    $customer_navbar_visibility = "hidden-section";
    $general_navbar_visibility = "";
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-landing-page.css" rel="stylesheet"> 

    <!-- External JS File -->
    <script type="text/javascript" src="js/code.js"></script>

    <title>FAQ | KitchenDoodle</title>

    <style>
        h4{
            margin-bottom: 1.3em;
        }
        .container-div{
            margin: auto;
            max-width: 80ch;
            
        }
        .social {
            margin-top: 1.5em;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->

    <!-- General Nav -->

    <nav id="<?php echo $general_navbar_visibility; ?>" class="navbar navbar-expand-md navbar-light extra-padding">
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

    <!-- Customer Nav -->

    <nav id="<?php echo $customer_navbar_visibility; ?>" class="navbar navbar-expand-md navbar-dark bg-dark">
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


    <!-- Accordion Start -->

    <div class="container-fluid content">
        <div class="container-div">
            <div class="">
                <h4> Frequently Asked Questions </h4>
            </div>

            <div class="accordion-container">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        1. What is KitchenDoodle?
                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem sint, eius necessitatibus facere ex voluptates quia eveniet. Dolor possimus dicta totam, quasi officia nam qui, dolores perferendis voluptates quaerat mollitia deleniti, rem illo harum veritatis odit incidunt voluptas? Doloribus placeat officia dolorem tempora magnam, molestiae illum, numquam voluptate eligendi doloremque quae laboriosam non esse maiores voluptas exercitationem eius sint impedit.
                        
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn text-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2. How can I pay for delivery?
                        </button>
                    </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae, deserunt perferendis eum eaque quos recusandae molestias. Adipisci praesentium enim nulla voluptatum veritatis aut natus repudiandae, totam temporibus fuga maiores architecto deserunt eligendi veniam tenetur blanditiis nemo, dolor unde ullam nisi quia accusamus autem illum expedita! Neque quas exercitationem corrupti fuga rerum tempore perferendis porro labore error incidunt, praesentium sit modi.
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn text-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3. How can I contact you?
                        </button>
                    </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut beatae, eaque provident ex iure, numquam nemo, blanditiis dolorem repellendus ea dolor. Quaerat similique doloribus, et delectus quam explicabo recusandae laboriosam praesentium nesciunt cupiditate optio nulla facere aliquid dolores harum, saepe possimus accusamus corrupti sit amet sint nihil enim alias. Incidunt veniam odio placeat illo harum provident iusto accusantium necessitatibus maiores!
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Accordion End -->

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


<!--
                    <div class="d-flex justify-content-center social">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary">
                                <a href="mailto:ashababnoor@gmail.com"> Email </a>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="http://github.com/ashababnoor" target="_blank" rel="noopener noreferrer"> Github </a>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="http://facebook.com/ashababnoor" target="_blank" rel="noopener noreferrer"> Facebook </a>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="http://instagram.com/ashababnoor" target="_blank" rel="noopener noreferrer"> Instagram </a>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="http://linkedin.com/in/ashababnoor" target="_blank" rel="noopener noreferrer"> LinkedIn </a>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="http://ftwitter.com/ashababnoor" target="_blank" rel="noopener noreferrer"> Twitter </a>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="http://facebook.com/adrn.designs" target="_blank" rel="noopener noreferrer"> Hire Me </a>
                            </button>
                        </div>
                    </div> 
-->