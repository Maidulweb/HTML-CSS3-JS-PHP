<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "newjoin";
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn){
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $sql = "INSERT INTO book (book_name, key_word) VALUES ('$name', '$phone')";
        $result = mysqli_query($conn, $sql);

    }
}else{

}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>New Join</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .menu{
            padding: 20px 0;
            background: #f3f3f3;
        }
        .menu ul li{
            display: inline-block;
            padding: 0 10px;
        }
        .menu ul li a{
            font-weight: 700;
        }
        .main_body{
            padding: 20px 0;
            background: #f9f9f9;
        }
    </style>
</head>
<body>
<div class="text-right menu">
    <div class="container">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="name.php">Name</a></li>
            <li><a href="book.php">Book</a></li>
        </ul>
    </div>
</div>
<div class="text-center">
    <?php
    if (isset($result)){
        ?>
        <p class="alert alert-success">Insert successfully</p>
        <?php

    }
    ?>
    <?php
    if (isset($_GET['editStatus'])){
        ?>
        <p class="alert alert-success">Edit Successfully</p>
        <?php
    }
    ?>
    <?php
    if (isset($_GET['deleteStatus'])){
        ?>
        <p class="alert alert-success">Delete Successfully</p>
        <?php
    }
    ?>

</div>
<div class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Book Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Key Word</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Numbar">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>


                <?php
                if (isset($_GET['edit'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM book WHERE id = ".$id;
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC) ) {
                        $id = $row['id'];
                        $name = $row['book_name'];
                        $phone = $row['key_word'];
                        ?>
                        <h2 style="padding: 5px 0 5px 10px; background: #222; color: #fff; margin-top: 20px; font-size: 1rem;">Edit Details :</h2>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <label for="name">Book Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name;?>" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Key Word</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone;?>" placeholder="Phone Numbar">
                            </div>
                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                        </form>
                    <?php } }?>
                <?php
                if (isset($_POST['edit'])){
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $sql = "UPDATE book SET book_name = '$name', key_word = '$phone' WHERE id = '$id' ";
                    $result = mysqli_query($conn, $sql);
                    header("Location: book.php?editStatus");
                }



                ?>

            </div>
            <div class="col-md-6">


                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Key Word</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM book";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC) ) {
                        $id = $row['id'];
                        $name = $row['book_name'];
                        $phone = $row['key_word'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $id;?></th>
                            <td><?php echo $name;?></td>
                            <td><?php echo $phone;?></td>
                            <td><a href="book.php?edit&id= <?php echo $id;?>">Edit</a>/
                                <a href="book.php?delete&id= <?php echo $id;?>">Delete</a></td>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <?php
                if (isset($_GET['delete'])){
                    $id = $_GET['id'];
                    $sql = 'DELETE FROM book WHERE id=' . $id;
                    $result = mysqli_query($conn, $sql);
                    header("Location: book.php?deleteStatus");
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>