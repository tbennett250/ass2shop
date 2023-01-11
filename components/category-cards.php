<?php

require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    var_dump($_POST['categoryid']);
    $_SESSION['categoryIDGET'] = htmlspecialchars($_POST['categoryid']);
    redirect("category-edit");
}



$categorys = $controllers->category()->getAll();
foreach ($categorys as $category):
?>


    <div class="col-4">
        <div class="card CardSizer">
            <img src ="<?= $category['image'] ?>"
                class="ProductImageCard card-img-top"
                alt="<?= $category['title'] ?>" >

                <div class="card-body">
                    <h5 class="card-title"><?= $category['title'] ?></h5>
                    <p class="card-text"><?= $category['description'] ?></p>
                    <form method="POST">
                        <input type="hidden" value="<?= $category['ID']?>" name="categoryid"/>
                        <input type="submit" class="btn btn-primary" id="<?= $category['id'] ?>" value="Edit">
                    </form>
                
                </div>
        </div>
</div>
       
  



<?php
endforeach



?>
