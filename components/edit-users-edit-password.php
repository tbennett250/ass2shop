<?php
require_once './inc/functions.php';
$message = '';
//gets user to edit
$UserToEdit = $controllers->members()->get($_SESSION['userIDGET']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  //process password
  $password = InputProcessor::process_password(($_POST['password'] ?? ''),( $_POST['v-password'] ?? ''));


  
//if password is valid format, change.
    if($password['valid']){
         $args = [ 'password' => $password['value'],
                  'id' => $_SESSION['userIDGET']];
        $controllers->members()->update_password($args);
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
    
                <h3 class="mb-2">Edit password for <?= htmlspecialchars($UserToEdit['email']) ?></h3>
                <div class="form-outline mb-4">
                 
    
    
                <div class="form-outline mb-4">
                <label>New Password</label>
                  <input type="text" id="password" name="password" class="form-control form-control-lg"  required  />
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>

                <div class="form-outline mb-4">
                <label>Verify New Password</label>
                  <input type="text" id="v-password" name="v-password" class="form-control form-control-lg"  required />
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>


    
                <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Override Password</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>