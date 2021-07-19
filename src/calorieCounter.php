<?php

session_start();

$_SESSION['current_page'] = 'calorieCounter.php';

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){

    $myid =  $_SESSION['myid'];
    $fat_pref = 34;
    $carb_pref = 33;
    $protein_pref = 33;
    $calorie_pref = 2000;

    try{
        //PDO = PHP Data Object
        $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
        
        //setting 1 environment variable
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $myquerystring="SELECT * FROM preferences WHERE customer_id = $myid";
        
        $returnObj = $conn->query($myquerystring);
    
        if($returnObj->rowCount()==1){
            foreach($returnObj as $row){
                $fat_pref = $row['fat_amount'];
                $carb_pref = $row['carb_amount'];
                $protein_pref = $row['protein_amount'];
                $calorie_pref = $row['preferred_calorie'];
            }
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
        <link href="css/style-calorie-counter.css" rel="stylesheet">

        <!-- External JS File -->
        <script src="js/calorie.js"></script>

        <title> Calorie Counter | KitchenDoodle</title>

        <style>
            #hidden-calorie-section{
                display: block;
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


        <div class="container-fluid content main-container">
            
            <div class="row">
                <div class="col-md-6 col-12" style="flex-direction: column;">

                    <div class="d-flex align-items-center" style="margin-bottom: 1em;">
                        <h4 class="text-info"> Calorie Counter </h4>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="age">Age (in years)</label>
                            <input class="form-control" type="number" step="0.01" id="age" name="age" placeholder="Enter your age" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="height">Height (in centimeter)</label>
                            <input class="form-control" type="number" step="0.01" id="height" name="height" placeholder="Enter your height" autocomplete="off">
                        </div>
                        
                        <div class="form-group">
                            <label for="weight">Weight (in kilogram)</label>
                            <input class="form-control" type="number" step="0.01" id="weight" name="weight" placeholder="Enter your weight" autocomplete="off">
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_m" value="5" checked>
                                        <label class="form-check-label" for="gender_m">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_f" value="-161">
                                        <label class="form-check-label" for="gender_f">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0">Activity Level</legend>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="actlvl" id="actlvl1" value="1.2">
                                        <label class="form-check-label" for="actlvl1">
                                            Little or no exercise
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="actlvl" id="actlvl2" value="1.375">
                                        <label class="form-check-label" for="actlvl2">
                                            Exercise 1 to 3 times per week
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="actlvl" id="actlvl3" value="1.47" checked>
                                        <label class="form-check-label" for="actlvl3">
                                            Exercise 4 to 5 times per week
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="actlvl" id="actlvl4" value="1.55">
                                        <label class="form-check-label" for="actlvl4">
                                            Daily exercise or intense exercise 3 to 4 times per week
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="actlvl" id="actlvl5" value="1.72">
                                        <label class="form-check-label" for="actlvl5">
                                            Intense exercise 6 to 7 times per week
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="actlvl" id="actlvl6" value="1.9">
                                        <label class="form-check-label" for="actlvl6">
                                            Very intense daily exercise or physical job
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <div class="d-flex justify-content-between" style="margin-top: 2em;">
                            <button id="calculateButton" class="btn btn-info" onclick="calculateCalorie()"> Calculate &nbsp;<i class='fas fa-calculator'></i> </button>
                            <button id="" class="btn btn-warning" onclick="" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> Update Preference &nbsp;<i class='fas fa-pen-nib'></i> </button>
                        </div>
                    
                        <div id="info-div">
                            <!-- Error will show output here -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12" id="hidden-calorie-section">

                    <div class="calorie-table" style="margin: 0 auto">
                        <div class="rows table-head"> Result </div>
                        <div class="rows">
                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Maintain Weight
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            no change
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-0" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>100%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>
                            
                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Mild Weight Loss
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            0.25 kg/week
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-neg1" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>90%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Weight Loss
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            0.5 kg/week
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-neg2" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>80%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Extreme Weight Loss
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            1 kg/week
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-neg3" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>60%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="btn-div">
                            <input type="button" class="btn btn-warning" value="Show Weight Gain Info" id="gain-btn" onclick="showGainInfo()"> 
                        </div>

                        <div class="rows" id="weight-gain-div">
                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Mild Weight Gain
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            0.25 kg/week
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-pos1" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>110%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Weight Gain
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            0.5 kg/week
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-pos2" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>120%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="category-cell">
                                    <div>
                                        <span class="text">
                                            Extreme Weight Gain
                                        </span>
                                        <br>
                                        <span class="subtext">
                                            1 kg/week
                                        </span>
                                    </div>
                                    <div class="arrow"></div>
                                </div>
                                <div class="value-cell">
                                    <span class="val" id="val-pos3" data-toggle="modal" data-target="#myModal" data-cal-value="<?php echo $calorie_pref ?>"> -- <small>140%</small>  </span>
                                    <br>
                                    <span class="subtext">Calories/Day</span>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Modal For Updating Preference -->
            
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Calorie Preference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for="calorie" class="col-form-label">Calorie Amount</label>
                            <input type="number" step="1" class="form-control" id="calorie" name="calorie" autocomplete="off">
                        </div>
                        
                        <form oninput="fatbubble.value=parseInt(fatrange.value)+'%'" class="range-wrap">
                            <span class="form-header"> Fat &nbsp;</span><output name="fatbubble" class="bubble"><?php echo $fat_pref ?>&percnt;</output>
                            <input type="range" id="fatrange" value="<?php echo $fat_pref ?>" name="fatrange" class="range"><br>
                        </form>

                        <form oninput="proteinbubble.value=parseInt(proteinrange.value)+'%'" class="range-wrap">
                            <span class="form-header"> Protein &nbsp;</span><output name="proteinbubble" class="bubble"><?php echo $protein_pref ?>&percnt;</output>
                            <input type="range" id="proteinrange" value="<?php echo $protein_pref ?>" name="proteinrange" class="range"><br>
                        </form>

                        <form oninput="carbbubble.value=parseInt(carbrange.value)+'%'" class="range-wrap">
                            <span class="form-header"> Carb &nbsp;</span><output name="carbbubble" class="bubble"><?php echo $carb_pref ?>&percnt;</output>
                            <input type="range" id="carbrange" value="<?php echo $carb_pref ?>" name="carbrange" class="range"><br>
                        </form>

                        <div class="form-group" id="status-div">
                            
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" id="update-pref" class="btn btn-primary">Update Preference</button>
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


        <!-- JS Script for Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        
        <script>
            $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var calorie_val = button.data('calValue'); 

            var modal = $(this);
            
            modal.find('.modal-body #calorie').val(calorie_val);
            });


            //AJAX Call for updating preference
            let button = document.getElementById('update-pref');
            button.addEventListener('click', function (){

                let calorie = document.getElementById('calorie').value;
                let fat = parseInt(document.getElementById('fatrange').value);
                let protein = parseInt(document.getElementById('proteinrange').value);
                let carb = parseInt(document.getElementById('carbrange').value);

                let total = carb + fat + protein;
                //console.log(total);

                if(total > 100 || total < 100){
                    document.getElementById('status-div').innerHTML = `<div class="alert alert-danger">
                                                                        <strong> Oh no! </strong> Range values must sum up to 100!
                                                                   </div>`;
                    window.setTimeout(hideSuccessMessage, 5000);
                    return;
                }

                var ourRequest = new XMLHttpRequest();
                var response = "";

                ourRequest.onload = function (){
                    response = this.responseText;
                };

                ourRequest.open('POST', 'preferenceUpdate.php');
                ourRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                ourRequest.send("id=<?php echo $myid; ?>&calorie="+calorie+"&fat="+fat+"&protein="+protein+"&carb="+carb);

                document.getElementById('status-div').innerHTML = `<div class="alert alert-success">
                                                                        <strong> Success: </strong> Preference updated!
                                                                   </div>`;
                window.setTimeout(hideSuccessMessage, 5000);
                
            });

            function hideSuccessMessage(){
                document.getElementById('status-div').innerHTML = "";
            }
        </script>

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