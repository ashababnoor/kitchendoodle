<?php

session_start();
if(
    isset($_SESSION['myemail']) &&
    !empty($_SESSION['myemail']) &&

    isset($_SESSION['myid']) &&
    !empty($_SESSION['myid']) &&

    isset($_SESSION['myfirstname']) &&
    !empty($_SESSION['myfirstname']) &&

    isset($_SESSION['mylastname']) &&
    !empty($_SESSION['mylastname'])
){
    unset($_SESSION['myid']);
    unset($_SESSION['myemail']);
    unset($_SESSION['myfirstname']);
    unset($_SESSION['mylastname']);

    session_destroy();
    ?>
        <script>location.assign("index.html");</script>
    <?php
}
else{
    session_destroy();
    ?>
        <script>location.assign("index.html");</script>
    <?php
}

?>