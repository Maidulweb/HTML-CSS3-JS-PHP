<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "join";
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn){
    if (isset($_POST['save'])){
        $location = $_POST['location'];
        $sql = "INSERT INTO tag (location) VALUE ('$location')";
        $result = mysqli_query($conn , $sql);

    }
}else{
    echo "No";
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
            text-align: center;
        }
        label{
            font-weight: 700;
        }
    </style>
</head>
<body>

<h1><a class="btn btn-success" href="index.php">Home</a> || <a class="btn btn-success" href="tag.php">Tag</a></h1>
<div class="input">
    <div class="container">
        <div class="text-center">
            <?php
            if (isset($_GET['editStatues'])){
                ?>
                <p class="alert alert-success">Edit Successfully</p>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['deleteStatues'])){
                ?>
                <p class="alert alert-success">Delete Successfully</p>
                <?php
            }
            ?>
            <?php
            if (isset($result)){
                ?>
                <p class="alert alert-success">Insert successfully</p>
                <?php

            }
            ?>


        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="name" name="location" placeholder="Location">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                </form>
                <?php
                if (isset($_GET['edit'])){
                    $id = $_GET['id'];
                    $edit_sql = "SELECT * FROM tag WHERE id = ".$id;
                    $edit_result = mysqli_query($conn, $edit_sql);
                    while($row = mysqli_fetch_array($edit_result, MYSQLI_ASSOC)){
                        $edit_id = $row['id'];
                        $edit_location = $row['location'];



                        ?>
                        <hr>

                        <form action="" method="post" style="margin-top:20px; ">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="hidden" name="id" value="<?php echo $edit_id;?>">
                                <input type="text" class="form-control" id="name" name="location" value="<?php echo $edit_location;?>" placeholder="Location">
                            </div>
                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                        </form>
                    <?php  }
                }?>
            </div>

            <?php
            if (isset($_POST['edit'])){
                $id = $_POST['id'];
                $location = $_POST['location'];
                $sql = "UPDATE tag SET location = '$location' WHERE id = '$id' ";
                $result = mysqli_query($conn, $sql);
                header("location:tag.php?editStatues");
            }
            ?>

            <div class="col-md-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM tag";
                    $result = mysqli_query($conn, $sql);
                    while ($category = mysqli_fetch_array($result, MYSQLI_ASSOC) ){
                        $id = $category['id'];
                        $location = $category['location'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $id ;?></th>
                            <td><?php echo $location ;?></td>
                            <td>
                                <a class="btn btn-info" href="tag.php?edit&id=<?php echo $id ;?>">Edit</a>
                                <a class="btn btn-danger" href="tag.php?action=delete&id=<?php echo $id ;?>">Delete</a>
                            </td>
                        </tr>
                    <?php }?>

                    <?php
                    if(isset($_GET['action']) == 'delete') {
                        $sql = 'DELETE FROM tag WHERE id=' . $id;
                        $result = mysqli_query($conn, $sql);
                        if($result){

                            header("Location:tag.php?deleteStatues");
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>