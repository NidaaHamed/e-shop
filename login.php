<?php
session_start();
$pageTitle='Login';
if (isset($_SESSION['username'])) {
  header("Location:index.php?userid=".$_SESSION['userid']); //Redirect to Dashboard Page

}
include './config/connect.php';

//Check If User Coming From HTTP POST

if (isset($_POST["login"])) {
  $email=$_POST['email'];
  $password=$_POST['password'];
  $hashedpass=sha1($password);

  //Check If The User Exist In Database
  $sql = "SELECT
              user_id,user_name, email, password
          FROM
              users
          WHERE
              email='$email'
          AND
              password='$hashedpass'
          AND
              group_id=0
          LIMIT 1";
  $query = mysqli_query($con,$sql);

  if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_array($query);
    $_SESSION['username']=$row['user_name']; //Register Session Name
    $_SESSION['userid'] = $row['user_id'];//Register Session Id
    header("Location:index.php?userid=".$_SESSION['userid']); //Redirect to Dashboard Page
    exit();
  }



}
?>

<?php include 'template/header.php'; ?>
<style media="screen">
/* Start Login Form */

.login{
  width:25rem;
  margin:100px auto;
}
.login h4{
  color: #264653;
}
.card,.card input{
  background-color: #EEE;
}
.login .btn{
  background-color: #264653;
  color: #e9c46a;
  border: #00BFDE;
}
.form-control:focus{
  background-color: #EAEAEA;
  border-color: #ced4da;
  box-shadow: none;
}
/* End Login Form */

</style>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login">
  <h4 class="text-center">Login</h4>
  <div class="card">
    <div class="m-3">
      <input type="email" name="email" class="form-control" placeholder="Email">
    </div>
    <div class="m-3">
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <button type="submit" name="login" class="btn btn-primary m-3">Login</button>
    <p class="text-center">Don't have an Account? <a href="signup.php"> Signup Now!</a></p>


  </div>
</form>
<?php include 'template/footer.php';?>
