<?php

session_start();
if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    if( 
        isset($_POST['name']) &&
        !empty($_POST['name']) &&

        isset($_POST['description']) &&
        !empty($_POST['description']) &&

        isset($_POST['amount']) &&
        !empty($_POST['amount']) &&
        
        isset($_POST['unit']) &&
        !empty($_POST['unit']) &&

        isset($_POST['ytlink']) &&
        !empty($_POST['ytlink']) 
    ){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $unit = $_POST['unit'];
        $ytlink = $_POST['ytlink'];
        $default = 0;
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $myquerystring="INSERT INTO recipes (name, description, amount, unit, yt_link, total_calorie, total_price, total_fat, total_carb, total_protein) 
                            VALUES('$name', '$description', $amount, '$unit', '$ytlink', $default, $default, $default, $default, $default)";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>location.assign("recipeList.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>
                    location.assign("recipeAdd.php");
                    alert("Database error!");
                </script>
            <?php
        }
        
    }
    else{
        //if ingredient data is not set or empty
        ?>
            <script>
                location.assign("recipeAdd.php");
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
