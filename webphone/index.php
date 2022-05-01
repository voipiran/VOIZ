<?php
/**start issabel session */
session_name("issabelSession");
session_start();

/**check user logged in or not */
if($_SESSION['issabel_user']){
    /** user logged in */
    require 'phone.php';
}else{
    /**user not logged in */
    require 'errors/403.php';
}