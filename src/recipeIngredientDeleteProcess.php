<?php

session_start();

// echo $_POST['recipeId'];
// echo $_POST['ingredientId'];
// echo $_POST['amount'];
// echo $_POST['unit'];

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])

){
    if( 
        isset($_GET['recipeId']) && 
        //!empty($_GET['recipeId']) &&

        //!empty($_GET['ingredientId']) &&
        isset($_GET['ingredientId'])
    ){

        $recipeId = $_GET['recipeId'];
        $ingredientId = $_GET['ingredientId'];


        //variables for recipes
        $r_calorie = 0;
        $r_fat = 0;
        $r_protein = 0;
        $r_carb = 0;
        $r_price = 0;

        //variables for ingredients
        $i_calorie = 0;
        $i_fat = 0;
        $i_protein = 0;
        $i_carb = 0;
        $i_price = 0;

        $multiplier = 1;

        
        //delete the data from database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryForRecipe="SELECT * FROM recipes WHERE id=$recipeId";
            $recipeObj = $conn->query($queryForRecipe);
            if($recipeObj->rowCount()==1){
                foreach($recipeObj as $row){
                    $r_calorie = $row['total_calorie'];
                    $r_fat = $row['total_fat'];
                    $r_protein = $row['total_protein'];
                    $r_carb = $row['total_carb'];
                    $r_price = $row['total_price'];
                }
            }

            $queryForRelation="SELECT * FROM recipes_ingredients WHERE ingredient_id=$ingredientId AND recipe_id=$recipeId";
            $relationObj = $conn->query($queryForRelation);
            if($relationObj->rowCount()==1){
                foreach($relationObj as $row){

                    $multiplier = $multiplier * $row['amount']; 
                }
            }

            $queryForIngredient="SELECT * FROM ingredients WHERE id=$ingredientId";
            $ingredientObj = $conn->query($queryForIngredient);
            if($ingredientObj->rowCount()==1){
                foreach($ingredientObj as $row){
                    $i_calorie = $row['calories'];
                    $i_fat = $row['fat'];
                    $i_protein = $row['protein'];
                    $i_carb = $row['carbs'];
                    $i_price = $row['price'];

                    $multiplier = $multiplier / $row['measurement_amount']; 
                }
            }

            
            $r_calorie = $r_calorie - ($i_calorie * $multiplier);
            if($r_calorie < 0.001){
                $r_calorie = 0;
            }else{
                $r_calorie = round($r_calorie, 2);
            }

            $r_fat = $r_fat - ($i_fat * $multiplier);
            if($r_fat < 0.001){
                $r_fat = 0;
            }else{
                $r_fat = round($r_fat, 2);
            }

            $r_protein = $r_protein - ($i_protein * $multiplier);
            if($r_protein < 0.001){
                $r_protein = 0;
            }else{
                $r_protein = round($r_protein, 2);
            }

            $r_carb = $r_carb - ($i_carb * $multiplier);
            if($r_carb < 0.001){
                $r_carb = 0;
            }else{
                $r_carb = round($r_carb, 2);
            }

            $r_price = $r_price - (($i_price * $multiplier) * 1.1);
            if($r_price < 0.001){
                $r_price = 0;
            }else{
                $r_price = round($r_price, 2);
            }

            $myquerystring="DELETE FROM recipes_ingredients WHERE ingredient_id=$ingredientId AND recipe_id=$recipeId;
                            
                            UPDATE recipes SET total_calorie = $r_calorie,
                                               total_price = $r_price,
                                               total_fat = $r_fat,
                                               total_carb = $r_carb,
                                               total_protein = $r_protein
                            WHERE id = $recipeId;";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>
                    var url = "<?php echo $_SESSION['current_page'] ;?>";
                    location.assign(url);
                </script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>
                    var url = "<?php echo $_SESSION['current_page'] ;?>";
                    //location.assign(url);
                    alert("Database error!");
                </script>
            <?php
        }
    }
    else{
        //if ingredient data is not set or empty
        ?>
            <script>
                var url = "<?php echo $_SESSION['current_page'] ;?>";
                //location.assign(url);
                alert("Data not set properly!");
            </script>
        <?php   
    }
}
else{
    //not logged in
    ?>
        <script>location.assign("employeeLogin.php");</script>
    <?php 
}

?>
