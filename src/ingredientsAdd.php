<?php

session_start();

$_SESSION['current_page'] = 'ingredientsAdd.php';

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
        
        <title>Add New Ingredients | KitchenDoodle</title>

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
                <h4> Add New Ingredient </h4>
                <input type="button" class="btn btn-light" value="Show All Ingredients" onclick="redirect('ingredientsList.php')">
            </div>
            <div>
                <!-- Form for adding Ingredients -->
                <form action="ingredientsAddProcess.php" method="post">

                    <div class="form-group">
                        <label for="name">Ingredient Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter ingredient name">
                    </div>

                    <div class="form-group">
                        <label for="calorie">Calorie Amount</label>
                        <input class="form-control" type="number" step="0.01" id="calorie" name="calorie" placeholder="Enter calorie amount">
                    </div>

                    <div class="form-group">
                        <label for="carb">Carb Amount</label>
                        <input class="form-control" type="number" step="0.01" id="carb" name="carb" placeholder="Enter carb amount">
                    </div>

                    <div class="form-group">
                        <label for="fat">Fat Amount</label>
                        <input class="form-control" type="number" step="0.01" id="fat" name="fat" placeholder="Enter fat amount">
                    </div>

                    <div class="form-group">
                        <label for="protein">Protein Amount</label>
                        <input class="form-control" type="number" step="0.01" id="protein" name="protein" placeholder="Enter protein amount">
                    </div>

                    <div class="form-group">
                        <label for="measure_amount">Measurement Amount</label>
                        <input class="form-control" type="number" step="0.01" id="measure_amount" name="measure_amount" placeholder="Enter measurement amount">
                    </div>

                    <div class="form-group">
                        <label for="measure_unit">Measurement Unit</label>
                        <input class="form-control" type="text" id="measure_unit" name="measure_unit" placeholder="Enter measurement unit">
                    </div>

                    <div class="form-group">
                        <label for="stock_amount">Amount in Stock</label>
                        <input class="form-control" type="number" step="0.01" id="stock_amount" name="stock_amount" placeholder="Enter amount in stock">
                    </div>

                    <div class="form-group">
                        <label for="stock_unit">Stock Unit</label>
                        <input class="form-control" type="text" id="stock_unit" name="stock_unit" placeholder="Enter stock unit">
                    </div>

                    <div class="form-group">
                        <label for="price">Price per Measurement Amount</label>
                        <input class="form-control" type="number" step="0.01" id="price" name="price" placeholder="Enter price per measurement amount">
                    </div>
                    <input class="btn btn-success" type="submit" value="Click to Add Ingredient">
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