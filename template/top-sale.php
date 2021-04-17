<?php
require './config/connect.php';
?>

      <!-- Top Sale -->
      <section id="top-sale">
        <div class="container py-5">
          <h4 class="font-amiri font-size-20">Top Sale</h4>
          <hr>
          <div class="owl-carousel owl-theme">

            <?php

            $selectproduct="SELECT * FROM products ORDER BY rand()";
            $query = mysqli_query($con, $selectproduct);
            if (mysqli_num_rows($query) > 0) {
              while ($row = mysqli_fetch_array($query)) {
            ?>
            <div class="item py-2">
              <div class="product font-reemkufi">
                <a href="product.php?id=<?php echo $row['pro_id']?>"> <img src="./images/<?php echo $row['img'];?>" alt="product" class="img-fluid px-2"> </a>
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
            <?php
              }
            }
            ?>


          </div>
        </div>
      </section>

      <!-- End of Top Sale -->
<?php mysqli_close($con); ?>
