<?php

session_start();
if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])
){
    if( 
        isset($_POST['mealdata']) &&
        !empty($_POST['mealdata']) 
    ){

        $meals = $_POST['mealdata'];
        
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //$myquerystring="INSERT INTO recipes (name, description, amount, unit, yt_link, total_calorie, total_price, total_fat, total_carb, total_protein) 
            //                VALUES('$name', '$description', $amount, '$unit', '$ytlink', $default, $default, $default, $default, $default)";
            
            //$conn->exec($myquerystring);
            
            echo $meals;

            ?>
                <!-- <script>location.assign("recipeList.php");</script> -->
            <?php
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
        <script>location.assign("login.php");</script>
    <?php 
}

?>
