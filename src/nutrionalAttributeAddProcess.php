<?php

session_start();
if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    if( 
        isset($_POST['attrName']) &&
        !empty($_POST['attrName'])
    ){
        $attr = $_POST['attrName'];   
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $myquerystring="INSERT INTO ingredient_attributes (name) VALUES('$attr')";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>location.assign("nutrientInfo.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>
                    location.assign("nutrientInfo.php");
                    alert("Database error!");
                </script>
            <?php
        }
        
    }
    else{
        //if attribute name is not set
        ?>
            <script>
                location.assign("nutrientInfo.php");
                alert("Data not set properly!");
            </script>
        <?php
        
    }
}
else{
    ?>
        <script>location.assign("employeeLogin.php");</script>
    <?php 
}

?>