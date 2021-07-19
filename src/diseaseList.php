<?php

session_start();

$_SESSION['current_page'] = 'diseaseList.php';

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
        <!-- DataTables CSS -->
        <link href="dataTables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>

        <title>Diseases List | KitchenDoodle</title>

        <style>
            .btn-fit{
                padding: 0.35em 0.6em;
                margin-bottom: 5px;
                width: 17ch;
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
                <h4> Disease List </h4>
                <input type="button" class="btn btn-light" value="Add New Disease" onclick="showHiddenSection()">
            </div>

            <div id="hidden-section" style="padding-top: 1em; padding-bottom: 1em;">

                <!-- Form for adding disease -->
                <form action="diseaseAddProcess.php" method="post">

                    <div class="form-group">
                        <label for="diseaseName">Disease Name</label>
                        <input class="form-control" type="text" id="diseaseName" name="diseaseName" placeholder="Enter disease name">
                    </div>
                    <input class="btn btn-sm btn-light" type="submit" value="Click to Add Disease">
                </form>
            </div>

            <div class="table-responsive">
                <!-- Disease Table -->
                <table class="table table-hover" id="dataTable">
                    <thead class="thead-light">
                        <th> ID </th> 
                        <th> Disease Name </th>
                        <th> Action </th>
                    </thead>
                    <tbody>
                        <?php
                            try{
                                $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $querystring = "SELECT * FROM diseases";
                    
                                $returnobj = $conn->query($querystring);
                                $returntable = $returnobj->fetchAll();
                    
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
                                                <td class="action-tabledata">
                                                    <input type="button" class="btn btn-sm btn-info btn-fit" value="Restricted Foods" onclick="redirect('diseaseRestrictedFood.php?id=<?php echo $rows['id'] ?>')">
                                                    <input type="button" class="btn btn-sm btn-danger btn-fit" value="Delete Disease" onclick="deletefn(<?php echo $rows['id'] ?>, 'diseases');">
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