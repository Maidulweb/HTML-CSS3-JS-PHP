<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "join";
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn){
    if (isset($_POST['save'])){
        $name = $_POST['name'];
        $sql = "INSERT INTO category (name) VALUE ('$name')";
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

<h1><a class="btn btn-success" href="index.php">Home</a> || <a class="btn btn-success" href="category.php">Category</a> || <a class="btn btn-success" href="tag.php">Tag</a></h1>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>