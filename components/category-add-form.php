<?php



$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  $title = InputProcessor::process_string($_POST['name'] ?? '');
  $description = InputProcessor::process_string($_POST['description'] ?? '');
  $image = InputProcessor::process_file($_FILES['image']);

  $valid = $title['valid'] && $description['valid'] && $image['valid'];

  if($valid) {


    $image['value'] = ImageProcessor::upload($_FILES['image']);

    $args =  ['title' => $title['value'],
            'description' => $description['value'],
            'image' => $image['value']];

          var_dump($args);

    $result = $controllers->category()->addNewCat($args);
   // redirect('category-manager');
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
    
                <h3 class="mb-2">Add Product</h3>
                <div class="form-outline mb-4">
                  <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Category Name" required  />
                  <span class="text-danger"><?= $name['error'] ?? '' ?></span>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="description" name="description" class="form-control form-control-lg" placeholder="Category Description" required />
                  <span class="text-danger"><?= $description['error'] ?? '' ?></span>
                </div>
    
                <div class="form-outline mb-4">
                  <input type="file" accept="image/*" id="image" name="image" class="form-control form-control-lg" placeholder="Change Image" />
                </div>
    
                <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Category</button>
               
                <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
                <?= $message ? alert($message, 'danger') : '' ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>