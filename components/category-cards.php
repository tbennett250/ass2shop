<?php

require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    //sets Session variable to enable cat to be edit on next apge
    $_SESSION['categoryIDGET'] = htmlspecialchars($_POST['categoryid']);
    redirect("category-edit");
}


//Gets all categories from the database.
$categorys = $controllers->category()->getAll();

//sets counter as null as there is 0 cards set.
$counter = null;
foreach($categorys as $category):
//if counter is active and there is 3 cards, create new row
    if($counter != null){
        
        if($counter % 3 == 0){
            echo "<div class='w-100 mt-5'></div>";
        }
    } else {
        //if first iteration activate counter
        $counter = 0;
    }
?>

    <div class="col-md">
        <div class="card" style="height: 600px">
            <img src ="<?= $category['image'] ?>"
                class="card-img-top"
                alt="<?= $category['title'] ?>" 
                style="
                    margin: auto;
                    padding-top: 5px;
                    max-height: 400px;
                    max-width: 400px;
                    
                ">

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
//if card has been made add iteration to counter
$counter += 1;
endforeach;
while($counter % 3 != 0){
    echo "<div class='col'></div>";
    $counter += 1;
}


?>
