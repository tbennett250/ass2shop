<?php

require_once './inc/functions.php';

//If form has been selceted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Getting categoryID which has been selected from form, creating that as a session variable so it is accessible across the page.
    $_SESSION['categoryToBrowse'] = htmlspecialchars($_POST['categoryid']);
    redirect("browse-product-by-category");
}


//get all categories listed in category
$categorys = $controllers->category()->getAll();
//sets counter to null = not active
$counter = null;
//Loops through categories
foreach ($categorys as $category):
    //if counter doesnt = null, and there is 3 cards already in column, it will create a new row using bootstraps grid system
    if($counter != null){
        if($counter % 3 == 0){
            echo "<div class='w-100 mt-5'></div>";
        }
    } else {
        //if counter isnt set, initiate it.
        $counter = 0;
    }

?>


    <div class="col-md">
        <div class="card" style="height:600px">
        <!-- Creates card with details of the category selceted in the iteration of the for loop   -->
        <img src ="<?= $category['image'] ?>"
                class="card-img-top"
                alt="<?= $category['title'] ?>"
                style="
                    margin: auto;
                    padding: 7px;
                    max-height:400px;
                    max-width: 400px " >

                <div class="card-body">
                    <h5 class="card-title"><?= $category['title'] ?></h5>
                    <p class="card-text"><?= $category['description'] ?></p>
                    <form method="POST">
                        <input type="hidden" value="<?= $category['ID']?>" name="categoryid"/>
                        <input type="submit" class="btn btn-primary" id="<?= $category['id'] ?>" value="View Products">
                    </form>
                
                </div>
        </div>
</div>
<?php
//after card has been createad - add 1 to the counter for card been made
$counter +=1;
endforeach;

//loop populates last row with needed columns so card doesn't stretch.
while($counter %3 != 0){
    echo "<div class='col'></div>";
    $counter += 1;
}



?>
