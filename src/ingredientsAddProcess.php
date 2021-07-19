<?php

session_start();

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])

){
    if( 
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
        
        isset($_POST['stock_amount']) &&
        !empty($_POST['stock_amount']) &&
        
        isset($_POST['stock_unit']) &&
        !empty($_POST['stock_unit']) &&

        isset($_POST['price'])
    ){

        $name = $_POST['name'];
        $calorie = $_POST['calorie'];
        $carb = $_POST['carb'];
        $fat = $_POST['fat'];
        $protein = $_POST['protein'];
        $ma = $_POST['measure_amount'];
        $mu = $_POST['measure_unit'];
        $sa = $_POST['stock_amount'];
        $su = $_POST['stock_unit'];
        $price = $_POST['price'];
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $myquerystring="INSERT INTO ingredients (name, calories, carbs, fat, protein, measurement_unit, measurement_amount, current_amount, current_amount_unit, price) 
                            VALUES('$name', $calorie, $carb, $fat, $protein, '$mu', $ma, $sa, '$su', $price)";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>location.assign("ingredientsList.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>
                    location.assign("ingredientsAdd.php");
                    alert("Database error!");
                </script>
            <?php
        }
        
    }
    else{
        //if ingredient data is not set or empty
        ?>
            <script>
                location.assign("ingredientsAdd.php");
                alert("Values not set properly or empty!");
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