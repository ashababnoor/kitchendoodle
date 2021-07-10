<?php

session_start();

$_SESSION['current_page'] = 'ingredientsList.php';

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
        <link href="css/style-recipe.css" rel="stylesheet">
        <link href="css/style-employee-general.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="dataTables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>

        <title> List of All Ingredients | KitchenDoodle</title>

        <style>
            .btn-fit{
                padding: 0.35em;
                margin-bottom: 5px;
            }
            .small-text{
                font-size: 0.9em;
            }
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
            #dataSearchBar {
                min-width: 300px;
                max-width: 550px;
                overflow: hidden;
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
                <h4> Ingredients List </h4>

                <input type="button" class="btn btn-light" value="Add New Ingredient" onclick="redirect('ingredientsAdd.php')">
            </div>
            
            <div class="table-responsive">
                <!-- Ingredients Table -->
                <table class="table table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th> ID </th> 
                            <th> Ingredient Name </th>
                            <th> Qty. <span class="small-text">(Stock)</span> </th>
                            <th> Qty. <span class="small-text">(Measured)</span> </th>
                            <th> Calorie </th>
                            <th> Fat </th>
                            <th> Carb </th>
                            <th> Protein </th>
                            <th> Price </th>
                            <th> View </th>
                            <th> Action </th>
                        </tr>
                    </thead>

                    <!-- Main Body of the table -->
                    <tbody>
                        <?php
                            try{
                                $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $querystring = "SELECT * FROM ingredients";
                     
                                if(
                                    isset($_POST['text']) &&
                                    !empty($_POST['text'])
                                ){
                                    $str = $_POST['text'];

                                    $querystring = "SELECT * FROM ingredients WHERE name like '%$str%'";
                                }
                    
                                $returnobj = $conn->query($querystring);
                                $returntable = $returnobj->fetchAll();
                    
                                if($returnobj->rowCount()==0){                    
                                    ?>
                                        <tr>
                                            <td colspan="11"> No Values Found </td>
                                        </tr>
                                    <?php
                                }
                                else{
                                    foreach($returntable as $rows){
                                        ?>
                                            <tr>
                                                <td> <?php echo $rows['id'] ?> </td>
                                                <td> <?php echo $rows['name'] ?> </td>
                                                <td> <?php echo $rows['current_amount']." ".$rows['current_amount_unit'] ?> </td>
                                                <td> <?php echo $rows['measurement_amount']." ".$rows['measurement_unit'] ?> </td>
                                                <td> <?php echo $rows['calories'] ?> </td>
                                                <td> <?php echo $rows['fat'] ?> </td>
                                                <td> <?php echo $rows['carbs'] ?> </td>
                                                <td> <?php echo $rows['protein'] ?> </td>
                                                <td> <?php echo $rows['price'] ?> </td>
                                                <td class="action-tabledata">
                                                    <input type="button" class="btn btn-sm btn-primary btn-fit" data-toggle="modal" data-target="#myModal" data-id="<?php echo $rows['id']; ?>" data-name="<?php echo $rows['name']; ?>" value="Update Stock" onclick="">
                                                    <a class="btn btn-sm btn-success btn-fit" href="ingredientDetailsEmployee.php?id=<?php echo $rows['id'] ?>"> View Details </a>
                                                </td>
                                                <td class="action-tabledata">
                                                    <input type="button" class="btn btn-sm btn-warning btn-fit" value="Update" onclick="ingredientUpdate(<?php echo $rows['id'] ?>)">
                                                    <input type="button" class="btn btn-sm btn-danger btn-fit" value="Delete" onclick="deletefn(<?php echo $rows['id'] ?>, 'recipes');">
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="11"> No Data Found </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        

        <!-- Modal For Updating Preference -->
            
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Stock Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="ingredient-id" id="ingredient-id">
                    
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for="amount" class="col-form-label">New stock amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" autocomplete="off" placeholder="Enter new stock amount">
                        </div>

                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for="unit" class="col-form-label">New stock unit</label>
                            <input type="text" class="form-control" id="unit" name="unit" autocomplete="off" placeholder="Enter new stock unit">
                        </div>

                        <div class="form-group" id="status-div">
                            
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" id="update-stock" class="btn btn-primary">Update Stock</button>
                </div>
            </div>
        </div>
        </div>
        <!-- Modal End -->

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
            function ingredientUpdate(id){
                var result = confirm("Are you sure you want to update this ingredient? \nThis will affect all recipes that has this ingredient!");
                if(result){
                    redirect('ingredientUpdate.php?id='+id);
                }
            }
        </script>

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

        <script>
            $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');

                var modal = $(this);

                modal.find('.modal-body #ingredient-id').val(id);
                modal.find('.modal-title').text('Stock update - ' + name);
            });


            //AJAX Call for updating stock
            let button = document.getElementById('update-stock');
            button.addEventListener('click', function (){

                let unit = document.getElementById('unit').value;
                let amount = document.getElementById('amount').value;
                let ingId = document.getElementById('ingredient-id').value;
                console.log(amount+" "+unit+" "+ingId);

                if(amount === ""){
                    document.getElementById('status-div').innerHTML = `<div class="alert alert-danger">
                                                                            <strong> Error! </strong> Please enter amount!
                                                                       </div>`;
                    window.setTimeout(hideSuccessMessage, 5000);
                    return;
                }
                else if(unit === ""){
                    document.getElementById('status-div').innerHTML = `<div class="alert alert-danger">
                                                                            <strong> Error! </strong> Please enter unit!
                                                                       </div>`;
                    window.setTimeout(hideSuccessMessage, 5000);
                    return;
                }

                var ourRequest = new XMLHttpRequest();
                var response = "";

                ourRequest.onload = function (){
                    response = this.responseText;
                };

                ourRequest.open('POST', 'ingredientStockUpdate.php');
                ourRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                ourRequest.send("id="+ingId+"&amount="+amount+"&unit="+unit);

                document.getElementById('status-div').innerHTML = `<div class="alert alert-success">
                                                                        <strong> Success: </strong> Stock updated!
                                                                   </div>`;
                window.setTimeout(hideSuccessMessage, 3500);
                window.setTimeout(reloadPage, 3500);
                
            });

            function hideSuccessMessage(){
                document.getElementById('status-div').innerHTML = "";
            }
            function reloadPage(){
                location.reload();
            }
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