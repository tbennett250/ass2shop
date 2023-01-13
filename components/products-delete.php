<script>

  function ConfirmAlert(){
    alert("User Deleted");
  }


</script>

<?php
require_once './inc/functions.php';
$message = '';

$ProductToEdit = $controllers->products()->get(htmlspecialchars( $_SESSION['productIDGET'] ));

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['delete'])){
    $msg = "Product: " . $ProductToEdit['name'] . " Has Been Deleted." ;
    var_dump($_SESSION['productIDGET']);
    $controllers->category()->DeleteByProductID($_SESSION['productIDGET']);
    $controllers->products()->delete($_SESSION['productIDGET']);
    redirect('edit-product-table', ["msg" => $msg]);
  }

  if(isset($_POST['cancel'])){
    redirect('edit-products');
  }
}
?>



<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
<section class="vh-100">
<div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
    
                <h4 class="mb-2">Are you sure you want to delete the following Product?</h2>
                <div class="form-outline mb-4">
                 
    
    
                <div class="form-outline mb-4">
                <label><h3>Name: <?= htmlspecialchars($ProductToEdit['name']) ?></h3></label>
                
                </div>

                <div class="form-outline mb-4">
                <label><h3>Description: <?= htmlspecialchars($ProductToEdit['description'])  ?> </h3></label>
                </div>

                
                <div class="form-outline mb-1">
                <label><h3>Price:  £<?= htmlspecialchars($ProductToEdit['price'])  ?> </h3></label>
                </div>



    
                <button class="btn btn-success btn-lg w-100 mb-4 " id="delete" name="delete" type="submit">Delete Product</button>
                <button class="btn btn-danger btn-lg w-100 mb-4" id="cancel" name="cancel" type="submit">Cancel</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>