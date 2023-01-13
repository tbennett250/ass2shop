<?php

require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    var_dump($_POST['categoryid']);
    $_SESSION['categoryToBrowse'] = htmlspecialchars($_POST['categoryid']);
    redirect("browse-product-by-category");
}



$categorys = $controllers->category()->getAll();
$counter = null;
foreach ($categorys as $category):
    
    if($counter != null){
        if($counter % 3 == 0){
            echo "<div class='w-100 mt-5'></div>";
        }
    } else {
        $counter = 0;
    }

?>


    <div class="col-md">
        <div class="card" style="height:600px">
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
$counter +=1;
endforeach;

while($counter %3 != 0){
    echo "<div class='col'></div>";
    $counter += 1;
}



?>
