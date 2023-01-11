<?php
require_once "./inc/functions.php";

$categories = $controllers->category()->getAll();


?>

<label for="cars">Choose a category</label>

<?php 
foreach($categories as $cat):
?>

<option value="<?= $cat['id'] ?>"> <?= $cat['title'] ?> </option>
<? endforeach ?>

</select>
