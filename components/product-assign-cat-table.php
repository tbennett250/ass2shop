<?php
require_once './inc/functions.php';
$products = $controllers->products()->getAll();



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $args = ["ProductFK" => $_POST['productid'],
            "CategoryFK" => $_POST['cat']];

    var_dump($args);

    $controllers->category()->UpdateCat($args);
}



?>



<div style="padding:25px;">
<table>
  <tr>
    <th>Product</th>
    <th>Description</th>
    <th>Category</th>
    <th>Set Category</th>
  </tr>

  <?php

foreach($products as $product):
?>
 
<tr>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
<td> <?= $product['name'] ?> </td>
<td> <?= $product['description'] ?>
<input type="hidden" value="<?= $product['id'] ?>" name="productid">
</td>

<td><select name="cat" id="cat">
    <?php $catprod = $controllers->category()->GetByProductFK($product['id']) ;
    $SetCat = $controllers->category()->get($catprod['CategoryFK']) ?>
    <option><i> SET AS : <?= $SetCat['title']?></i></option>
    <?= $controllers->category()->ListDropdown() ?>
</select>
<td> <button type="submit" class="btn"> Set Category </button>




</form>
</tr>




<?php endforeach; ?>
 