<?php

session_start();

$_SESSION['current_page'] = 'wishlist.php';

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

        <title>Wishlist | KitchenDoodle</title>
        <style>
            small{
                color: #888;
            }
            .result-link{
                color: #009245;
            }
            .result-link:hover{
                color: #206a5d;
            }
            #dataSearchBar{
                min-width: 100%;
                border-color: #ddd;
                border-radius: 0.3em;
            }
            h4{
                margin-top: 1rem; 
                margin-bottom: 0.5em;
            }
            .search-div{
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }
            .search-div > * {
                flex-basis: calc((850px - 100%) * 999);
                flex-grow: 1;
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
                <div class="d-flex justify-content-between align-items-start search-div">
                    <div>
                        <h4> Recipes in Your Wishlist </h4>
                    </div>
                </div>

                <hr>
                
                <div>
                    <?php

                    $myid = $_SESSION['myid'];
                                        
                    try{
                        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                        $querystring = "SELECT r.id as id,
                                               r.name as name,
                                               r.total_price as total_price,
                                               r.total_calorie as total_calorie
                                        
                                        FROM 
                                        wishlists as w
                                        JOIN
                                        recipes as r
                                        on w.recipe_id = r.id
                                        
                                        WHERE customer_id = $myid";
                
                        $returnobj = $conn->query($querystring);
                        $returntable = $returnobj->fetchAll();
                        
                        if($returnobj->rowCount()==0){
                            ?>
                                <div class="alert alert-primary">
                                    You have no recipes in your wishlist. <a href="recipeSearchPage.php" class="alert-link">Search</a> for some recipes or check out our list of <a href="allRecipes.php" class="alert-link">all recipes.</a>
                                </div> 
                            <?php
                        }
                        else{
                            ?> 
                                <ul class="list-group"> 
                            <?php
                            foreach($returntable as $row){
                                $id = $row['id'];
                                $str = $row['name'];
                                $strSub = "Price: ".$row['total_price']." BDT &nbsp;|&nbsp; Calorie: ".$row['total_calorie']." Calories";
                                $link = "recipeDetails.php?id=".$id;

                                ?>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="<?php echo $link; ?>" class="result-link">
                                            <?php echo $str; ?> 
                                        </a>

                                        <br> <!-- Line Break -->
                                        
                                        <small> 
                                            <?php echo $strSub; ?>
                                        </small> 
                                    </li>
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


        <!-- Footer Start -->
        <footer>
            <div class="row no-gutters text-center text-dark bg-light custom-footer">
                <div class="col-sm-4">
                    Contact Information
                </div>
                <div class="col-sm-4">
                    Copyright ?? 2021
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