<?php
session_start();
$pageTitle='Login';
if (isset($_SESSION['username'])) {
  header('Location:index.php');

}
include './config/connect.php';

//Check If User Coming From HTTP POST

if (isset($_POST["signup"])) {
  $username=$_POST["username"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $fullname=$_POST["fullname"];
  $gender=$_POST["gender"];
  $hashedpass = sha1($password);


  $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $query = mysqli_query($con,$sql);
  if (mysqli_num_rows($query)>0) {
    echo "<div class='alert alert-danger'>User Already Exists</div>";

  }else{
    //Insert into The Database This Info
    $sql= "INSERT INTO users(user_name,password,email,full_name,gender) VALUES('$username','$hashedpass','$email','$fullname','$gender')";
    //Echo Success Message
    if (mysqli_query($con, $sql)) {
      echo "<div class='alert alert-success'>You Have Signed up successfully Please Login Now!</div>";
      header("location:login.php");
    } else {
      echo "<div class='alert alert-danger'>Error Inserting record: " . mysqli_error($con) . "</div>";
    }
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
  <h4 class="text-center">Signup</h4>
  <div class="card">
    <div class="m-3">
      <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="m-3">
      <input type="email" name="email" class="form-control" placeholder="Email"required>
    </div>
    <div class="m-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="m-3">
      <input type="text" name="fullname" class="form-control" placeholder="Fullname" required>
    </div>
    <div class="mx-3">
      <label class="form-label color-primary">Gender</label>
    </div>
    <div class="mx-3 form-check text-secondary">
      <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
      <label class="form-check-label" for="flexRadioDefault1">Male</label>
    </div>
    <div class="mx-3 form-check text-secondary">
      <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2">
      <label class="form-check-label" for="flexRadioDefault2">Female</label>    </div>
    <input type="submit" name="signup" class="btn btn-primary m-3" value="SIGNUP">
    <p class="text-center">Don't have an Account? <a href="login.php"> Login Now!</a></p>


  </div>
</form>
<?php include 'template/footer.php';?>
