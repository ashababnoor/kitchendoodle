<?php

session_start();

if(
    !isset($_GET['id']) ||
    empty($_GET['id'])
) {
    ?>
        <script>location.assign("recipeSearchPage.php");</script>
    <?php
}

$_SESSION['current_page'] = 'recipeDetails.php?id=';
$_SESSION['current_page'] .= $_GET['id'];

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){

    $id = $_GET['id'];
    $name = "";
    $ytlink = "";
    $description = "";
    $amount = 0;
    $unit = "";
    $total_calorie = 0;
    $total_price = 0;
    $total_carb = 0;
    $total_fat = 0;
    $total_protein = 0;

    $myid = $_SESSION['myid'];
    $wishStatus = "";

    try{
        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $wishListQuery = "SELECT * FROM wishlists WHERE customer_id = $myid AND recipe_id = $id";
        $returnWishObj = $conn->query($wishListQuery);

        if($returnWishObj->rowCount()==0){
            $wishStatus = "false";
        }else{
            $wishStatus = "true";
        }

        $querystring = "SELECT * FROM recipes WHERE id='$id'";

        $returnobj = $conn->query($querystring);

        if($returnobj->rowCount()==1){
            foreach($returnobj as $row){
                $name = $row['name'];
                $ytlink = $row['yt_link'];
                $description = $row['description'];
                $amount = $row['amount'];
                $unit = $row['unit'];
                $total_calorie = $row['total_calorie'];
                $total_price = $row['total_price'];
                $total_carb = $row['total_carb'];
                $total_fat = $row['total_fat'];
                $total_protein = $row['total_protein'];
            }
        }
        else{
            ?>
                <script>
                    location.assign("recipeSearchPage.php");
                </script>
            <?php
        }
    }
    catch(PDOException $ex){

        //reroute to login page
        ?>
            <script>
                location.assign("recipeSearchPage.php");
                alert("Database error!");
            </script>
        <?php
    }


    //page will be shown only if employee is logged in
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
        <link href="css/style-employee-general.css" rel="stylesheet">
        <link href="css/style-recipe-details.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>
        <!-- Chart.js CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>

        <title><?php echo $name ?> - Recipe Details | KitchenDoodle</title>

        <style>
            #title-row{
                border-bottom: 1px solid #aaa;
            }
            #wish-alert{
                margin: 1em 0em;
            }
            #wish-alert-close{
                height: 100%;
                padding: 0em 0.8em;
                margin: auto;
            }
            #content-row {
                margin-top: 1em;
            }
            .flex-columns {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
            .flex-columns>* {
                flex-basis: calc((850px - 100%) * 999);
                flex-grow: 1;
                padding: 0em;
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

        <div class="content">
            <div class="column-container">
            
                <!-- Title Row -->
                <div class="" id="title-row">
                    <div class="d-flex justify-content-between align-items-center flex-columns">
                        <div>
                            <h4 class=""> 
                                <?php echo $name ?> 
                            </h4>
                            <h6>
                                Price: <?php echo $total_price; ?> BDT (per serving) &nbsp;|&nbsp; Total Calorie: <?php echo $total_calorie; ?> Calories
                            </h6>
                        </div>

                        <div class="" style="margin-bottom: 1em;">
                            <button class="btn btn-warning float-md-right" onclick="wishListFunc()" id="wish-button">
                                <?php
                                if($wishStatus == "false"){
                                    ?>
                                        <i class='far fa-star'></i>
                                        Add to Wishlist
                                    <?php
                                }else{
                                    ?>
                                        <i class='fas fa-star'></i>
                                        Added to Wishlist
                                    <?php
                                }
                                ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="alert-container">
                    
                </div>

                <!-- Action Row -->
                <div class="" id="action-row">
                    
                </div>

                <!-- Content Row -->

                <div class="row" id="content-row">

                    <div class="col-lg-6 col-12">

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <h5>
                                        <i class='fas fa-list-ul' style='font-size:1em'></i>
                                        Ingredients List
                                    </h5>
                                    
                                    <?php
                                    
                                    try{
                                        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                        $querystring = "SELECT i.name as name, i.id as i_id, ri.amount as amount, ri.unit as unit FROM recipes_ingredients as ri JOIN ingredients as i ON ri.ingredient_id = i.id WHERE recipe_id=$id";
                                
                                        $returnobj = $conn->query($querystring);
                                        $returntable = $returnobj->fetchAll();
                                        
                                        if($returnobj->rowCount()==0){
                                            ?>
                                                No Data Found.
                                            <?php
                                        }
                                        else{
                                            ?> 
                                                <ul> 
                                            <?php
                                            foreach($returntable as $row){
                                                $str = $row['name']." - ".$row['amount']." ".$row['unit'];

                                                ?>
                                                    <li class="ingredient-list-item"> <a href="ingredientDetails.php?id=<?php echo $row['i_id']; ?>"> <?php echo $str; ?></a> </li>
                                                <?php
                                            }
                                            ?>
                                                </ul>
                                            <?php
                                        }
                                    }
                                    catch(PDOException $ex){
                                        ?>
                                            <script>
                                                alert("Database error!");
                                            </script>
                                        <?php
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div> 

                        <div class="row" style="margin-bottom: 3em;">
                            <div class="col-12">
                                <div>
                                    <h5>
                                        <i class='fas fa-tasks'></i> 
                                        Step-by-Step Instructions 
                                    </h5>
                                    <div class="recipe-description">
                                        <?php echo nl2br($description); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <h5 class="">
                                        <i class='fas fa-chart-pie'></i> 
                                        Calorie Breakdown
                                    </h5>
                                    <div class="chart-div">
                                        <canvas id="myChart">
                                        
                                        </canvas>
                                    </div>
                                    <div class="row" id="stats" style="width: 85%; margin: auto; margin-top: 2em">

                                        <?php
                                        
                                        $fat = $total_fat;
                                        $carb = $total_carb;
                                        $protein = $total_protein;

                                        $total = $fat + $protein + $carb;

                                        if($total != 0){
                                            $fat_p = round((($fat / $total) * 100), 2);
                                            $carb_p = round((($carb / $total) * 100), 2);
                                            $protein_p = 100 - $fat_p - $carb_p; 
                                        }
                                        else{
                                            $fat_p = "-- ";
                                            $carb_p = "-- ";
                                            $protein_p = "-- ";
                                        }

                                        $fat_p = round((($fat / $total) * 100), 2);
                                        $carb_p = round((($carb / $total) * 100), 2);
                                        $protein_p = 100 - $fat_p - $carb_p;

                                        ?>

                                        <div class="col-4">
                                            <p> <?php echo $fat_p ?>&percnt; <br> <span id="stat-gram"> <?php echo $fat ?> gram </span> </p>
                                            <p style="background-color: #ffcc29;"> Fat </p>
                                        </div>
                                        <div class="col-4">
                                            <p> <?php echo $protein_p ?>&percnt; <br> <span id="stat-gram"> <?php echo $protein ?> gram </span> </p>
                                            <p style="background-color: #81b214;"> Protein </p>
                                        </div>
                                        <div class="col-4">
                                            <p> <?php echo $carb_p ?>&percnt; <br> <span id="stat-gram"> <?php echo $carb ?> gram </span> </p>
                                            <p style="background-color: #206a5d; color: white"> Carb </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <h5 class="">
                                        <i class='fab fa-youtube'></i> 
                                        YouTube Tutorial
                                    </h5>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="<?php echo $ytlink ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

        <script>
            let myChart = document.getElementById('myChart').getContext('2d');
            
            Chart.defaults.font.size = 16;

            let chartObj = new Chart(myChart, {
                type: 'doughnut',
                data: {
                    labels: ['Fat', 'Protein', 'Carb'],
                    datasets: [{
                        data: [
                            <?php echo $total_fat ?>, 
                            <?php echo $total_protein ?>, 
                            <?php echo $total_carb ?>
                        ],
                        backgroundColor: [
                            '#ffcc29',
                            '#81b214',
                            '#206a5d'
                        ]
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            var wish_status = "<?php echo $wishStatus; ?>";

            function wishListFunc(){
                let container = document.getElementById('alert-container');
                let button = document.getElementById('wish-button');

                let addRequest = "id=<?php echo $id ?>&request=add";
                let removeRequest = "id=<?php echo $id ?>&request=remove";

                var ourRequest = new XMLHttpRequest();
                var response = "";

                ourRequest.onload = function (){
                    response = this.responseText;
                };

                ourRequest.open('POST', 'wishlistProcess.php');
                ourRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                if(wish_status == "false"){
                    ourRequest.send(addRequest);

                    container.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert" id="wish-alert">
                                                <strong>Hurray!</strong> This recipe has been added to your <a href="wishlist.php" class="alert-link">wishlist!</a>
                                                <button type="button" class="close" id="wish-alert-close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>`;
                    wish_status = "true";
                    button.innerHTML = "<i class='fas fa-star'></i> Added to Wishlist";
                }
                else{
                    ourRequest.send(removeRequest);

                    container.innerHTML = `<div class="alert alert-warning alert-dismissible fade show" role="alert" id="wish-alert">
                                                This recipe has been removed from your <a href="wishlist.php" class="alert-link"> wishlist. </a>
                                                <button type="button" class="close" id="wish-alert-close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>`;
                    wish_status = "false";
                    button.innerHTML = "<i class='far fa-star'></i> Add to Wishlist";
                }
            }
        </script>

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