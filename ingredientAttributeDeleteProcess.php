<?php

session_start();

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])

){
    if( 
        isset($_GET['attrId']) &&
        isset($_GET['ingredientId'])
    ){

        $attrId = $_GET['attrId'];
        $ingredientId = $_GET['ingredientId'];

        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $myquerystring="DELETE FROM ingredient_attributes_info WHERE ingredient_id = $ingredientId AND attribute_id = $attrId; ";
            
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