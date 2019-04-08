<?php include 'header.php';
      include 'lib/User.php';
      
   Session::checkSession();
?>
<?php 
   if (isset($_GET['id'])) {
     $userid = (int)$_GET['id'];
      $sessId = Session::get('id');
    if ($sessId != $userid) {
      header("Location: index.php");
    }
   }
   $user = new User();

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass']) ) {
        $changepassword = $user->changePassword($userid, $_POST);
      }
 ?>
  <div class="container" style="width: 50%; margin: 0 auto;">

   <form action="" method="post">
   <?php if (isset($changepassword)) {
      echo $changepassword;
    } ?>
  <div class="form-group">
    <label for="oldpassword">Old Password</label>
    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
  </div>
  <div class="form-group">
    <label for="newpassword">New Password</label>
    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password">
  </div>
  
  <button type="submit" name="changepass" class="btn btn-primary">Change Password</button>
</form>
  </div>
<?php include ('footer.php'); ?>
