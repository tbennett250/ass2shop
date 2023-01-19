<?php
include_once __DIR__ . "/inc/header.php";
include_once __DIR__ . "/inc/functions.php";
include_once __DIR__ . "/inc/admin-requirement.php";

include_once __DIR__ . "/components/category-manager-toolbar.php";
?>
<section class="vh-100 text-center">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
<?php
include_once __DIR__ . "/components/category-cards.php";
?>
</div>
</div>
</section>

<?php
include_once __DIR__ . "/inc/footer.php";
?>