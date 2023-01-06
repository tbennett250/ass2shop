<?php require_once './inc/functions.php'; 
 // look at how to call php functions
 

    //$controllers->members()->ChangeRole($id);
 

    if(isset($_POST['btn-changeroll'])){
        $test = $controllers->members()->ChangeRole($_POST['userid']);
        var_dump($test);
    }

    if(isset($_POST['btn-edit-user-details'])){
        $_SESSION['userIDGET'] = $_POST['userid'];
        redirect('manage-users-edit-details');
    }



?>

<div style="padding:25px;">
<table class="table table-light ">
<tr>
    <th>id</th>
    <th>Email</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Account Created On</th>
    <th>Last Modified On</th>
    <th> UserRole </th>
    <th> Commands </th>
    
</tr>


<?php

$users = $controllers->members()->getAll();

foreach ($users as $user):
?>
    <tr>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <td> <?= $user['id']; ?> </td>
        <input type="hidden" value="<?php $user['id'] ?> name="userid">
        <td> <?= $user['email']; ?></td>
        <td> <?= $user['firstname'];?> </td>
        <td> <?= $user['lastname']; ?> </td>
        <td> <?= $user['createdOn']; ?> </td>
        <td> <?= $user['modifiedOn']; ?> </td>
        <td> <?= $controllers->members()->DisplayUserType($user['userRole']); ?> </td>
        
        
        <input type="hidden" value="<?= $user['id'] ?>" name="userid"/>
        
        <td> 
            <button type="submit" class="btn btn-dark btn-edit" name="btn-edit-user-details"value="Edit User Details" id="<?= $user['id'] ?>" class="btn btn-secondary btn-edit" >Edit user details</button>
            <button type="submit" class="btn btn-dark btn-edit" name="btn" value="Change Password">Change Password</button>
            <button type="submit" class="btn btn-dark btn-edit" name="btn-changeroll" value="Change Permissions" onclick=""> Change User Type </button>
            <button type="submit" class="btn btn-dark btn-edit btn-delete-user" name="btn-delete-user" value="delete user" onclick=""> Delete User </button>
        </form>
    </tr>


<?php endforeach ?>


?>
</table>
</div>