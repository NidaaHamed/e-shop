<?php
require './config/connect.php';

?>

      <!-- product-brands -->
      <section id="product-brands">
        <div class="container">
          <h4 class="font-amiri font-size-20 ">Product Brands</h4>
          <div class="row">
            <div class="col-12 col-sm-3">
              <div id="filter" class="button-group text-end font-reemkufi font-size-16 pt-3">

                <?php
                $selectbrand="SELECT DISTINCT brand FROM products";
                $brandquery = mysqli_query($con, $selectbrand);
                if (mysqli_num_rows($brandquery) > 0) {

                ?>

                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <button class="btn is-checked" data-filter="*">All Brands</button>
                    <span class="badge bg-primary rounded-pill"><?php $sql = "SELECT * FROM products";
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    echo $count;
                       ?></span>
                  </li>
                  <?php
                  while ($row = mysqli_fetch_array($brandquery)) {
                    $brand=$row['0'];
                  ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <button class="btn" data-filter=".<?php echo $brand; ?>"><?php echo $brand; ?></button>
                    <span class="badge bg-primary rounded-pill"><?php $sql = "SELECT * FROM products WHERE brand='$brand'";
                        $result = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($result);
                        echo $count; ?></span>
                  </li>
                  <?php } ?>
                </ul>

<?php } ?>
              </div>
            </div>
            <?php
              $selectproduct="SELECT * FROM products ORDER BY rand()";
              $productquery = mysqli_query($con, $selectproduct);
              if (mysqli_num_rows($productquery) > 0) {

            ?>
            <div class="col-12 col-sm-9">
                <div class="grid">
                  <?php
                  while ($row = mysqli_fetch_array($productquery)) {

                  ?>
                  <div class="grid-item <?php echo $row['brand']; ?> border" style="  margin-right: 1.2rem;
                    margin-top: 1rem;">
                    <div class="item py-2" style="width:200px;">
                      <div class="product font-reemkufi">
                        <a href="product.php?id=<?php echo $row['pro_id']?>"> <img src="./images/<?php echo $row['img'];?>" alt="product" class="img-fluid px-2" style="height: 250px;"> </a>
                        <div class="text-center">
                          <h6><?php echo $row['name']; ?></h6>
                          <div class="rating text-warning font-size-12">
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="fas fa-star"></i> </span>
                            <span> <i class="far fa-star"></i> </span>
                          </div>
                          <div class="price py-2">
                            <span>$<?php echo $row['price']; ?></span>
                          </div>
                          <a href="cart.php?do=addtocart&pro_id=<?php echo $row['pro_id'];?>&userid=<?php echo $userid;?>" class="btn btn-warning font-size-12">Add to Cart</a>
                        </div>

                      </div>
                    </div>
                  </div>


                <?php } ?>
                </div>

            </div>
          <?php } ?>
          </div>

        </div>

      </section>
      <!-- end of Special price -->
