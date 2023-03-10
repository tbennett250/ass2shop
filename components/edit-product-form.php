<?php

require_once './inc/functions.php';

$message = '';

$SelectedProduct = $controllers->products()->get(htmlspecialchars($_SESSION['productIDGET']));

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
//Validates form data
    $name = InputProcessor::process_string($_POST['name'] ?? '');
    $description = InputProcessor::process_string($_POST['description'] ?? '');
    $price = InputProcessor::process_number($_POST['price'] ?? '');
    //if file is uploaded then the filesize would be greater than 0:
    if ($_FILES['image']['size'] > 0){
        //if image has been selected then validate
        $image = InputProcessor::process_file($_FILES['image'] ?? []);
    } else{
        //else use previous file path
        var_dump("Here");
        $image['value'] = $SelectedProduct['image'];
        $image['valid'] = true;
    }
    
// if all input processers are valid then
    $valid =  $name['valid'] && $description['valid'] && $price['valid'] && $image['valid'];
    
    if($valid) {
      //if image set in form
      if($_FILES['image']['size'] > 0)
      //upload image
        {$image['value'] = ImageProcessor::upload($_FILES['image']);}
      //set arguements
        $args = ['name' => $name['value'] , 
                'description' => $description['value'] , 
                'price' => $price['value'] ,
                'image' =>  $image['value'],
                'id' => $SelectedProduct['id']
                ];

      
//update from arguements
      $controllers->products()->update($args);
     redirect('edit-products');


            }

} 


?>

  <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
  
  <section class="vh-100">
      <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
    

              <!-- Form is populated with the data of the edited problem
            if a error occurs  it will print it underneath the both
          and then it will display the $name['value] instead -->
                <h3 class="mb-2">Add Product</h3>
                <div class="form-outline mb-4">
                  <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?= $SelectedProduct['name'] ?>" required value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $name['error'] ?? '' ?></span>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="description" name="description" class="form-control form-control-lg" value="<?= $SelectedProduct['description'] ?>" required value="<?= htmlspecialchars($description['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $description['error'] ?? '' ?></span>
                </div>
    
    
                <div class="form-outline mb-4">
                  <input type="number" id="price" name="price" class="form-control form-control-lg" value="<?= $SelectedProduct['price'] ?>" required value="<?= htmlspecialchars($price['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $price['error'] ?? '' ?></span>
                </div>

                <div class="form-outline mb-4">
                    <img style="width : 80%" src="<?= $SelectedProduct['image'] ?>">
                </div>
    
                <div class="form-outline mb-4">
                  <input type="file" accept="image/*" id="image" name="image" class="form-control form-control-lg" placeholder="Change Image" />
                </div>
    
                <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Product</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
