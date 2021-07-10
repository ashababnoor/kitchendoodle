<?php

session_start();
if(
    isset($_SESSION['emp_email']) &&
    !empty($_SESSION['emp_email']) &&

    isset($_SESSION['emp_id']) &&
    !empty($_SESSION['emp_id']) &&

    isset($_SESSION['emp_firstname']) &&
    !empty($_SESSION['emp_firstname']) &&

    isset($_SESSION['emp_lastname']) &&
    !empty($_SESSION['emp_lastname'])
){
    unset($_SESSION['emp_id']);
    unset($_SESSION['emp_email']);
    unset($_SESSION['emp_firstname']);
    unset($_SESSION['emp_lastname']);

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