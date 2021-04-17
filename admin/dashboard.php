<?php
 session_start();
 if (isset($_SESSION['username'])) {
   $pageTitle='Dashboard';
 include 'template/header.php';
 include 'template/navbar.php';
  $sql = "SELECT * FROM users WHERE group_id!=1";
  $query = mysqli_query($con,$sql);
  $membercount = mysqli_num_rows($query);

  $sql2 = "SELECT * FROM products";
  $query2 = mysqli_query($con,$sql2);
  $productcount = mysqli_num_rows($query2);
 ?>
<div class="container">
  <div class="row">
    <div class="col-6 card" style="background-color: #2A9D8F;width: 18rem;margin:20px auto;">
      <div class="card-body">
        <h5 class="card-title">Number Of Members</h5>
        <p class="card-text text-center"><?php echo $membercount; ?></p>
        <a href="members.php" class="btn btn-primary" style="background-color:#F4A261;">Manage Members</a>
      </div>
    </div>
    <div class="col-6 card" style="background-color: #F4A261;width: 18rem;margin:20px auto;">
      <div class="card-body">
        <h5 class="card-title">Number Of Products</h5>
        <p class="card-text text-center"><?php echo $productcount; ?></p>
        <a href="products.php" class="btn btn-primary" style="background-color: #2A9D8F;">Manage Products</a>
      </div>
    </div>
  </div>
</div>

 <?php
 }else{
  header('Location: index.php');
}
include 'template/footer.php';

?>
