<?php

session_start();

if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email'])
){
    if(
        isset($_GET['str']) &&
        !empty($_GET['str']) &&

        isset($_GET['table']) &&
        !empty($_GET['table'])
    ){

        $str = $_GET['str'];
        $table = $_GET['table'];
        
        //retrieve the data from database
        try{
            //PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=kitchendoodle_db;","root","");
            
            //setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $querystring = "SELECT * FROM $table WHERE name like '%$str%'";
            
            $returnobj = $conn->query($querystring);
            $returntable = $returnobj->fetchAll();
            
            
            $JSONoutput = json_encode($returntable);
            echo $JSONoutput;
            
        }
        catch(PDOException $ex){
            ?>
                <script>
                    alert("There was a problem fetching the data.");
                    var url = "<?php echo $_SESSION['current_page'] ;?>";
                    location.assign(url);
                </script>
            <?php 
        } 
    }
    else{
        //if data is not set or empty do nothing.
        
    }
}
else{
    //not logged in
    ?>
        <script>location.assign("employeeLogin.php");</script>
    <?php 
}

?>