<?php 

require_once './inc/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  var_dump($_POST['SelectCat']);
  //input processor validates data in form
    $name = InputProcessor::process_string($_POST['name'] ?? '');
    $description = InputProcessor::process_string($_POST['description'] ?? '');
    $price = InputProcessor::process_number($_POST['price'] ?? '');
    //Changed from process_file to process_image
    $image = InputProcessor::process_image($_FILES['image'] ?? []);
    $category = InputProcessor::process_string($_POST['SelectCat']);
    
 //if all are valid, then $valid ='s true
    $valid =  $name['valid'] && $description['valid'] && $price['valid'] && $image['valid'] && $category['valid'];
  
    if($valid) {
//Uploads image and returns file path
      $image['value'] = ImageProcessor::upload($_FILES['image']);
      
    //sets arguement for prepared statements in SQL  
      $args = ['name' => $name['value'] , 
              'description' => $description['value'] , 
              'price' => $price['value'] ,
              'image' =>  $image['value'] 
              ];

      //Creates the product and returns the ID key
      $id = $controllers->products()->create($args);
      
      //If ProductID is not empty and is > 0 (IS A ID)
      if(!empty($id) && $id > 0) {

        //This assisngs the category to the product within the catproducts table
          $CatArgs = ["ProductFK" => $id,
                      "CategoryFK" => $category['value']];
          $controllers->category()->assignCat($CatArgs);
       //Redirects to a page whre the product will be generated
       redirect('product', ['id' => $id]);
      }
      else {
        $message = "Error adding product."; //Change
      }
    }
    else {
       $message =  "Please fix the following errors: ";
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
                  <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Name" required value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $name['error'] ?? '' ?></span>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="description" name="description" class="form-control form-control-lg" placeholder="Description" required value="<?= htmlspecialchars($description['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $description['error'] ?? '' ?></span>
                </div>
    
    
                <div class="form-outline mb-4">
                  <input type="number" id="price" name="price" class="form-control form-control-lg" placeholder="Price" required value="<?= htmlspecialchars($price['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $price['error'] ?? '' ?></span>
                </div>

                <div class="form-outline mb-4">
                    <select name="SelectCat" id="SelectCat" required>
                    

                    <option value="Assign Category" name="AssignCat"><i> Assign Category</i></option>
                    <!--calls function which will automatically populate dropdown box -->
                    <?= $controllers->category()->ListDropdown() ?>
                  </select>

                </div>
    
                <div class="form-outline mb-4">
                  <input type="file" accept="image/*" id="image" name="image" class="form-control form-control-lg" placeholder="Select Image"required />
                  <!--Added Span Class to present image -->
                  <span class="text-danger"> <?= $image['error'] ?? '' ?> </span>
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
