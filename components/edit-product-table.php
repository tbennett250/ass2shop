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
    <th>Category</th>
    <th>Image</th>
    <th> </th>
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
        <td> <?= $controllers->category()->GetCatTitleFromProductID($product['id']) ?> </td>
        <td> <button type="button" class="btn btn-secondary" onclick="ShowImage(<?= $product['id']; ?>)"> view image </button>
      
    </td>
        <td><img id=<?= $product['id']; ?> style="display: none;" width="150px" height="150px" src=<?= $product['image'] ?>></td>
        <input type="hidden" value="<?= $product['id'] ?>" name="productid"/>
        
        <td> <input type="submit" name="btn" value="Edit" id="<?= $product['id'] ?>" class="btn btn-secondary" >
        <a href="" class="btn btn-danger"> Delete </a> </td>
        </form>
    </tr>


<?php endforeach ?>
</table>
</div>

<script>
    function ShowImage(id){
        var x = document.getElementById(id);

        if (x.style.display == "none"){
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
            }
</script>
