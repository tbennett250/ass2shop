<?php
include_once __DIR__ . "/functions.php";


//If logged-in:
if(!isset($_SESSION['user'])){
   redirect('index', ["msg" => "You need to log in"]);
   }
   //if logged-in admin
   if($_SESSION['user']['userRole'] != 1) {
      redirect('index', ["msg" => "You need to be a administrator to access previous page"]);
   }

   ?>
      