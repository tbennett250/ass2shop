<?php 

require_once './inc/functions.php';

//if a form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Get product ID from the form that has been selected
    $productidGET = $_POST['productid'];
    //create a session with that variable
    $_SESSION['productIDGET'] = $productidGET;
    //redirect to the page to process the product
    redirect("edit-product");
}


?>
<div style="padding:25px;">
<table class="table table-light ">
    <!-- Table Header -->
<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Image</th>
    <th> </th>
    <th> To Edit </th>
    
</tr>

<?php
//gets all products in SQl Database
$products =$controllers->products()->getAll();
//Loops through the produts
foreach ($products as $product):
?>
    <tr>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <!-- Prints product in row -->
        <td> <?= $product['id']; ?> </td>
        <td> <?= $product['name'];?> </td>
        <td> <?= $product['description']; ?> </td>
        <td> <?= $product['price']; ?> </td>
        <!-- Javascript to Hide/Show Image -->
        <td><img id=<?= $product['id']; ?> style="display: none;" width="150px" height="150px" src=<?= $product['image'] ?>></td>
        <!-- Hidden Variable to allow to store the ProductID to be edited. -->
        <input type="hidden" value="<?= $product['id'] ?>" name="productid"/>
        
        <td> <input type="submit" name="btn" value="Edit" id="<?= $product['id'] ?>" class="btn btn-secondary" >

        <!-- Close Form and Row -->
        </form>
    </tr> 

<?php endforeach ?>
</table>
</div>

<script>
    function ShowImage(id){
        //get the element of the image
        var x = document.getElementById(id);
        //if image isnt showing then show it
        if (x.style.display == "none"){
            x.style.display = "block";
        } else {
            //else: hide it.
            x.style.display = "none";
        }
            }
</script>