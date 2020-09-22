<?php
include_once("./database/constants.php");
session_start();

if(isset($_SESSION['userid'])){
    session_destroy();
}
header("Location:".DOMAIN."/index.php");
?>