<?php

session_start();

if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail'])

){
    if( 
        isset($_POST['id']) &&

        isset($_POST['request']) &&
        !empty($_POST['request'])
    ){
        $userId = $_SESSION['myid'];
        $recipeId = $_POST['id'];
        $request = $_POST['request'];

        $success = "done";
        $error = "error";
        
        //store the data to database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            

            if($request == "add"){
                $myquerystring="INSERT INTO wishlists (customer_id, recipe_id) 
                                VALUES ($userId, '$recipeId'); ";
                
                $conn->exec($myquerystring);
            
                echo $success;
            }
            else if($request == "remove"){
                $myquerystring="DELETE FROM wishlists WHERE customer_id = $userId AND recipe_id = $recipeId; ";

                $conn->exec($myquerystring);
            
                echo $success;
            }
            else{
                echo $error;
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