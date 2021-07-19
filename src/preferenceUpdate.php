<?php

session_start();

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])

){
    if( 

        isset($_POST['calorie']) &&
        !empty($_POST['calorie']) &&

        isset($_POST['fat']) &&
        !empty($_POST['fat']) &&

        isset($_POST['carb']) &&
        !empty($_POST['carb']) &&

        isset($_POST['protein']) &&
        !empty($_POST['protein'])
    ){
        $userId = $_SESSION['myid'];
        $calorie = $_POST['calorie'];
        $fat = $_POST['fat'];
        $carb = $_POST['carb'];
        $protein = $_POST['protein'];

        $success = "done";
        $error = "error";
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $myquerystring="SELECT * FROM preferences WHERE customer_id = $userId";
            
            $returnObj = $conn->query($myquerystring);
        
            if($returnObj->rowCount()==0){
                $prefString = "INSERT INTO preferences(customer_id, preferred_calorie, protein_amount, fat_amount, carb_amount)
                               VALUES($userId, $calorie, $protein, $fat, $carb)";
                
                $conn->exec($prefString);
            }
            else{
                $prefString = "UPDATE preferences SET preferred_calorie = $calorie,
                                                      protein_amount = $protein, 
                                                      fat_amount = $fat,
                                                      carb_amount = $carb

                               WHERE customer_id = $userId; ";
                
                $conn->exec($prefString);
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
    }
    else{
        //if data is not set or empty
        ?>
            <script>
                var url = "<?php echo $_SESSION['current_page'] ;?>";
                location.assign(url);
                alert("Data not set properly!");
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