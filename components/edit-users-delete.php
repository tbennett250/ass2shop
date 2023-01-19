<?php
require_once './inc/functions.php';
$message = '';
//gets the user to delete from session variable
$UserToEdit = $controllers->members()->get($_SESSION['userIDGET']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // if user deletes:
  if(isset($_POST['delete'])){
    //set message to confirm delete
    $msg = "User: " . $UserToEdit['email'] . " Has Been Deleted." ;
    //delete user
    $controllers->members()->delete($_SESSION['userIDGET']);
    //redirect back to manage-users page with the MSG that confirms deleted.
    redirect('manage-users', ["msg" => $msg]);
  }
//if canceled redirect them to manage-users without any changes.
  if(isset($_POST['cancel'])){
    redirect('manage-users');
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
    
                <h2 class="mb-2">Are you sure you want to delete the following user?</h2>
                <div class="form-outline mb-4">
              <!-- Posts basic user information in bootstrap card -->
                <div class="form-outline mb-1">
                <label><h3>Firstname: <?= htmlspecialchars($UserToEdit['firstname']) ?></h3></label>
                </div>

                <div class="form-outline mb-1">
                <label><h3>Lastname: <?= htmlspecialchars($UserToEdit['lastname'])  ?> </h3></label>
                </div>

                <div class="form-outline mb-1">
                  <!-- Uses Email as unique identifier for the user -->
                <label><h3>Email Address:  <?= htmlspecialchars($UserToEdit['email'])  ?> </h3></label>
                </div>

                <button class="btn btn-success btn-lg w-100 mb-4 " id="delete" name="delete" type="submit">Delete User</button>
                <button class="btn btn-danger btn-lg w-100 mb-4" id="cancel" name="cancel" type="submit">Cancel</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>