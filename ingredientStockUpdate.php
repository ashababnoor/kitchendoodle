<?php

session_start();

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])

){
    if( 

        isset($_POST['id']) &&

        isset($_POST['amount']) &&
        !empty($_POST['amount']) &&

        isset($_POST['unit']) &&
        !empty($_POST['unit'])

    ){
        $ingredientId = $_POST['id'];
        $amount = $_POST['amount'];
        $unit = $_POST['unit'];

        $success = "done";
        $error = "error";
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $myquerystring="UPDATE ingredients SET current_amount = $amount,
                                                     current_amount_unit = '$unit'

                            WHERE id = $ingredientId;";
            
            $returnObj = $conn->exec($myquerystring);
            
            
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
        <script>location.assign("employeeLogin.php");</script>
    <?php 
}

?>