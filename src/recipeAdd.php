<?php

session_start();

$_SESSION['current_page'] = 'recipeAdd.php';

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
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

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>
        
        <title>Add New Recipes | KitchenDoodle</title>

        <style>
            .form-group{
                padding: 0.4em 0em;
            }
        </style>
    </head>

    <body>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="employeeHome.php" class="navbar-brand"> <img src="images/kd-logo-full-green.svg" alt="KD" class="navbar-brand-image"> </a>
            
            <div class="navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="employeeHome.php" class="nav-link" > Home Page </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar End -->

        <div class="container-fluid content main-container">
            <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 1em;">
                <h4> Add New Recipe </h4>
                <input type="button" class="btn btn-light" value="Show All Recipes" onclick="redirect('recipeList.php')">
            </div>
            <div>
                <!-- Form for adding recipes -->
                <form action="recipeAddProcess.php" method="post">

                    <div class="form-group">
                        <label for="name">Recipe Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter recipe name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <!-- <input class="form-control" type="text" id="calorie" name="calorie" placeholder="Enter recipe description"> -->
                        <textarea class="form-control" id="description" name="description" placeholder="Enter recipe description" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="amount">Standard Amount</label>
                        <input class="form-control" type="number" step="0.01" id="amount" name="amount" placeholder="Enter standard amount">
                    </div>

                    <div class="form-group">
                        <label for="unit">Standard Amount Unit</label>
                        <input class="form-control" type="text" id="unit" name="unit" placeholder="Enter standard amount unit">
                    </div>

                    <div class="form-group">
                        <label for="ytlink">
                            <i class='fab fa-youtube' style='font-size:1.2em;color:red'></i> 
                            YouTube Link
                        </label>
                        <input class="form-control" type="text" id="ytlink" name="ytlink" placeholder="Enter youtube video link">
                    </div>
                    <input class="btn btn-success" type="submit" value="Click to Add Recipe">
                </form>
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


        <!-- JS files needed for Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
    </html>

    <?php

}
else{
    ?>
        <script> location.assign("employeeLogin.php") </script>
    <?php
}

?>