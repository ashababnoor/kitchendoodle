<?php

session_start();


if(
    !isset($_GET['id']) ||
    empty($_GET['id'])
) {
    ?>
        <script>location.assign("recipeList.php");</script>
    <?php
}

$_SESSION['current_page'] = 'recipeUpdate.php?id=';
$_SESSION['current_page'] .= $_GET['id'];


if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){

    $id = $_GET['id'];
    $recipeName = "";
    $yt_link = "";
    $description = "";
    $amount = 0;
    $unit = "";

    try{
        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querystring = "SELECT * FROM recipes WHERE id='$id'";

        $returnobj = $conn->query($querystring);

        if($returnobj->rowCount()==1){
            foreach($returnobj as $row){
                $recipeName = $row['name'];
                $yt_link = $row['yt_link'];
                $description = $row['description'];
                //echo $description;
                $amount = $row['amount'];
                $unit = $row['unit'];
            }
        }
        else{
            ?>
                <script>
                    location.assign("recipeList.php");
                    alert("Recipe not found!");
                </script>
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

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>
        
        <title>Update Recipe | KitchenDoodle</title>

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
                <h4> Update Recipe - <?php echo $recipeName ?> </h4>
                <input type="button" class="btn btn-light" value="Show All Recipes" onclick="redirect('recipeList.php')">
            </div>
            <div>
                <!-- Form for updating recipes -->
                <form action="recipeUpdateProcess.php" method="post">

                    <!-- Hidden Variable -->
                    <input type="hidden" name="id" value="<?php echo $id ?>">

                    <div class="form-group">
                        <label for="name">Recipe Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="<?php echo $recipeName ?>" placeholder="Enter recipe name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <!-- <input class="form-control" type="text" id="calorie" name="calorie" placeholder="Enter recipe description"> -->
                        <textarea class="form-control" id="description" name="description" placeholder="Enter recipe description" rows="5"><?php echo $description ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="amount">Standard Amount</label>
                        <input class="form-control" type="number" step="0.01" id="amount" name="amount" value="<?php echo $amount ?>" placeholder="Enter standard amount">
                    </div>

                    <div class="form-group">
                        <label for="unit">Standard Amount Unit</label>
                        <input class="form-control" type="text" id="unit" name="unit" value="<?php echo $unit ?>" placeholder="Enter standard amount unit">
                    </div>

                    <div class="form-group">
                        <label for="ytlink">
                            <i class='fab fa-youtube' style='font-size:1.2em;color:red'></i> 
                            YouTube Link
                        </label>
                        <input class="form-control" type="text" id="ytlink" name="ytlink" value="<?php echo $yt_link ?>" placeholder="Enter youtube video link">
                    </div>
                    <input class="btn btn-success" type="submit" value="Click to Update Recipe">
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