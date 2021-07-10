<?php

session_start();

if(
    !isset($_GET['recipeId']) ||
    empty($_GET['recipeId'])
) {
    ?>
        <script>location.assign("recipeList.php");</script>
    <?php
}

$_SESSION['current_page'] = 'recipeIngredients.php?recipeId=';
$_SESSION['current_page'] .= $_GET['recipeId'];

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    $id = $_GET['recipeId'];
    $recipeName = "";

    try{
        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querystring = "SELECT * FROM recipes WHERE id='$id'";

        $returnobj = $conn->query($querystring);

        if($returnobj->rowCount()==1){
            foreach($returnobj as $row){
                $recipeName = $row['name'];
            }
        }
        else{
            ?>
                <script>location.assign("recipeList.php");</script>
            <?php
        }
    }
    catch(PDOException $ex){

        //reroute to login page
        ?>
            <script>location.assign("recipeList.php");</script>
        <?php
    }

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
        <link href="css/style-live-search.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="dataTables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>
        <script type="text/javascript" src="js/searchIngredientForRecipe.js"></script>
        
        <title>Add Ingredients To Recipe | KitchenDoodle</title>

        <style>
            .form-group{
                padding: 0em 0em;
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
            h5 {
                font-weight: bold;
                color: #777;
            }
            .inner-btn-col > *{
                margin-top: 0.5em;
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
            <div class="d-flex justify-content-between align-items-center flex-columns" style="margin-bottom: 1em;">
                <div>
                    <h5> Ingredient List for </h5>
                    <h4>
                        <?php echo $recipeName; ?>
                    </h4>
                </div>

                <div>
                    <div class="inner-btn-col float-md-right">
                        <a class="btn btn-light" href="recipeList.php"> Show All Recipes </a>
                        <a class="btn btn-light" href="recipeDetailsEmployee.php?id=<?php echo $id ?>" > View Recipe Details </a>
                        <input type="button" class="btn btn-light" value="Add New Ingredient" onclick="showHiddenSection()">
                    </div>
                </div>
            </div>

            <div id="hidden-section" style="padding-top: 1em; padding-bottom: 2.3em;">

                <label for="search-box">Search Ingredient</label>
                <div class="" id="searchbar-div">

                    <!-- AJAX Live Search -->
                    
                    <div id="search-input-div" class="icon-div d-flex justify-content-center align-items-center">
                        <i class="fas fa-search" id="search-icon"></i>
                        <input class="" type="text" autocomplete="off" id="search-box" placeholder="Search ingredients" onkeyup="searchfunction()">
                    </div>
                    
                    
                    <div class="search-result" id="search-list">
                        
                    </div>
                </div>

                <!-- Form for adding ingredients -->
                <form action="recipeIngredientsAddProcess.php" method="post">

                    <!-- Hidden variable for form -->
                    <input type="hidden" name="recipeId" value="<?php echo $id; ?>"> 

                    <input type="hidden" autocomplete="off" id="ingredientName" name="ingredientName" placeholder="Ingredient from search">
                    <input type="hidden" id="ingredientId" name="ingredientId">
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter ingredient amount">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit">Unit</label>
                            <input type="text" disabled class="form-control" id="unit" placeholder="Ingredient unit from search">
                            <input type="hidden" id="unit-hidden" name="unit">
                        </div>
                    </div>
                    <input class="btn btn-sm btn-success" type="submit" value="Click to Add Ingredient">
                </form>
            </div>

            <div class="table-responsive">
                <!-- Ingredients Table -->
                <table class="table table-hover" id="dataTable">
                    <thead class="thead-light">
                        <th> Name </th>
                        <th> Amount </th>
                        <th> Unit </th>
                        <th> Action </th>
                    </thead>

                    <!-- Main Body of the table -->
                    <tbody>
                        <?php
                            try{
                                $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $querystring = "SELECT * FROM recipes_ingredients WHERE recipe_id = $id";
                    
                                $returnobj = $conn->query($querystring);
                                $returntable = $returnobj->fetchAll();
                    
                                if($returnobj->rowCount()==0){
                                    ?>
                                        <tr>
                                            <td colspan="4"> No Values Found </td>
                                        </tr>
                                    <?php
                                }
                                else{
                                    foreach($returntable as $rows){
                                        ?>
                                            <tr>
                                                <td> 
                                                    <?php 
                                                        $ingredientId = $rows['ingredient_id'];
                                                        try{
                                                            $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                
                                                            $querystring = "SELECT * FROM ingredients WHERE id = $ingredientId";
                                                
                                                            $returnobj = $conn->query($querystring);
                    
                                                            if($returnobj->rowCount()==1){
                                                                foreach($returnobj as $innerrow){
                                                                    $ingredientName = $innerrow['name'];
                                                                }
                                                            }
                                                        }
                                                        catch(PDOException $ex){
                                                        }
                                                        echo $ingredientName;
                                                    ?>
                                                </td>
                                                <td><?php echo $rows['amount'] ?></td>
                                                <td><?php echo $rows['unit'] ?></td>
                                                <td class="action-tabledata">
                                                    <input type="button" class="btn btn-sm btn-danger btn-fit" value="Delete" onclick="deletefn_recipeIngredient(<?php echo $id ?>, <?php echo $ingredientId ?>);">
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="7"> No Data Found </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
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
        
        <!-- JS files for DataTables -->
        <script src="dataTables/jquery.dataTables.min.js"></script>
        <script src="dataTables/dataTables.bootstrap4.min.js"></script>

        <script>
            // Call the dataTables jQuery plugin
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });

        </script>

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