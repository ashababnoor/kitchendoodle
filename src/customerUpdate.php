<?php

session_start();

if(
    !isset($_GET['id']) ||
    empty($_GET['id'])
) {
    ?>
        <script>location.assign("ingredientList.php");</script>
    <?php
}

$_SESSION['current_page'] = 'customerUpdate.php?id='.$_GET['id'];

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    $id = $_GET['id'];
    $first_name = "";
    $last_name = "";
    $dob;
    $email = "";
    $phone = "";
    $weight = 0;
    $height = 0;
    $gender = "";

    try{
        $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querystring = "SELECT * FROM customers WHERE id=$id";

        $returnobj = $conn->query($querystring);

        if($returnobj->rowCount()==1){
            foreach($returnobj as $row){
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $dob = $row['dob'];
                $email = $row['email'];
                $phone = $row['phone'];
                $weight = $row['weight'];
                $height = $row['height'];
                $gender = $row['gender'];
            }
        }
        else{
            ?>
                <script>
                    location.assign("ingredientList.php");
                    alert("Ingredient not found!");
                </script>
            <?php
        }
    }
    catch(PDOException $ex){

        //reroute to login page
        ?>
            <script>location.assign("ingredientList.php");</script>
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
        
        <title>Update Customer Info | KitchenDoodle</title>

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
                <h4> Update Customer Info - <?php echo $first_name." ".$last_name ?> </h4>
                <input type="button" class="btn btn-light" value="Show All Customers" onclick="redirect('customerList.php')">
            </div>
            <div>
                <!-- Form for updating ingredients -->
                <form action="customerUpdateProcess.php" method="post">

                    <!-- Hidden Variable -->
                    <input type="hidden" name="id" value="<?php echo $id ?>">

                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input class="form-control" type="text" id="first-name" name="first-name" value="<?php echo $first_name ?>" placeholder="Enter first name">
                    </div>

                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input class="form-control" type="text" id="last-name" name="last-name" value="<?php echo $last_name ?>" placeholder="Enter last name">
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input class="form-control" type="date" id="dob" name="dob" value="<?php echo $dob ?>" placeholder="Enter date of birth">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" id="email" name="email" value="<?php echo $email ?>" placeholder="Enter email address">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input class="form-control" type="text" id="phone" name="phone" value="<?php echo $phone ?>" placeholder="Enter phone number">
                    </div>

                    <!-- <div class="form-group">
                        <label for="gender">Gender</label>
                        <input class="form-control" type="text" id="gender" name="gender" value="<?php echo $gender ?>" placeholder="Enter gender">
                    </div> -->

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="custom-select" id="gender" name="gender">
                            <option <?php if($gender == "") echo "selected" ?> value="">Choose gender</option>
                            <option <?php if($gender == "male") echo "selected" ?> value="male">Male</option>
                            <option <?php if($gender == "female") echo "selected" ?> value="female">Female</option>
                            <option <?php if($gender == "other") echo "selected" ?> value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="height">Height</label>
                        <input class="form-control" type="number" step="0.01" id="height" name="height" value="<?php echo $height ?>" placeholder="Enter height">
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input class="form-control" type="number" step="0.01" id="weight" name="weight" value="<?php echo $weight ?>" placeholder="Enter weight">
                    </div>

                    <input class="btn btn-success" type="submit" value="Click to Update Info">
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