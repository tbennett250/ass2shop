<?php 

require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
//if btn-edit selected, set session variable as that products ID and redirect to edit the product
    if(isset($_POST['btn-edit']))
    {
        $productidGET = $_POST['productid'];
        $_SESSION['productIDGET'] = $productidGET;
        redirect("edit-product");
    }

    if(isset($_POST['btn-delete']))
    {
//if btn-delete is selected -> redirect to confirm that they want to delete it.
        $_SESSION['productIDGET'] = $_POST['productid'];
        redirect("edit-product-delete");

    }
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
//gets all products
$products =$controllers->products()->getAll();
//loops through produts
foreach ($products as $product):
?>
    <tr>
        <!--Creates form for products, within the table row -->
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <td> <?= $product['id']; ?> </td>
        <td> <?= $product['name'];?> </td>
        <td> <?= $product['description']; ?> </td>
        <td> <?= $product['price']; ?> </td>
        <td> <?= $controllers->category()->GetCatTitleFromProductID($product['id']) ?> </td>
        <td> <button type="button" class="btn btn-secondary" onclick="ShowImage(<?= $product['id']; ?>)"> view image </button>
      
    </td>
        <td><img id=<?= $product['id']; ?> style="display: none;" width="150px" height="150px" src=<?= $product['image'] ?>></td>
        <!-- Hidden inputs with the product ID -->
        <input type="hidden" value="<?= $product['id'] ?>" name="productid"/>
        
        <td> <input type="submit" name="btn-edit" value="Edit" id="<?= $product['id'] ?>" class="btn btn-secondary" >
        <input type="submit" name="btn-delete" class="btn btn-danger" value="Delete">
        </form>
    </tr>


<?php endforeach ?>
</table>
</div>

<script>
    function ShowImage(id){
        //Creates function that hides images in the table.
        var x = document.getElementById(id);

        if (x.style.display == "none"){
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
            }
</script>
