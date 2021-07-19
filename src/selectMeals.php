<?php

session_start();

if(
    !isset($_GET['plan']) ||
    empty($_GET['plan'])
) {
    ?>
        <script>location.assign("plans.php");</script>
    <?php
}

$_SESSION['current_page'] = 'selectMeals.php?plan='.$_GET['plan'];

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){
    $plan = $_GET['plan'];
    $minMealSize = 1;

    if($plan == 'standard'){
        $minMealSize = 1;
    }
    else if($plan == 'bulk'){
        $minMealSize = 4;
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
        <link href="css/style-home.css" rel="stylesheet">
        <link href="css/style-recipe.css" rel="stylesheet">
        <link href="css/style-meals.css" rel="stylesheet">

        <!-- External JS File -->
        <script type="text/javascript" src="js/code.js"></script>
        <script type="text/javascript" src="js/searchRecipeForMealPlanner.js"></script>

        <title>Select Meals | KitchenDoodle</title>
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
                <div class="d-flex justify-content-between">
                    <h4 class="text-info"> Select Meals </h4>
                    <h4 class="text-info"> Total: <span id="total-price">0.00</span> Tk. </h4>
                    <input type="hidden" name="total-price-val" id="total-price-val" value="0">
                </div>
                <hr>
                <div>
                    <div class="meal-table">
                        <div class="rows">
                            <div class="columns">
                                <div class="cells cross-cell"><i class='far fa-calendar-alt' style="font-size: 1.7em;"></i></div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            SUN
                                        </span>
                                        <span class="subtext">
                                            04 Jul
                                        </span>
                                    </div>
                                </div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            MON
                                        </span>
                                        <span class="subtext">
                                           05 Jul
                                        </span>
                                    </div>
                                </div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            TUE
                                        </span>
                                        <span class="subtext">
                                            06 Jul
                                        </span>
                                    </div>
                                </div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            WED
                                        </span>
                                        <span class="subtext">
                                            07 Jul
                                        </span>
                                    </div>
                                </div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            THU
                                        </span>
                                        <span class="subtext">
                                            08 Jul
                                        </span>
                                    </div>
                                </div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            FRI
                                        </span>
                                        <span class="subtext">
                                            09 Jul
                                        </span>
                                    </div>
                                </div>
                                <div class="cells weekday">
                                    <div>
                                        <span class="text">
                                            SAT
                                        </span>
                                        <span class="subtext">
                                            10 Jul
                                        </span>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="columns">
                                <div class="cells time">Breakfast</div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="11"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="12"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="13"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="14"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="15"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="16"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="17"></div>
                            </div>
                        
                            <div class="columns">
                                <div class="cells time">Lunch</div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="21"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="22"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="23"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="24"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="25"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="26"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="27"></div>
                            </div>
                        
                            <div class="columns">
                                <div class="cells time">Snack</div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="31"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="32"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="33"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="34"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="35"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="36"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="37"></div>
                            </div>
                        
                            <div class="columns">
                                <div class="cells time">Dinner</div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="41"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="42"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="43"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="44"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="45"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="46"></div>
                                <div class="cells normal-cell" data-selected="0" data-toggle="modal" data-target="#myModal" id="47"></div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between" style="margin-top: 2em;">
                        <button id="savedraft" class="btn btn-info" onclick=""> Save as Draft &nbsp;<i class='fas fa-file-alt'></i> </button>
                        <button id="checkout" class="btn btn-success" onclick=""> Proceed to Checkout &nbsp;<i class='fas fa-dollar-sign'></i> </button>
                    </div>
                </div>
           </div>
        </div>


        <!-- Modal For Updating Preference -->
            
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Select Meal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <label for="search-box">Search Recipe</label>
                        <div id="dataSearchBar">
                            <div id="icon-div" class="icon-div d-flex justify-content-center align-items-center">
                                <i class="fas fa-search" id="search-icon"></i>
                                <input type="text" id="inputBox" name="dataSearchBar" placeholder="Search Recipes" maxlength="50" autocomplete="off" onkeyup="searchfunction('recipes')">
                            </div>

                            <div id="search-results" class="search-results">
                                <!-- AJAX Live Search Results will show here -->
                            </div>
                        </div>

                        <input type="hidden" name="recipeId" id="recipeId">
                        <input type="hidden" name="daytime" id="daytime">
                        <input type="hidden" name="recipe-price" id="recipe-price" value="0">

                        <div class="form-group">
                            <label for="serving">Serving Size</label>
                            <input class="form-control" type="number" step="1" min="<?php echo $minMealSize; ?>" value="<?php echo $minMealSize; ?>" id="serving" name="serving" placeholder="Enter serving size" autocomplete="off">
                        </div>

                        <div class="form-group" id="status-div">
                            
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="removemeal" class="btn btn-danger">Remove</button>
                    <button type="button" id="addmeal" class="btn btn-primary">Save</button>
                    <input type="hidden" id="hiddencloser" name="" data-dismiss="modal">
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
            var day_time = button.attr('id');

            var modal = $(this);
            
            modal.find('.modal-body #daytime').val(day_time);
            //console.log(day_time);
            });

            let selectedMeals = new Object();

            let add_button = document.getElementById('addmeal');
            add_button.addEventListener('click', function (){

                let recipe_name = document.getElementById('inputBox').value;
                let recipe_id = document.getElementById('recipeId').value;
                let day_time = document.getElementById('daytime').value;
                let serving = document.getElementById('serving').value;
                let selectedDiv = document.getElementById(day_time+'');

                let price = document.getElementById('recipe-price');
                let total_span = document.getElementById('total-price');
                let total = document.getElementById('total-price-val');

                let minServing = <?php echo $minMealSize ?> + "";
                //console.log(recipe_name + " " + recipe_id + " " + day_time + " " + serving);

                if(recipe_name == ""){
                    return;
                }
                else if(recipe_id == ""){
                    document.getElementById('status-div').innerHTML = `<div class="alert alert-danger">
                                                                        <strong> Oh no! </strong> We couldn't find this recipe! Select a recipe from  the search results.
                                                                   </div>`;
                    window.setTimeout(hideSuccessMessage, 5000);
                    return;
                }
                else if(serving < minServing){
                    document.getElementById('status-div').innerHTML = `<div class="alert alert-danger">
                                                                        <strong> Oh no! </strong> Minimum serzing size must be ` + minServing + `!
                                                                   </div>`;
                    window.setTimeout(hideSuccessMessage, 5000);
                    return;
                }

                selectedDiv.innerHTML = recipe_name + " (" + serving + ")";
                selectedDiv.setAttribute("data-selected", "1");

                console.log("Price when adding: " + price.value);

                let temp_price = parseFloat(price.value)*serving;
                total.value = parseFloat(total.value) + temp_price;

                total.value = (parseFloat(total.value)).toFixed(2);
                total_span.innerHTML = total.value + "";

                addMeal(day_time, recipe_name, recipe_id, serving);                

                selectedDiv.setAttribute("data-price", temp_price);

                document.getElementById('hiddencloser').click();

                // var ourRequest = new XMLHttpRequest();
                // var response = "";

                // ourRequest.onload = function (){
                //     response = this.responseText;
                // };

                // ourRequest.open('POST', 'preferenceUpdate.php');
                // ourRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                // ourRequest.send("id=<?php //echo $myid; ?>&calorie="+calorie+"&fat="+fat+"&protein="+protein+"&carb="+carb);

                // document.getElementById('status-div').innerHTML = `<div class="alert alert-success">
                //                                                         <strong> Success: </strong> Preference updated!
                //                                                    </div>`;
                // window.setTimeout(hideSuccessMessage, 5000);
                
            });

            let remove_button = document.getElementById('removemeal');
            remove_button.addEventListener('click', function (){
                let day_time = document.getElementById('daytime').value;
                let selectedDiv = document.getElementById(day_time+'');

                selectedDiv.innerHTML = "";
                selectedDiv.setAttribute("data-selected", "0");

                removeMeal(day_time);

                let price = document.getElementById('recipe-price');
                let total_span = document.getElementById('total-price');
                let total = document.getElementById('total-price-val');

                let temp_price = parseFloat(selectedDiv.getAttribute('data-price'));
                console.log(temp_price);

                if(temp_price != NaN && temp_price > 0){
                    total.value = parseFloat(total.value) - temp_price;
                    
                    total.value = (parseFloat(total.value)).toFixed(2);
                    total_span.innerHTML = total.value + "";
                }

                selectedDiv.setAttribute("data-price", "0");

                document.getElementById('hiddencloser').click();
            });

            function hideSuccessMessage(){
                document.getElementById('status-div').innerHTML = "";
            }

            function addMeal(day_time, recipe_name, recipe_id, serving){
                let meal = {
                    mealId : recipe_id,
                    mealName : recipe_name,
                    servingSize : serving,
                    time : Math.floor(day_time/10),
                    weekday : day_time % 10
                };

                console.log(meal);

                selectedMeals[day_time] = meal;
                console.log(selectedMeals);
            }

            function removeMeal(day_time){
                delete selectedMeals[day_time];
                console.log(selectedMeals);
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