<?php

require __DIR__ . "/inc/header.php"; ?>
<div><h3 class="text-danger"><?= isset($_GET['msg']) ? $message = $_GET['msg'] : ''  ?><h3></div>
     
<section class="vh-100 text-center">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
         <?php require __DIR__ . "/components/products.php"; ?>
      </div>
    </div>
</section>  

<?php require __DIR__ . "/inc/footer.php"; ?>