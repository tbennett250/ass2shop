<?php
  require_once './inc/functions.php';
  $products = $controllers->products()->getAll();



  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {

    if(isset($_POST['btn-SetCat'])){
      //get variables selected row after user clicks button
      $CatKey =  $_POST['SelectCat'];
      $ProdKey = $_POST['productid'];
      $CatProdID = $_POST['hdn-catprodID'];
//create arguemnet to update categories
      $args = ["ProductFK" => $ProdKey,
              "CategoryFK" => $CatKey,
              "CatProductID" => $CatProdID];
//if successful redirect to page to refresh it
      if ($controllers->category()->UpdateCat($args) === true){
        //this essentially refreshes the updates on the page.
        redirect("product-assign-category");
      }
    }
  }
?>


<div style="padding:25px;">
<table class="table table-light">
  <!-- Sets Table headers -->
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
  <!-- for each row it creates a new form in order collect and proces information with the row -->
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >
  <!-- Lists Details about the product -->
      <td> 
          <?= $product['name'] ?> 
      </td>

      <td> 
        <?= $product['description'] ?>
        <!-- Hidden allows for the productid to be stored within the form -->
        <input type="hidden" value="<?= $product['id'] ?>" name="productid">
      </td>

      <td>
        <!-- This is the select for the category,
        it first prints what it is currently set as then using the controller it prints the category dropdown box
      -->
        <select name="SelectCat" id="cat" style="width: 80%" >
                <?php 
                  //Gets catprod id = CategoryFK & ProductFK
                  $catprod = $controllers->category()->GetByProductFK($product['id']) ;
                  //gets category = ID, title, Description, image
                  $SetCat = $controllers->category()->get($catprod['CategoryFK']);
                ?>
      <!-- Shows what it is currenly set as -->
            <option value="<?= $SetCat['ID'] ?>"><i> 
              SET AS : <?= $SetCat['title']?>
            </i></option>

          <!--calls function which will automatically populate dropdown box -->
          <?= $controllers->category()->ListDropdown() ?>
        </select>

        <!-- Hidden item to allow for form processing -->
        <input type="hidden" value="<?= $catprod['CatProductID'] ?>" name="hdn-catprodID"> 
      </td>

      <td> 
        <!--Update: changed from set category -> Update Category -->
        <button type="submit" class="btn btn-dark " name="btn-SetCat" style="display: block; margin: auto;" > Update Category </button> 
      </td>

    </form>
</tr>




<?php endforeach; ?>
 