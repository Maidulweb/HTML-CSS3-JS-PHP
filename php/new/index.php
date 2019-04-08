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

    <h1 class="text-center"><a class="btn btn-success" href="index.php">Home</a> || <a class="btn btn-success" href="create.php">Create</a></h1>
    <div class="container">
        <div class="text-center">
            <?php
            if(isset($_GET['deleteStatues'])){
                ?>
                <p class="alert alert-success">Delete successfully.</p>
                <?php
            }
            ?>
        </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">

        <form action="" method="post">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "login_db";
                $conn = mysqli_connect($host, $user, $pass, $db);
                if ($conn){
                $sql = "SELECT * FROM new_table";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $id = $row['id'];
                $name = $row['name'];
                $email = $row['email'];


                ?>
                <tr>
                    <th scope="row"><?php echo $id ;?></th>
                    <td><?php echo $name ;?></td>
                    <td><?php echo $email ;?></td>
                    <td>
                        <a class="btn btn-success" href="edit.php?id=<?php echo $id ?>">Edit</a>
                        <a class="btn btn-success" href="index.php?action=delete&id=<?php echo $id ?>">Delete</a>
                    </td>
                </tr>
                    <?php
                }

                }else{
                    echo "Connection Failed";
                }

                ?>
                <?php
                if(isset($_GET['action']) == 'delete') {
                    $sql = 'DELETE FROM new_table WHERE id=' . $_GET['id'];
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "Deleted";
                        header("Location:index.php?deleteStatues");
                    }
                }
                ?>
                </tbody>
            </table>
    </form>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>