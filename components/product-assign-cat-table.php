<?php
  require_once './inc/functions.php';
  $products = $controllers->products()->getAll();



  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {

    if(isset($_POST['btn-SetCat'])){
      //get variables from form data
      $CatKey =  $_POST['SelectCat'];
      $ProdKey = $_POST['productid'];
      $CatProdID = $_POST['hdn-catprodID'];
//create arguemnet to update categories
      $args = ["ProductFK" => $ProdKey,
              "CategoryFK" => $CatKey,
              "CatProductID" => $CatProdID];
//if successful redirect to page to refresh it
      if ($controllers->category()->UpdateCat($args) === true){
        redirect("product-assign-category");
      }
    }
  }
?>



<div style="padding:25px;">
<table class="table table-light">
  <tr>
    <th scope="column">Product</th>
    <th scope="column">Description</th>
    <th scope="column">Category</th>
    <th scope="column">Set Category</th>
  </tr>

  <?php

foreach($products as $product):
?>
 
<tr>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >

      <td> 
          <?= $product['name'] ?> 
      </td>

      <td> 
        <?= $product['description'] ?>
        <input type="hidden" value="<?= $product['id'] ?>" name="productid">
      </td>

      <td>
        <select name="SelectCat" id="cat" style="width: 80%" >
                <?php 
                  $catprod = $controllers->category()->GetByProductFK($product['id']) ;
                  $SetCat = $controllers->category()->get($catprod['CategoryFK']);
                ?>

          <option value="<?= $SetCat['CategoryFK'] ?>"><i> SET AS : <?= $SetCat['title']?></i></option>

          <!--calls function which will automatically populate dropdown box -->
          <?= $controllers->category()->ListDropdown() ?>
          
        </select>

        <!-- Hidden item to allow for form processing -->
        <input type="hidden" value="<?= $catprod['CatProductID'] ?>" name="hdn-catprodID"> 
      </td>

      <td> 
        <button type="submit" class="btn btn-dark " name="btn-SetCat" style="display: block; margin: auto;" > Set Category </button> 
      </td>

    </form>
</tr>




<?php endforeach; ?>
 