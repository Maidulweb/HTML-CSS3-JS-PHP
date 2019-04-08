<?php include 'header.php'; 
      include 'lib/User.php';
      $user = new User();
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']) ) {
        $userRegi = $user->userRegistration($_POST);
      }
?>
<div class="container login_body">
 
<form action="" method="post">
  <?php 
   if (isset($userRegi)) {
     echo $userRegi;
   }
  ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>
  
  <button type="submit" name="register" class="btn btn-primary">Register</button>
</form>
</div>
<?php include ('footer.php'); ?>