<?php
require './config/connect.php';
  session_start();
 if (isset($_SESSION['username'])) {
    $do = isset($_GET['do']) ? $_GET['do'] : 'display';

?>
<!-- Shopping Cart Section -->
  <section id="cart" class="py-3">
    <div class="container-fluid w-75">
      <h5 class="font-amiri font-size-20">Shopping Cart</h5>

      <!-- Shopping Cart items -->
        <div class="row">
          <div class="col-sm-9">
<?php
    if($do == 'display'){
        // Check If Get Request userid Is numeric & Get the Integer Value Of It
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
        //to count total price of cart items
        $total=0;

        //To get id of products from the cart
        $sql = "SELECT * FROM cart WHERE user_id='$userid'";
        $query = mysqli_query($con,$sql);
        if (mysqli_num_rows($query)>0) {
            while($row=mysqli_fetch_array($query)){
              //To get products from products table
              $proid=$row['pro_id'];
              $sql2 = "SELECT * FROM products WHERE pro_id='$proid'";
              $query2 = mysqli_query($con,$sql2);
              if (mysqli_num_rows($query2)>0) {
                while ($row2=mysqli_fetch_array($query2)) {
                     $total+=($row2['price']*$row2['quantity']); ?>
                  <!-- Cart Item -->
                    <div class="row border-top py-3 mt-3">
                      <div class="col-sm-2">
                        <img src="./images/<?php echo $row2['img']; ?>" alt="cart1" style="height:150px;" class="img-fluid">
                      </div>
                      <div class="col-sm-8">
                        <h5 class="font-amiri font-size-20"><?php echo $row2['name']; ?></h5>
                        <small>by <?php echo $row2['brand']; ?></small>
                        <div class="d-flex">
                          <div class="rating text-warning font-size-12">
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="far fa-star"></i> </span>
                          </div>
                          <a href="#" class="px-2 font-cairo font-size-14">20,534 ratings</a>
                        </div>

                        <!-- product quantity -->
                          <div class="qty d-flex pt-2">
                            <div class="d-flex font-cairo w-25">
                              <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                              <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled name="" value="<?php echo $row2['quantity']; ?>">
                              <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>
                            <button type="submit" name="button" class="btn font-amiri text-danger border-right px-3">Delete</button>
                            <button type="submit" name="button" class="btn font-amiri text-danger">Save for Later</button>
                          </div>
                        <!-- end of product quantity -->
                      </div>
                      <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-amiri">
                          $<span class="product-price"><?php echo $row2['price'];?></span>
                        </div>
                      </div>
                    </div>
                  <!-- end of Cart Item -->
<?php           }
              }
            }
          }
        }elseif ($do == 'addtocart') {
          // Check If Get Request userid Is numeric & Get the Integer Value Of It
          $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
          // Check If Get Request pro_id Is numeric & Get the Integer Value Of It
          $proid = isset($_GET['pro_id']) && is_numeric($_GET['pro_id']) ? intval($_GET['pro_id']) : 0 ;

          $sql = "SELECT * FROM cart WHERE user_id='$userid' AND pro_id='$proid' LIMIT 1";
          $query = mysqli_query($con,$sql);
          if (mysqli_num_rows($query)>0) {
            echo "<div class='alert alert-danger'>Product Already Exists</div>";

          }else{
            //Insert into The Database This Info
            $sql= "INSERT INTO cart(pro_id,user_id) VALUES('$proid','$userid')";
            //Echo Success Message
            if (mysqli_query($con, $sql)) {
              echo "<div class='alert alert-success'>Record Inserted successfully</div>";
            } else {
              echo "<div class='alert alert-danger'>Error Inserting record: " . mysqli_error($con) . "</div>";
            }
          }
        }
        }else{
          echo "<div class='alert alert-danger'>You are not permitted to access this page</div>";
        }?>
          </div>
          <div class="col-sm-3">
            <div class="sub-total border text-center mt-2">
              <h6 class="font-size-12 font-cairo text-success py-3"><i class="fas fa-check "></i>Your order is eligible for FREE Delivery</h6>
              <div class="border-top py-4">
                <h5 class="font-amiri font-size-20">Subtotal(2 items)&nbsp;<span class="text-danger">$ <span class="text-danger" id="deal-price"><?php echo $total; ?></span> </span></h5>
                <button type="submit" name="button" class="btn btn-warning mt-3">Proceed to Buy</button>
              </div>
            </div>
          </div>
        </div>
      <!-- end of Shopping Cart items -->
    </div>
  </section>
<!-- End of Shopping Cart Section -->
