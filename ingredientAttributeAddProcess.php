<?php

session_start();

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])

){
    if( 
        isset($_POST['attrId']) &&
        
        isset($_POST['ingredientId']) &&

        isset($_POST['amount']) &&

        isset($_POST['unit']) &&
        !empty($_POST['unit'])
    ){

        $attrId = $_POST['attrId'];
        $ingredientId = $_POST['ingredientId'];
        $amount = $_POST['amount'];
        $unit = $_POST['unit'];

        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $myquerystring="INSERT INTO ingredient_attributes_info (attribute_id, ingredient_id, amount, unit) 
                            VALUES($attrId, $ingredientId, $amount, '$unit'); ";
            
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