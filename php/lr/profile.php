<?php include 'header.php';
      include 'lib/User.php';
      
   Session::checkSession();
?>
<?php 
   if (isset($_GET['id'])) {
     $userid = (int)$_GET['id'];
      
   }
   $user = new User();

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']) ) {
        $userup = $user->userUpdate($userid, $_POST);
      }
 ?>
  <div class="container" style="width: 50%; margin: 0 auto;">

    <?php 
      $userdata = $user->getUserById($userid);
      if ($userdata) {
     ?>
   <form action="" method="post">
    <?php if (isset($userup)) {
      echo $userup;
    } ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $userdata->name; ?> ">
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $userdata->username; ?> ">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" value="<?php echo $userdata->email; ?> ">
  </div>
  <?php 
    $sessId = Session::get('id');
    if ($sessId == $userid) {
  ?>
  <button type="submit" name="update" class="btn btn-primary">Update</button>
  <a class="btn btn-success" href="changepassword.php?id=<?php echo $userid; ?>">Password Change</a>
  <?php } ?>
</form>
<?php } ?>
  </div>
<?php include ('footer.php'); ?>
