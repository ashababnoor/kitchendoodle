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

            $querystring = "SELECT * FROM employees WHERE email='$email' and password='$pass'";

            $returnobj = $conn->query($querystring);

            if($returnobj->rowCount()==1){

                session_start();
                $_SESSION['emp_email'] = $email;
                $_SESSION['current_page'] = 'employeeHome.php';

                foreach($returnobj as $row){
                    $_SESSION['emp_id'] = $row['id'];
                    $_SESSION['emp_firstname'] = $row['first_name'];
                    $_SESSION['emp_lastname'] = $row['last_name'];;
                }
                
                //if everything is ok, we will be taken to employee homepage
                ?>
                    <script>location.assign("employeeHome.php");</script>
                <?php
            }
            else{

                //reroute to employee login page
                ?>
                    <script>location.assign("employeeLogin.php");</script>
                <?php
            }
        }
        catch(PDOException $ex){

            //reroute to employee login page
            ?>
                <script>location.assign("employeeLogin.php");</script>
            <?php
        }
    }
    else{ 
        //if email and password is empty or not set, we will reroute to the login page
        ?>
            <script>location.assign("employeeLogin.php");</script>
        <?php
    }
}
else{

    //reroute to employee login page if request method isn't post
    ?>
        <script>location.assign("employeeLogin.php");</script>
    <?php
}

?>