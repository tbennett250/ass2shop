<?php

require_once "./inc/functions.php";

//get category id

$_SESSION['categoryToBrowse'];
//find Category
$category = $controllers->category()->get($_SESSION['categoryToBrowse']);

// find products with category id
$productList = $controllers->category()->GetCategorysByProductID($category['ID']);




//display products as cards



?>
<div style="text-align: center;">
    <img src="<?= $category['image'] ?>" style="max-height: 300px">
    <h1> <?= $category['title'] ?> </h1>
    <h3> <?= $category['description'] ?></h3>
</div>


<?php



foreach($productList as $product):
    $product = $controllers->products()->get($product['ProductFK']);
    ?>
    <link href="css/style.css" rel="stylesheet">
        <div class="col-4">
            <div class="card mt-4" style="height: 600px">
                <img class="ProductImageCard" style="align: center;" src="<?= $product['image'] ?>" 
                    class="card-img-top" 
                    alt="$product['name']">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p class="card-text"><?= $product['price'] ?></p>
                </div>
            </div>
        </div>
    <?php 
    endforeach;
    ?>
    
    

    