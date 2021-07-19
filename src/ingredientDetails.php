<?php

session_start();

if(
    !isset($_GET['id']) ||
    empty($_GET['id'])
) {
    ?>
        <script>
            var url = "<?php echo $_SESSION['current_page'] ;?>";
            location.assign(url);
        </script>
    <?php
}

$_SESSION['current_page'] = 'ingredientDetails.php?id=';
$_SESSION['current_page'] .= $_GET['id'];

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){

    $id = $_GET['id'];
    $name = "";
    $m_amount = 0;
    $m_unit = "";
    $calorie = 0;
    $carb = 0;
    $fat = 0;
    $protein = 0;

    try{
        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querystring = "SELECT * FROM ingredients WHERE id='$id'";

        $returnobj = $conn->query($querystring);

        if($returnobj->rowCount()==1){
            foreach($returnobj as $row){
                $name = $row['name'];
                $m_amount = $row['measurement_amount'];
                $m_unit = $row['measurement_unit'];
                $calorie = $row['calories'];
                $carb = $row['carbs'];
                $fat = $row['fat'];
                $protein = $row['protein'];
            }
        }
        else{
            ?>
                <script>
                    var url = "<?php echo $_SESSION['current_page'] ;?>";
                    location.assign(url);
                </script>
            <?php
        }
    }
    catch(PDOException $ex){

        ?>
            <script>
                var url = "<?php echo $_SESSION['current_page'] ;?>";
                location.assign(url);
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
        <link href="css/style-ingredient-details.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>
        <!-- Chart.js CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>

        <title><?php echo $name ?> - Ingredient Details | KitchenDoodle</title>

        <style>
            #action-row > * {
                margin-bottom: 0.5em;
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

        <div class="content main-container">
            <div class="column-container">

                <!-- Content Row -->

                <div class="row" id="content-row">

                    <div class="col-lg-6 col-12">

                        <!-- Title Row -->
                        <div class="" id="title-row">
                            <h4 class=""> <?php echo $name ?> </h4>
                            <h6>
                                Total <?php echo $calorie; ?> Calories per <?php echo $m_amount; ?> <?php echo $m_unit; ?>
                            </h6>
                        </div>

                        <!-- <hr style="margin: 0em;"> -->

                        <!-- Calorie Breakdown Chart -->
                        <div class="row main-content" style="margin-bottom: 3em;">
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
                                    <div class="row" id="stats" style="width: 80%; margin: auto; margin-top: 2em">

                                        <?php

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

                    </div>

                    <div class="col-lg-6 col-12 d-flex justify-content-center">
                        <table class="table table-borderless attr-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" class="table-main-header"> Nutrition Facts </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="alert-secondary">
                                    <td colspan="2" class="sub-header">
                                        <div>
                                            <?php echo $name; ?>
                                            <br>
                                            <span class="sub-sub-header"> Serving Size - <?php echo $m_amount; ?> <?php echo $m_unit; ?> </span>
                                            <hr style="margin: 0.5em 0em 0.1em; padding: 0em">
                                            <div class="sub-sub-header" style="font-weight: bold;">Amounts per Serving <span class="float-right"> <?php echo $calorie ?> Calories </span> </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="bg-success text-light">
                                    <td colspan="2" class="main-stat-row">
                                        <div> <b>Fat</b> <span class="float-right"> <?php echo $fat ?> gram </span> </div>
                                        <div> <b>Protein</b> <span class="float-right"> <?php echo $protein ?> gram </span> </div>
                                        <div> <b>Carbohydrate</b> <span class="float-right"> <?php echo $carb ?> gram </span> </div>
                                    </td>
                                </tr>

                                <!-- Dynamic Table Rows -->
                                <?php

                                    $rowCounter = 1;
                                    $attrId = 0;
                                    $attrName = "";

                                    $amount = 0;
                                    $unit ="";

                                    try{
                                        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $querystring = "SELECT * FROM ingredient_attributes";

                                        $returnobj = $conn->query($querystring);
                                        $returnTable = $returnobj->fetchAll();

                                        if($returnobj->rowCount() != 0){
                                            foreach($returnTable as $row){
                                                $attrId = $row['id'];
                                                $attrName = $row['name'];

                                                $attrQuery = "SELECT * FROM ingredient_attributes_info WHERE ingredient_id = $id AND attribute_id = $attrId";
                                                $attrObj = $conn->query($attrQuery);

                                                if($attrObj->rowCount()==1){
                                                    foreach($attrObj as $attr){
                                                        $amount = $attr['amount'];
                                                        if($attr['unit'] != "%"){
                                                            $unit = " ".$attr['unit'];
                                                        }
                                                        else{
                                                            $unit = $attr['unit'];
                                                        }
                                                    }
                                                }
                                                else{
                                                    $amount = "-";
                                                    $unit = "-";
                                                }
                                                ?>
                                                    <tr class="<?php if($rowCounter == 1){echo "alert-success";} else{echo "alert-warning";} ?>">
                                                        <td colspan="2">
                                                            <div><b><?php echo $attrName; ?></b> <span class="float-right"> <?php echo $amount ?><?php echo $unit ?> </span> </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $rowCounter = $rowCounter * (-1);
                                            }
                                        }
                                        else{
                                            ?>
                                                <tr class="alert-danger">
                                                    <td colspan="2">
                                                        No Attribute Data Found!
                                                    </td>
                                                </tr>
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

                            </tbody>
                        </table>
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
            function recipeUpdate(id){
                var result = confirm("Are you sure you want to update this ingredient? \nThis will affect all recipes that has this ingredient!");
                if(result){
                    redirect('ingredientUpdate.php?id='+id);
                }
            }

            let myChart = document.getElementById('myChart').getContext('2d');

            Chart.defaults.font.size = 16;

            let chartObj = new Chart(myChart, {
                type: 'doughnut',
                data: {
                    labels: ['Fat', 'Protein', 'Carb'],
                    datasets: [{
                        data: [
                            <?php echo $fat ?>,
                            <?php echo $protein ?>,
                            <?php echo $carb ?>
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