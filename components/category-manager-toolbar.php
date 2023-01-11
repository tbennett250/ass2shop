<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['NewCat'])){
        redirect('category-add');
    }
}

?>


<div class="mt-2 mb-2 ">
    <form method="POST" >
        <button type="submit" name="NewCat" class="btn btn-light btn-lg "> Add New Category </button>
    </form>
</div>