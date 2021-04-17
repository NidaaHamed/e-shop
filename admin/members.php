<?php

/*
===============================================
== Manage Members Page
==You Can Add | Edit | Delete Members From Here
===============================================
*/
 session_start();

 if (isset($_SESSION['username'])) {
   $pageTitle='Members';
   include 'template/header.php';
   include 'template/navbar.php';
   include '../config/connect.php';

   $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   //Start Manage Page
    if ($do == 'Manage') { // Manage Page
      $sql = "SELECT * FROM users WHERE group_id!=1";
      $query = mysqli_query($con,$sql);
      if (mysqli_num_rows($query)>0) {
          ?>
          <h1 class="text-center">Manage Members</h1>
          <div class="container">
            <table class="table">
             <thead class="table-dark">
               <tr>
                  <th scope="col">#ID</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Register Date</th>
                  <th scope="col">Control</th>
               </tr>
             </thead>
             <tbody>
  <?php   while ($row=mysqli_fetch_array($query)) { ?>
               <tr>
                  <th scope="row"><?php echo $row['user_id']; ?></th>
                  <td><?php echo $row['user_name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['full_name']; ?></td>
                  <td><?php echo $row['gender']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>

                  <td>
                    <a href="members.php?do=Edit&userid=<?php echo $row['user_id'];?>" class="btn btn-success"><i class="far fa-edit"></i> Edit</a>
                    <a href="members.php?do=Delete&userid=<?php echo $row['user_id'];?>" class="btn btn-danger confirm"><i class="far fa-window-close"></i> Delete</a>
                  </td>
               </tr>
    <?php }?>
             </tbody>
           </table>

           <a href='members.php?do=Add' class="btn btn-primary"><i class="fas fa-plus"></i> Add New Member</a>

          </div>
<?php
      }
    }elseif ($do == 'Add'){ //Add Members Page?>
     <h1 class="text-center">Add New Member</h1>
     <div class="container">
       <form method="post" action="?do=Insert">
         <div class="mb-3">
           <label class="form-label">Username</label>
           <span class="asterisk">*</span>
           <input type="text" name="username" class="form-control"autocomplete="off" placeholder="Username To Login Into E-shop" required>
         </div>
         <div class="mb-3">
           <label class="form-label">Password</label>
           <span class="asterisk">*</span>
           <input type="password" name="password" class="form-control" id="password" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" required>
           <i class="fas fa-eye-slash" id="eye"></i>

         </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <span class="asterisk">*</span>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email Must Be Valid" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <span class="asterisk">*</span>
            <input type="text" name="fullname" class="form-control" placeholder="Full Name Appear In Your Profile Page" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Gender</label>
            <span class="asterisk">*</span>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2" checked>
              <label class="form-check-label" for="flexRadioDefault2">
                Female
              </label>
            </div>
          </div>
          <button type="submit" name="add" class="btn btn-primary">Add Member</button>
        </form>
     </div>


    <?php
    }elseif ($do == 'Insert') { // Insert Page
      echo "<h1 class='text-center'>Insert Member</h1>";
      echo "<div class='container'>";
        if (isset($_POST['add'])) {
          //Get Variables From The Form
          $user  = $_POST['username'];
          $email = $_POST['email'];
          $name  = $_POST['fullname'];
          $pass  = $_POST['password'];
          $gender  = $_POST['gender'];

          $hashedpass= sha1($pass);


          $formErrors = array();
          if (strlen($user) < 4 ) {
            $formErrors[] = '<div class="alert alert-danger">Username Can\'t be less than 4 Characters</div>';
          }
          if (strlen($user) > 20) {
            $formErrors[] = '<div class="alert alert-danger">Username Can\'t be more than 20 Characters</div>';
          }
          if (empty($user)) {
            $formErrors[] = '<div class="alert alert-danger">Username Can\'t be Empty</div>';
          }
          if (empty($email)) {
            $formErrors[] = '<div class="alert alert-danger">Email Can\'t be Empty</div>';
          }
          if (empty($name)) {
            $formErrors[] = '<div class="alert alert-danger">Full Name Can\'t be Empty</div>';
          }
          if (empty($pass)) {
            $formErrors[] = '<div class="alert alert-danger">Password Can\'t be Empty</div>';
          }

          foreach ($formErrors as $error) {
            echo $error . '<br>';
          }

          //Check If Theres No Error Proceed the Update operation
          if (empty($formErrors)) {
            //Check If User Already exists
            $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $query = mysqli_query($con,$sql);
            if (mysqli_num_rows($query)>0) {
              echo "<div class='alert alert-danger'>User Already Exists</div>";

            }else{
              //Insert into The Database This Info
              $sql= "INSERT INTO users(user_name,password,email,full_name,gender) VALUES('$user','$hashedpass','$email','$name','$gender')";
              //Echo Success Message
              if (mysqli_query($con, $sql)) {
                echo "<div class='alert alert-success'>Record Inserted successfully</div>";
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
     $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
     // Select All Data Depend On this Id
     $sql = "SELECT * FROM users WHERE user_id='$userid' LIMIT 1";
     $query = mysqli_query($con,$sql);
     //If there is such Id show the Form
     if (mysqli_num_rows($query)>0) {
       $row = mysqli_fetch_array($query);
       ?>
       <h1 class="text-center">Edit Members</h1>
       <div class="container">
         <form method="post" action="?do=Update">
           <input type="hidden" name="userid" value="<?php echo $userid; ?>">
           <div class="mb-3">
             <label class="form-label">Username</label>
             <span class="asterisk">*</span>
             <input type="text" name="username" class="form-control" value="<?php echo $row['user_name']; ?>" autocomplete="off" required>
           </div>
           <div class="mb-3">
             <label class="form-label">Password</label>
             <input type="hidden" name="oldpassword" value="<?php echo $row['password']?>">
             <input type="password" name="newpassword" class="form-control" autocomplete="new-password">
           </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <span class="asterisk">*</span>
              <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <span class="asterisk">*</span>
              <input type="text" name="fullname" value="<?php echo $row['full_name']; ?>" class="form-control" required>
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
          $id    = $_POST['userid'];
          $user  = $_POST['username'];
          $email = $_POST['email'];
          $name  = $_POST['fullname'];

          //Password Trick

          $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

          $formErrors = array();
          if (strlen($user) < 4 ) {
            $formErrors[] = '<div class="alert alert-danger">Username Can\'t be less than 4 Characters</div>';
          }
          if (strlen($user) > 20) {
            $formErrors[] = '<div class="alert alert-danger">Username Can\'t be more than 20 Characters</div>';
          }
          if (empty($user)) {
            $formErrors[] = '<div class="alert alert-danger">Username Can\'t be Empty</div>';
          }
          if (empty($email)) {
            $formErrors[] = '<div class="alert alert-danger">Email Can\'t be Empty</div>';
          }
          if (empty($name)) {
            $formErrors[] = '<div class="alert alert-danger">Full Name Can\'t be Empty</div>';
          }

          foreach ($formErrors as $error) {
            echo $error . '<br>';
          }

          //Check If Theres No Error Proceed the Update operation
          if (empty($formErrors)) {
            //Update The Database With This Info
            $sql   = "UPDATE users SET user_name='$user',email='$email',full_name='$name' WHERE user_id='$id'";
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
      //Delete Member Page
      // Check If Get Request userid Is numeric & Get the Integer Value Of It
      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
      // Select All Data Depend On this Id
      $sql = "SELECT * FROM users WHERE user_id='$userid' LIMIT 1";
      $query = mysqli_query($con,$sql);
      //If there is such Id Delete It From The Database
      if (mysqli_num_rows($query)>0) {

          $del="DELETE FROM users WHERE user_id='$userid'";
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
