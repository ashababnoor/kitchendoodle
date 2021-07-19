<?php

session_start();
if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    if( 
        isset($_POST['id']) &&
        !empty($_POST['id']) &&

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

        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $unit = $_POST['unit'];
        $ytlink = $_POST['ytlink'];
        $default = 0;
        
        //update the data on database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $myquerystring="UPDATE recipes SET name = '$name',
                                               description = '$description',
                                               amount = $amount,
                                               unit = '$unit',
                                               yt_link = '$ytlink'
                            WHERE id=$id";
            
            $conn->exec($myquerystring);
            
            ?>
                <script>location.assign("recipeList.php");</script>
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
        <script>location.assign("employeeLogin.php");</script>
    <?php 
}

?>
