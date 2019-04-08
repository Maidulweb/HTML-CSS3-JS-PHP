<?php 
      include 'header.php'; 
      include 'lib/User.php';
      $user = new User();
      Session::checkSession();
?>
<?php 
 if (isset($_GET['id'])) {
     $userid = (int)$_GET['id'];
          
   }
?>
  <div class="container">
    <?php 
      
      $loginmsg = Session::get('loginmsg');
      if (isset($loginmsg)) {
        echo $loginmsg;
      }
      Session::set('loginmsg', NULL);
     ?>
    <div class="float-left"> <p>logo</p> </div>
    <div class="float-right"> 
      <h2>
        <?php 
          $username = Session::get('username');
      if (isset($username)) {
        echo '<strong>'.$username;
      }

         ?>
      </strong></h2>
     </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $userData = $user->getUserData();
      if ($userData) {
        $i = 0;
       foreach ($userData as $sdata) {
         $i++;
       
     ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $sdata["name"]; ?></td>
      <td><?php echo $sdata["username"]; ?></td>
      <td><?php echo $sdata["email"]; ?></td>
      <td><a href="profile.php?id=<?php echo $sdata['id']; ?>">Edit</a></td>
      
      <?php 
      if (isset($_GET['delete'])) {
        $de_id = $_GET['delete'];
        $delete = $user->userDelete($de_id);
   }
     ?>
      <td><a onclick="return confirm('ok')" name="delete" href="?delete=<?php echo $sdata['id']; ?>">Delete</a></td>
  
    </tr>
  <?php }}else{?>
    <h2>Data Not Found</h2>
  <?php } ?>
  </tbody>
</table>
  </div>
<?php include ('footer.php'); ?>
