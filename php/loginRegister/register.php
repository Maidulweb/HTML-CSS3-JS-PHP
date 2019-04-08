<?php
include ("includes/header.php");
validate_user_regs();
?>


<div class="container">
    <div class="row ok">
        <div class="col-md-6 col-md-offset-3">

    <form method="post">
    <input type="text" name="first_name" id="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required><br>
    <input type="text" name="username" id="username" placeholder="Username" required><br>
    <input type="text" name="email" id="email" placeholder="Email" required><br>
    <input type="password" name="password" id="password" placeholder="Password" required><br>
    <input type="password" name="confirm_password" id="first_name" placeholder="Confirm Password" required><br>

    <input type="submit">

    </form>
        </div>
    </div>
</div>


<?php
include ("includes/footer.php");
?>