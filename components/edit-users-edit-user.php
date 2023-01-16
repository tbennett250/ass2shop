<?php
require_once './inc/functions.php';
$message = '';
//get user to edit
$UserToEdit = $controllers->members()->get($_SESSION['userIDGET']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  //valdiate form data
    $firstname = InputProcessor::process_string($_POST['firstname'] ?? '');
    $lastname = InputProcessor::process_string($_POST['lastname'] ?? '');
    $email = InputProcessor::process_email($_POST['email'] ?? '');

    $valid = $firstname['valid'] && $lastname['valid'] && $email['valid'];
//if all valid
    if($valid){
         $args = [ 'firstname' => $firstname['value'],
                    'lastname' => $lastname['value'],
                    'password' => $UserToEdit['password'],
                    'email' => $email['value'],
                    'id' => $UserToEdit['id']];

//update to DB and rediredt
       $process =  $controllers->members()->update($args);
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
    
                <h3 class="mb-2">Edit User</h3>
                <div class="form-outline mb-4">
                    <label>Firstname</label>
                  <input type="text" id="firstname" name="firstname" class="form-control form-control-lg" value="<?= $UserToEdit['firstname'] ?>" required value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $firstname['error'] ?? '' ?></span>
                </div>
                
                <div class="form-outline mb-4">
                <label>Last Name</label>
                  <input type="text" id="lastname" name="lastname" class="form-control form-control-lg" value="<?= $UserToEdit['lastname'] ?>" required value="<?= htmlspecialchars($description['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $lastname['error'] ?? '' ?></span>
                </div>
    
    
                <div class="form-outline mb-4">
                <label>Email</label>
                  <input type="text" id="email" name="email" class="form-control form-control-lg" value="<?= $UserToEdit['email'] ?>" required value="<?= htmlspecialchars($price['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>

    
                <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Edit Details</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>