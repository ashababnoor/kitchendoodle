<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

    //checking if the fields are set and not empty
    if(   isset($_POST['myemail']) 
       && isset($_POST['mypass'])
       && !empty($_POST['myemail'])
       && !empty($_POST['mypass']) 
    ){
        $email=$_POST['myemail'];
        $pass=$_POST['mypass'];

        try{
            $conn = new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $encodedPass = md5($pass);

            $querystring = "SELECT * FROM customers WHERE email='$email' and password='$encodedPass'";

            $returnobj = $conn->query($querystring);

            if($returnobj->rowCount()==1){

                session_start();
                $_SESSION['myemail'] = $email;
                $_SESSION['current_page'] = 'home.php';

                foreach($returnobj as $row){
                    $_SESSION['myid'] = $row['id'];
                    $_SESSION['myfirstname'] = $row['first_name'];
                    $_SESSION['mylastname'] = $row['last_name'];
                }
                
                //if everything is ok, we will be taken to homepage
                ?>
                    <script>location.assign("home.php");</script>
                <?php
            }
            else{

                //reroute to login page
                ?>
                    <script>location.assign("login.php");</script>
                <?php
            }
        }
        catch(PDOException $ex){

            //reroute to login page
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }
    }
    else{ 
        //if email and password is empty or not set, we will reroute to the login page
        ?>
            <script>location.assign("login.php");</script>
        <?php
    }
}
else{

    //reroute to employee login page if request method isn't post
    ?>
        <script>location.assign("login.php");</script>
    <?php
}

?>