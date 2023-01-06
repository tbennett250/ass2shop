<?php 

require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $productidGET = $_POST['productid'];
    $_SESSION['productIDGET'] = $productidGET;
    redirect("edit-product");
}


?>
<div style="padding:25px;">
<table class="table table-light ">
<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Description</th>
    <th>Price</th>
    <th> To Edit </th>
    
</tr>


<?php

$products =$controllers->products()->getAll();

foreach ($products as $product):
?>
    <tr>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <td> <?= $product['id']; ?> </td>
        <td> <?= $product['name'];?> </td>
        <td> <?= $product['description']; ?> </td>
        <td> <?= $product['price']; ?> </td>
        <input type="hidden" value="<?= $product['id'] ?>" name="productid"/>
        <td> <input type="submit" name="btn" value="Edit" id="<?= $product['id'] ?>" class="btn btn-secondary" >
        </form>
    </tr>


<?php endforeach ?>
</table>
</div>
