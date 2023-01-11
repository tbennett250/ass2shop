<?php 
require __DIR__ . "/inc/header.php"; 
require_once './inc/functions.php'; 

require_once __DIR__ . "/inc/admin-requirement.php";


if(!isset($_SESSION['userRole'])){
   redirect('index', ["msg" => "You need to log in"]);
   }
   if($_SESSION['userRole'] != '1') {
      redirect('index', ["msg" => "You need to be a administrator to access previous page"]);
   }
      


?>


   <?php require __DIR__ . "/components/add-product-form.php"; ?>

<?php require __DIR__ . "/inc/footer.php"; ?>