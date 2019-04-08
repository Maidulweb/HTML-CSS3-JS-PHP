<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "login_db";
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn){
    $id = $_GET['id'];
    $sql = "SELECT * FROM new_table WHERE id = " .$id;
    $result = mysqli_query($conn, $sql);
    $info = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $info['id'] = $row['id'];
        $info['name'] = $row['name'];
        $info['email'] = $row['email'];
    }
}else{
    echo "Connection Failed";
}

?>
<!DOCTYPE html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>This sample title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        h1{
            background: #f1f1f1;
            padding: 30px 0;
            margin-bottom: 50px;
        }
        label{
            font-weight: 700;
        }
    </style>
</head>
    <body>

    <?php
    if (isset($_POST['submit'])){
        $id = $_POST['info_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sql = "UPDATE new_table SET name = '".$name."',email='".$email."' WHERE id = '".$id."' ";
        $result = mysqli_query($conn, $sql);
        if ($result){

            header("Location:edit.php?id= $id &editStatus");
        }else{
            echo "Data updated Failed";
        }
    }
    ?>
    <h1 class="text-center"><a class="btn btn-success" href="index.php">Home</a> || <a class="btn btn-success" href="create.php">Create</a></h1>
<div class="container">
    <div class="text-center">
        <?php
        if(isset($_GET['editStatus'])){
            ?>
            <p class="alert alert-success">Edit successfully.</p>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">

        <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="hidden" class="hidden" name="info_id" value="<?php echo $info['id'];?>">
            <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo $info['name'];?>">

        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $info['email'];?>">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Edit</button>
    </form>
        </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>