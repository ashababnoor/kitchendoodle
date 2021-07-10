<?php

session_start();
if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    if( 
        isset($_POST['diseaseName']) &&
        !empty($_POST['diseaseName'])
    ){
        $disease = $_POST['diseaseName'];   
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $myquerystring="INSERT INTO diseases (name) VALUES('$disease')";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>location.assign("diseaseList.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>
                    location.assign("diseaseList.php");
                    alert("Database error!");
                </script>
            <?php
        }
        
    }
    else{
        //if disease name is not set
        ?>
            <script>
                location.assign("diseaseList.php");
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