<?php include "./config/connect.php";
 session_start();
 $userid = isset($_GET['userid']) ? $_GET['userid'] : 0;
?>

<nav class="navbar navbar-expand-lg navbar-dark color-primary-bg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.html">E-Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?userid=<?php echo $userid;?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php" tabindex="-1">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?#product-brands" tabindex="-1">Brands</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1">AboutUs</a>
        </li>
      </ul>
      <form method="post" class="d-flex" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-default btn-flat text-white" type="submit"><i class="fas fa-search"></i></button>
      </form>


      <?php

                      if($userid){
                          $sql = "SELECT * FROM users WHERE user_id='$userid'";
                          $query = mysqli_query($con,$sql);
                          $row=mysqli_fetch_array($query);

                          $sql2 = "SELECT * FROM cart WHERE user_id='$userid'";
                          $query2 = mysqli_query($con,$sql2);
                          $itemscount=mysqli_num_rows($query2);

                          echo '
                          <li class="nav-item">
                            <a class="nav-link rounded-pill color-primary-bg" href="cart.php?do=display&userid='.$userid.'">
                              <span class="font-size-20 text-white"><i class="fas fa-shopping-cart"></i></span>
                          <span class="badge rounded-pill color-secondary-bg position-absolute top-10 start-80 translate-middle text-white">'.$itemscount.'</span>
                          </a>
                        </li>
                         <div class="dropdown">
                            <button class="btn btn-default color-secondary-bg color-primary dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> HI '.$row["user_name"].'</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a href="#" class="dropdown-item"><i class="fas fa-user"></i>My Profile</a></li>
                              <li><a href="logout.php" class="dropdown-item" ><i class="fas fa-sign-in"></i>Log out</a></li>

                            </ul>
                          </div>';

                      }else{
                          echo '
                          <li class="nav-item">
                            <a class="nav-link rounded-pill color-primary-bg" href="login.php">
                              <span class="font-size-20 text-white"><i class="fas fa-shopping-cart"></i></span>
                          <span class="badge rounded-pill color-secondary-bg position-absolute top-10 start-80 translate-middle text-white">0</span>
                          </a>
                        </li>
                          <a class="btn btn-default color-secondary-bg text-white" href="login.php">Start Shoping</a>';

                      }
                                       ?>


    </div>
  </div>
</nav>
<main id="main-site">
