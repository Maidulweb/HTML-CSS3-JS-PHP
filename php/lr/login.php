<?php include ('header.php');
      include ('lib/User.php');
      Session::checkLogin();
      $user = new User();
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ) {
        $userlog = $user->userLogin($_POST);
      }
 ?>
<div class="container login_body">
	<?php 
   if (isset($userlog)) {
     echo $userlog;
   }
  ?>
<form action="" method="post">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
  </div>
  
  <button type="submit" name="login" class="btn btn-primary">Sign in</button>
</form>
</div>
<?php include ('footer.php'); ?>