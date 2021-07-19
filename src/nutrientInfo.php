<?php

session_start();

$_SESSION['current_page'] = 'nutrientInfo.php';

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
        
        <!-- DataTables CSS -->
        <link href="dataTables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-employee-general.css" rel="stylesheet">
        

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>

        <title>Ingredient Nutrition Information | KitchenDoodle</title>

        <style>
            .btn-fit{
                padding: 0.35em 0.6em;
                margin-bottom: 5px;
                
            }
            #attr-action{
                max-width: 1px;
            }
            #attr-action-btn{
                width: max-content;
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
                <h4> Ingredient-wise Nutrition Info </h4>
                <div>
                    <input type="button" class="btn btn-light" value="Add New Attribute" onclick="showHiddenSection('form')">
                </div>
                
            </div>

            <div id="hidden-section">
            <div style="padding-top: 1em; padding-bottom: 1em;">

                <!-- Form for adding disease -->
                <form action="nutrionalAttributeAddProcess.php" method="post">

                    <div class="form-group">
                        <label for="attrName">Nutrional Attribute Name</label>
                        <input class="form-control" type="text" id="attrName" name="attrName" placeholder="Enter nutritional attribute name">
                    </div>
                    <input class="btn btn-sm btn-light" type="submit" value="Click to Add Attribute">
                </form>
            </div>

            <div class="table-responsive">

                <!-- Attribute Table -->
                <table class="table table-hover" id="dataTableAttr">
                    <thead class="thead-light">
                        <th> ID </th> 
                        <th> Attribute Name </th>
                        <th id="attr-action"> Action </th>
                    </thead>
                    <tbody>
                        <?php
                            try{
                                $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $querystring = "SELECT * FROM ingredient_attributes";
                    
                                $returnobj = $conn->query($querystring);
                                $returntable = $returnobj->fetchAll();

                                $attrNo = $returnobj->rowCount();
                    
                                if($returnobj->rowCount()==0){                    
                                    ?>
                                        <tr>
                                            <td colspan="3"> No Values Found </td>
                                        </tr>
                                    <?php
                                }
                                else{
                                    foreach($returntable as $rows){
                                        ?>
                                            <tr>
                                                <td> <?php echo $rows['id'] ?> </td>
                                                <td><?php echo $rows['name'] ?></td>
                                                <td class="action-tabledata" id="attr-action">
                                                    <input type="button" id="attr-action-btn" class="btn btn-sm btn-danger btn-fit float-right" value="Delete Attribute" onclick="deletefn(<?php echo $rows['id'] ?>, 'ingredient_attributes');">
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="3"> No Data Found </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="margin-bottom: 2em;">

            </div>
            </div>

            
            <div class="table-responsive">

                <!-- Ingredient Table -->
                <table class="table table-hover" id="dataTable">
                    <thead class="thead-light">
                        <th> ID </th> 
                        <th> Ingredient Name </th>
                        <th> Attr. Count </th>
                        <th> Action </th>
                    </thead>
                    <tbody>
                        <?php
                            try{
                                $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $querystring = "SELECT * FROM ingredients";
                    
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

                                        $ingredientId = $rows['id'];

                                        $attrQuery = "SELECT * FROM ingredient_attributes_info WHERE ingredient_id = $ingredientId";
                                        $attrObj = $conn->query($attrQuery);
                                        $attrCount = $attrObj->rowCount();

                                        ?>
                                            <tr>
                                                <td> <?php echo $ingredientId ?> </td>
                                                <td><?php echo $rows['name'] ?></td>
                                                <td> <?php echo $attrCount ?> out of <?php echo $attrNo ?> </td>
                                                <td class="action-tabledata">
                                                    <input type="button" class="btn btn-sm btn-primary btn-fit" value="Update Attribute Info" onclick="redirect('ingredientAttribute.php?id='+<?php echo $ingredientId ?>);">
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="4"> No Data Found </td>
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

        <script type="text/javascript" src="js/code.js"></script>

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

            $(document).ready(function() {
                $('#dataTableAttr').DataTable();
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