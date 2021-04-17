<?php

/*
===============================================
== Manage Products Page
==You Can Add | Edit | Delete Products From Here
===============================================
*/
 session_start();

 if (isset($_SESSION['username'])) {
   $pageTitle='Products';
   include 'template/header.php';
   include 'template/navbar.php';
   include '../config/connect.php';

   $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   //Start Manage Page
    if ($do == 'Manage') { // Manage Page
      $sql = "SELECT * FROM products";
      $query = mysqli_query($con,$sql);
      if (mysqli_num_rows($query)>0) {
          ?>
          <h1 class="text-center">Manage Products</h1>
          <div class="container">
            <table class="table">
             <thead class="table-dark">
               <tr>
                  <th scope="col">#ID</th>
                  <th scope="col">ProductName</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Brand</th>
                  <th scope="col">Category</th>
                  <th scope="col">Colors</th>
                  <th scope="col">Image</th>
                  <th scope="col">Description</th>
                  <th scope="col">Register Date</th>
                  <th scope="col">Control</th>
               </tr>
             </thead>
             <tbody>
  <?php   while ($row=mysqli_fetch_array($query)) { ?>
               <tr>
                  <th scope="row"><?php echo $row['pro_id']; ?></th>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo $row['brand']; ?></td>
                  <td><?php echo $row['category']; ?></td>
                  <td><?php echo $row['colors']; ?></td>
                  <td><?php echo $row['img']; ?></td>
                  <td><?php echo $row['pro_desc']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>

                  <td>
                    <a href="products.php?do=Edit&id=<?php echo $row['pro_id'];?>" ><i class="far fa-edit"></i></a>
                    <a href="products.php?do=Delete&id=<?php echo $row['pro_id'];?>" class="confirm"><i class="far fa-window-close"></i></a>
                  </td>
               </tr>
    <?php }?>
             </tbody>
           </table>

           <a href='products.php?do=Add' class="btn btn-primary"><i class="fas fa-plus"></i> Add New Product</a>

          </div>
<?php
      }
    }elseif ($do == 'Add'){ //Add Members Page?>
     <h1 class="text-center">Add New Product</h1>
     <div class="container">
       <form method="post" action="?do=Insert">
         <div class="mb-3">
           <label class="form-label">Productname</label>
           <span class="asterisk">*</span>
           <input type="text" name="name" class="form-control"autocomplete="off" required>
         </div>
         <div class="mb-3">
           <label class="form-label">Price</label>
           <span class="asterisk">*</span>
           <input type="text" name="price" class="form-control" required>
         </div>
          <div class="mb-3">
            <label class="form-label">Quantity</label>
            <span class="asterisk">*</span>
            <input type="text" name="quantity" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Brand</label>
            <span class="asterisk">*</span>
            <input type="text" name="brand" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <span class="asterisk">*</span>
            <input type="text" name="category" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Colors</label>
            <span class="asterisk">*</span>
            <input type="color" name="color" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Image</label>
            <span class="asterisk">*</span>
            <input type="file" name="img" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <span class="asterisk">*</span>
            <textarea name="description" rows="8" cols="80"></textarea>
          </div>
          <button type="submit" name="add" class="btn btn-primary">Add Product</button>
        </form>
     </div>


    <?php
    }elseif ($do == 'Insert') { // Insert Page
      echo "<h1 class='text-center'>Insert Member</h1>";
      echo "<div class='container'>";
        if (isset($_POST['add'])) {
          //Get Variables From The Form
          $name         = $_POST['name'];
          $price        = $_POST['price'];
          $quantity     = $_POST['quantity'];
          $brand        = $_POST['brand'];
          $category     = $_POST['category'];
          $color        = $_POST['color'];
          $description  = $_POST['description'];
          $img          = $_FILES['img'];
          $imgname      = $img["name"];
          $imgtmpname   = $img["tmp_name"];


          $formErrors = array();

          if (empty($name)) {
            $formErrors[] = '<div class="alert alert-danger">Product Name Can\'t be Empty</div>';
          }
          if (empty($price)) {
            $formErrors[] = '<div class="alert alert-danger">Price Can\'t be Empty</div>';
          }
          if (empty($brand)) {
            $formErrors[] = '<div class="alert alert-danger">Brand Can\'t be Empty</div>';
          }
          if (empty($img)) {
            $formErrors[] = '<div class="alert alert-danger">Image Can\'t be Empty</div>';
          }

          foreach ($formErrors as $error) {
            echo $error . '<br>';
          }

          //Check If Theres No Error Proceed the Insert operation
          if (empty($formErrors)) {
            //Check If Product Already exists
            $sql = "SELECT * FROM products WHERE name='$name' LIMIT 1";
            $query = mysqli_query($con,$sql);
            if (mysqli_num_rows($query)>0) {
              echo "<div class='alert alert-danger'>Product Already Exists</div>";

            }else{
              //Insert into The Database This Info
              $sql= "INSERT INTO products(name,price,quantity,brand,category,colors,img,pro_desc) VALUES('$name','$price','$quantity','$brand','$category','$color','$imgname','$description')";
              //Echo Success Message
              if (mysqli_query($con, $sql)) {
                  $move = move_uploaded_file($pictmpname,"images/$picname");
                  if ($move) {
                    header("location:products.php");
                  }
              } else {
                  echo "<div class='alert alert-danger'>Error Inserting record: " . mysqli_error($con) . "</div>";
              }
            }

          }

        }else{
          echo "Sorry You Can't Browse This Page Directly ";
        }
        echo "</div>";
    }elseif ($do == 'Edit') { // Edit Page
     // Check If Get Request userid Is numeric & Get the Integer Value Of It
     $proid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0 ;
     // Select All Data Depend On this Id
     $sql = "SELECT * FROM products WHERE pro_id='$proid'";
     $query = mysqli_query($con,$sql);
     //If there is such Id show the Form
     if (mysqli_num_rows($query)>0) {
       $row = mysqli_fetch_array($query);
       ?>
       <h1 class="text-center">Edit Product</h1>
       <div class="container">
         <form method="post" action="?do=Update">
           <input type="hidden" name="proid" value="<?php echo $proid; ?>">
           <div class="mb-3">
             <label class="form-label">Productname</label>
             <span class="asterisk">*</span>
             <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" autocomplete="off" required>
           </div>
           <div class="mb-3">
             <label class="form-label">Price</label>
             <input type="text" name="price" class="form-control" value="<?php echo $row['price']; ?>" autocomplete="off" required>
           </div>
            <div class="mb-3">
              <label class="form-label">Quantity</label>
              <span class="asterisk">*</span>
              <input type="text" name="quantity" class="form-control" value="<?php echo $row['quantity']; ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Brand</label>
              <span class="asterisk">*</span>
              <input type="text" name="brand" value="<?php echo $row['brand']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Category</label>
              <span class="asterisk">*</span>
              <input type="text" name="category" value="<?php echo $row['category']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Colors</label>
              <span class="asterisk">*</span>
              <input type="color" name="color" value="<?php echo $row['colors']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Image</label>
              <span class="asterisk">*</span>
              <input type="file" name="img" value="<?php echo $row['img']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <span class="asterisk">*</span>
              <textarea name="description" rows="8" cols="80"><?php echo $row['pro_desc']; ?></textarea>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          </form>
       </div>

<?php
      // If There's No Such Id Show Error Message
      }else {
        echo "There is no such id";
      }
    }elseif ($do == 'Update') {  // Update Page
      echo "<h1 class='text-center'>Edit Member</h1>";
      echo "<div class='container'>";
        if (isset($_POST['save'])) {
          //Get Variables From The Form
          $id    = $_POST['proid'];
          $name         = $_POST['name'];
          $price        = $_POST['price'];
          $quantity     = $_POST['quantity'];
          $brand        = $_POST['brand'];
          $category     = $_POST['category'];
          $color        = $_POST['color'];
          $description  = $_POST['description'];
          $img          = $_FILES['img'];
          $imgname      = $img["name"];
          $imgtmpname   = $img["tmp_name"];


          $formErrors = array();

          if (empty($name)) {
            $formErrors[] = '<div class="alert alert-danger">Product Name Can\'t be Empty</div>';
          }
          if (empty($price)) {
            $formErrors[] = '<div class="alert alert-danger">Price Can\'t be Empty</div>';
          }
          if (empty($brand)) {
            $formErrors[] = '<div class="alert alert-danger">Brand Can\'t be Empty</div>';
          }
          if (empty($img)) {
            $formErrors[] = '<div class="alert alert-danger">Image Can\'t be Empty</div>';
          }

          foreach ($formErrors as $error) {
            echo $error . '<br>';
          }


          //Check If Theres No Error Proceed the Update operation
          if (empty($formErrors)) {
            //Update The Database With This Info
            $sql   = "UPDATE products SET name='$name',price='$price',quantity='$quantity',brand='$brand',category='$category',color='$color',description='$description',img='$imgname' WHERE pro_id='$id'";
            $query = mysqli_query($con,$sql);
            //Echo Success Message
            if (mysqli_query($con, $sql)) {
              echo "<div class='alert alert-success'>Record updated successfully</div>";
            } else {
              echo "<div class='alert alert-danger'>Error updating record: " . mysqli_error($con) . "</div>";
            }
          }

        }else{
          echo "Sorry You Can't Browse This Page Directly ";
        }
        echo "</div>";
    }elseif ($do == 'Delete') {
      //Delete Product Page
      // Check If Get Request proid Is numeric & Get the Integer Value Of It
      $proid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0 ;
      // Select All Data Depend On this Id
      $sql = "SELECT * FROM products WHERE pro_id='$prorid' LIMIT 1";
      $query = mysqli_query($con,$sql);
      //If there is such Id Delete It From The Database
      if (mysqli_num_rows($query)>0) {

          $del="DELETE FROM products WHERE pro_id='$proid'";
          $query=mysqli_query($con,$del);
          header('Location: members.php');

      }else{
        echo "This Id is Not Exist";
      }

    }
   include 'template/footer.php';

 }else{
  header('Location: index.php');
  exit();
 }

?>
