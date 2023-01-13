<?php
require_once './inc/functions.php';


 $products =$controllers->products()->getAll();


 //clears counter
$counter = null;
foreach ($products as $product):
   
    //if counter is set:
    if($counter != null){
        //if counter/row is 3 set a new row
        if($counter % 3 == 0){
            echo " <div class='w-100 mt-5'></div>";
        }
    } else {
        //if counter is not started, initialise it
        $counter = 0;
    }
    
   
?>
<link href="css/style.css" rel="stylesheet">
    <div class="col-md">
        <div class="card" style="height: 600px;">
            <img  src="<?= $product['image'] ?>" 
                class="card-img-top "
                alt="$product['name']"
                style="
                    margin: auto;
                    padding-top: 5px;
                    max-height: 400px;
                    max-width: 400px;

                ">
            <div class="card-body ">
                <h5 class="card-title"><?= $product['name'] ?></h5>
                <p class="card-text"><?= $product['description'] ?></p>
                <p class="card-text"><?= $product['price'] ?></p>
            </div>
        </div>
    </div>
<?php 
//increase counter
  $counter += 1;
endforeach;

//if counter is not divisible by 3
while($counter % 3 != 0) {
    //print columns to make up 3 to a row
    echo "<div class='col'></div>";
    //increase counter as card has been added.
    $counter += 1;
}
?>
</div>

