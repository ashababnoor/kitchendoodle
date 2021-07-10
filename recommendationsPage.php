<?php

session_start();

$_SESSION['current_page'] = 'recommendationsPage.php';

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){
    //page will be shown only if user is logged in

    $myid = $_SESSION['myid'];

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

        <title>Recommended Recipes | KitchenDoodle</title>

        <style>
            .card{
                margin-top: 1em;
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
                <div class="greetings">
                    <h4>
                        Hey <?php echo $_SESSION['myfirstname'];?>! We recommend you try out these recipes. 
                    </h4>
                </div>
                <hr>

                <?php

                try{
                    $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $fat = 0;
                    $carb = 0;
                    $protein = 0;

                    $fat_p = 0;
                    $carb_p = 0;
                    $protein_p = 0;

                    $counter = 0;

                    $preferenceStr = "SELECT * FROM preferences WHERE customer_id = $myid";
                    $prefObj = $conn->query($preferenceStr);

                    if($prefObj->rowCount()==1){
                        foreach($prefObj as $prefRow){
                            $fat = $prefRow['fat_amount'];
                            $protein = $prefRow['protein_amount'];
                            $carb = $prefRow['carb_amount'];
                        }
                    }
                    //echo $fat;
                    //echo $carb;
                    $querystring = "SELECT * FROM recipes WHERE total_price > 0";
            
                    $returnobj = $conn->query($querystring);
                    $returntable = $returnobj->fetchAll();
                    
                    if($returnobj->rowCount()==0){
                        ?>
                            <div class="alert alert-danger">
                                No Data Found.
                            </div> 
                        <?php
                    }
                    else{

                        if($fat == 0 && $protein == 0 && $carb == 0){
                            ?>
                                <div class="alert alert-warning">
                                    <strong>Oh no!</strong> No preference information found.
                                    <hr> <p class="mb-0"> Go to the <a href="calorieCounter.php" class="alert-link">calorie counter</a> to set your preference. </p>
                                </div> 
                            <?php                                                         
                        }
                        else{
                            ?> 
                                <div class="card-columns">
                            <?php

                            foreach($returntable as $row){
                                $id = $row['id'];
                                $str = $row['name'];
    
                                $r_carb = $row['total_carb'];
                                $r_fat = $row['total_fat'];
                                $r_protein = $row['total_protein'];
    
                                $total = $r_fat + $r_protein + $r_carb;
    
                                if($total != 0){
                                    $fat_p = round((($r_fat / $total) * 100), 2);
                                    $carb_p = round((($r_carb / $total) * 100), 2);
                                    $protein_p = 100 - $fat_p - $carb_p; 
                                }
                                else{
                                    $fat_p = "";
                                    $carb_p = "";
                                    $protein_p = "";
                                }

                                if($fat_p == ""){
                                    continue;
                                }
                                else if(
                                    (
                                        ($fat_p <= ($fat+10) && $fat_p >= ($fat-10)) &&
                                        ($protein_p <= ($protein+10) && $protein_p >= ($protein-10))
                                    ) ||
                                    (
                                        ($fat_p <= ($fat+10) && $fat_p >= ($fat-10)) &&
                                        ($carb_p <= ($carb+10) && $carb_p >= ($carb-10))
                                    ) ||
                                    (
                                        ($protein_p <= ($protein+10) && $protein_p >= ($protein-10)) &&
                                        ($carb_p <= ($carb+10) && $carb_p >= ($carb-10))
                                    )
                                ){
                                    $strSub = "Price: ".$row['total_price']." BDT <br> Total Calorie: ".$row['total_calorie']." Cal";
                                    $link = "recipeDetails.php?id=".$id;
                                    $ytlink = $row['yt_link'];

                                    $counter++;

                                    ?>
                                        <div class="card border-success">
        
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" src="<?php echo $ytlink ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
        
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $str ?></h5>
                                                <p class="card-text">
                                                    <?php echo $strSub ?>
                                                </p>
                                                <a href="recipeDetails.php?id=<?php echo $id ?>" class="btn-sm btn-success"> Learn More </a>
                                            </div>
                                        </div>
        
                                    <?php
                                }
                            }

                            ?>
                                </div>
                            <?php

                            if($counter == 0){
                                ?>
                                    <div class="alert alert-danger">
                                        <strong>Oh no!</strong> It looks like there is currently no recipe matching your preference.
                                        <hr> <p class="mb-0"> Go to the <a href="calorieCounter.php" class="alert-link">calorie counter</a> to update your preference. </p>
                                    </div> 
                                <?php
                            }
                        }

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