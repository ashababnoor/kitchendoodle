<?php

session_start();

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])

){
    if( 
        isset($_POST['id']) &&
        !empty($_POST['id']) &&

        isset($_POST['name']) &&
        !empty($_POST['name']) &&

        isset($_POST['calorie']) &&

        isset($_POST['carb']) &&
        
        isset($_POST['fat']) &&
        
        isset($_POST['protein']) &&
        
        isset($_POST['measure_amount']) &&
        !empty($_POST['measure_amount']) &&
        
        isset($_POST['measure_unit']) &&
        !empty($_POST['measure_unit']) &&

        isset($_POST['price'])
    ){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $calorie = $_POST['calorie'];
        $carb = $_POST['carb'];
        $fat = $_POST['fat'];
        $protein = $_POST['protein'];
        $ma = $_POST['measure_amount'];
        $mu = $_POST['measure_unit'];
        $price = $_POST['price'];
        
        //update the data on database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $recipeUpdateQuery="SELECT r.total_calorie as r_cal,
                                       r.total_carb as r_carb,
                                       r.total_fat as r_fat,
                                       r.total_protein as r_protein,
                                       r.total_price as r_price,
                                       r.id as r_id,

                                       ri.amount as ri_amount,
                                       
                                       i.calories as i_cal,
                                       i.carbs as i_carb,
                                       i.fat as i_fat,
                                       i.protein as i_protein,
                                       i.price as i_price,
                                       i.measurement_amount as i_ma
                                
                                FROM

                                recipes as r
                                JOIN
                                recipes_ingredients as ri
                                ON r.id = ri.recipe_id
                                JOIN
                                ingredients as i
                                ON i.id = ri.ingredient_id

                                WHERE ri.ingredient_id = $id";

            $recipeObj = $conn->query($recipeUpdateQuery);
            $recipeTable = $recipeObj->fetchAll();

            if($recipeObj->rowCount()==0){

            }
            else{
                foreach($recipeTable as $row){
                    $r_id = $row['r_id'];
                    $r_calorie = $row['r_cal'];
                    $r_carb = $row['r_carb'];
                    $r_fat = $row['r_fat'];
                    $r_protein = $row['r_protein'];
                    $r_price = $row['r_price'];

                    $ri_amount = $row['ri_amount'];
                    $i_amount = $row['i_ma'];

                    $i_calorie = $row['i_cal'];
                    $i_carb = $row['i_carb'];
                    $i_fat = $row['i_fat'];
                    $i_protein = $row['i_protein'];
                    $i_price = $row['i_price'];

                    $a = $ri_amount / $ma; //a -> new multiplier
                    $b = $ri_amount / $i_amount; //b -> old multiplier

                    $updated_recipe_calorie = $r_calorie + (($calorie * $a) - ($i_calorie * $b));
                    if($updated_recipe_calorie < 0.001){
                        $updated_recipe_calorie = 0;
                    }else{
                        $updated_recipe_calorie = round($updated_recipe_calorie, 2);
                    }

                    $updated_recipe_price = $r_price + (($price * $a * 1.1) - ($i_price * $b * 1.1));
                    if($updated_recipe_price < 0.001){
                        $updated_recipe_price = 0;
                    }else{
                        $updated_recipe_price = round($updated_recipe_price, 2);
                    }

                    $updated_recipe_carb = $r_carb + (($carb * $a) - ($i_carb * $b));
                    if($updated_recipe_carb < 0.001){
                        $updated_recipe_carb = 0;
                    }else{
                        $updated_recipe_carb = round($updated_recipe_carb, 2);
                    }

                    $updated_recipe_fat = $r_fat + (($fat * $a) - ($i_fat * $b));
                    if($updated_recipe_fat < 0.001){
                        $updated_recipe_fat = 0;
                    }else{
                        $updated_recipe_fat = round($updated_recipe_fat, 2);
                    }

                    $updated_recipe_protein = $r_protein + (($protein * $a) - ($i_protein * $b));
                    if($updated_recipe_protein < 0.001){
                       $updated_recipe_protein = 0;
                    }else{
                        $updated_recipe_protein = round($updated_recipe_protein, 2);
                    }
                    
                    $updateQuery="UPDATE recipes SET total_calorie = $updated_recipe_calorie,
                                                     total_price = $updated_recipe_price,
                                                     total_fat = $updated_recipe_fat,
                                                     total_carb = $updated_recipe_carb,
                                                     total_protein = $updated_recipe_protein
                                  WHERE id = $r_id;";

                    $conn->exec($updateQuery);
                }
            }
            
            $myquerystring="UPDATE ingredients SET name = '$name',
                                                   calories = $calorie,
                                                   carbs = $carb,
                                                   fat = $fat,
                                                   protein = $protein,
                                                   measurement_unit = '$mu',
                                                   measurement_amount = $ma,
                                                   price = $price
                            WHERE id=$id";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>location.assign("ingredientsList.php");</script>
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
                location.assign(url);
                alert("Data is not set properly!");
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