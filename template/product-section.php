<?php
require './config/connect.php';

if (isset($_GET["id"])) {
  $pro_id=$_GET["id"];


  $selectproduct="SELECT * FROM products WHERE pro_id='$pro_id'";
  $query = mysqli_query($con, $selectproduct);
  if (mysqli_num_rows($query) > 0) {
?>
<!-- Product -->
<section id="product" class="py-3">
  <div class="container">
    <?php while ($row = mysqli_fetch_array($query)) { ?>
    <div class="row">
      <div class="col-sm-6">
        <img src="./images/<?php echo $row['img'];?>" alt="product" class="img-fluid" style="">
        <form class="" action="" method="post">
          <div class="row pt-4 font-size-16 font-cairo">
            <div class="col">
              <button type="submit" class="btn btn-danger form-control">Proceed to Buy</button>
            </div>
            <div class="col">
              <a href="cart.php?do=addtocart&pro_id=<?php echo $row['pro_id'];?>&userid=<?php echo $userid;?>" class="btn btn-warning form-control">Add to Cart</a>
            </div>
          </div>
        </form>
      </div>
      <div class="col-sm-6 py-5">
        <h5 class="font-amiri font-siz-20"><?php echo $row['name']; ?></h5>
        <small>by <?php echo $row['brand'];?></small>
        <div class="d-flex">
          <div class="rating text-warning font-size-12">
            <span> <i class="fas fa-star"></i> </span>
            <span> <i class="fas fa-star"></i> </span>
            <span> <i class="fas fa-star"></i> </span>
            <span> <i class="fas fa-star"></i> </span>
            <span> <i class="far fa-star"></i> </span>
          </div>
          <a href="#" class="px-2 font-cairo font-size-14">20,534 rating | 1000+ answered questions</a>
        </div>
        <hr class="m-0">

        <!-- product Price -->
          <table class="my-3">
            <tr class="font-cairo font-size-14">
              <td>M.R.P.</td>
              <td><strike>$<?php echo $row['price']+10; ?></strike></td>
            </tr>
            <tr class="font-cairo font-size-14">
              <td>Deal Price</td>
              <td class="font-size-20 text-danger">$<span><?php echo $row['price']; ?></span></td>
            </tr>
            <tr class="font-cairo font-size-14">
              <td>You Save</td>
              <td class="font-size-16 text-danger">$<span>10.00</span></td>
            </tr>
          </table>
        <!-- end of product Price -->
        <!-- Policy -->
          <div id="policy">
            <div class="d-flex">
              <div class="return text-center me-5">
                <div class="font-size-20 my-2 color-secondary">
                  <span class="fas fa-retweet border p-3 rounded-pill"></span>
                </div>
                <a href="#" class="font-cairo font-size-12">10 Days <br> Replacement</a>
              </div>
              <div class="return text-center me-5">
                <div class="font-size-20 my-2 color-secondary">
                  <span class="fas fa-truck border p-3 rounded-pill"></span>
                </div>
                <a href="#" class="font-cairo font-size-12">E-shop<br> Deliverd</a>
              </div>
              <div class="return text-center me-5">
                <div class="font-size-20 my-2 color-secondary">
                  <span class="fas fa-check-double border p-3 rounded-pill"></span>
                </div>
                <a href="#" class="font-cairo font-size-12">1 Year <br> Warranty</a>
              </div>
            </div>
          </div>
        <!-- end of Policy -->
        <hr>
        <!-- Order details -->
        <div id="order-details" class="font-cairo d-flex flex-column text-dark">
          <small>Delivery by : Mar 29 -Apr 1</small>
          <small>Sold by <a href="#">E-shop</a>(4.5 out of 5 | 18.198 ratings)</small>
          <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to customer - 424201</small>
        </div>
        <!-- end of Order details -->

        <div class="row">
          <div class="col-6">
            <div class="color my-3">
              <div class="d-flex justify-content-between">
                <h6 class="font-reemkufi">Color:</h6>
                <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                <div class="p-2 color-secondary-bg rounded-circle"><button class="btn font-size-14"></button></div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="qty my-3 d-flex justify-content-between">
              <h6 class="font-reemkufi">Qty:</h6>
              <div class="px-4 d-flex font-cairo">
                <button data-id="pro1" class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                <input data-id="pro1" type="text" class="qty_input border px-2 w-50 bg-light" name="" value="1">
                <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="size my-3">
          <h6 class="font-reemkufi">Size :</h6>
          <div class="d-flex justify-content-between w-75">
            <div class="font-cairo border p-2">
              <button class="btn p-0 font-size-14">1GB RAM</button>
            </div>
            <div class="font-cairo border p-2">
              <button class="btn p-0 font-size-14">2GB RAM</button>
            </div>
            <div class="font-cairo border p-2">
              <button class="btn p-0 font-size-14">3GB RAM</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <h6 class="font-amiri">Product Description</h6>
        <hr>
        <p class="font-cairo font-size-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="font-cairo font-size-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
    <?php }?>
  </div>
</section>
<?php
 }
}
?>
<!-- End of Product -->
