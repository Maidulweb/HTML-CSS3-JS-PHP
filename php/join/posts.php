<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "join";
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn){
    $sql_for_category = "SELECT * FROM category";
    $cat_result = mysqli_query($conn, $sql_for_category);
    $sql_for_tags = "Select * From tag";
    $tag_result = mysqli_query($conn,$sql_for_tags);
    $post_query_string = "Select post.*, category.name From post join category on category.id = post.category_id";
    $post_result = mysqli_query($conn,$post_query_string);

    if(isset($_POST['save'])){
        $title = $_POST['title'];
        $body = $_POST['body'];
        $category = $_POST['category_id'];
        $tags = '';
        foreach($_POST['tag_id'] as $i=>$item){

            $tags .= $item;
            if(count($_POST['tag_id'])-1 !== $i){
                $tags .= ',';
            }

        }
        $sql_for_post = "INSERT INTO post (title,body,category_id,tag_id) VALUE ('$title','$body','$category','$tags')";
        $inset_action = mysqli_query($conn,$sql_for_post);

    }


?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>This sample title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        h1 {
            background: #f1f1f1;
            padding: 30px 0;
            margin-bottom: 50px;
            text-align: center;
        }

        label {
            font-weight: 700;
        }
    </style>
</head>
<body>

<h1><a class="btn btn-success" href="index.php">Home</a> || <a class="btn btn-success" href="category.php">Category</a>
</h1>
<div class="input">
    <div class="container">
        <div class="text-center">



        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="" method="post" style="margin-bottom: 20px;">
                    <?php
                    if(isset($inset_action)){
                        ?>
                        <p class="alert alert-success">Post created...</p>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" id="name" name="title" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="Body">Body</label>
                        <textarea name="body" id="Body" cols="10" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <?php
                            while ($row = mysqli_fetch_array($cat_result,MYSQLI_ASSOC)){
                                ?>
                                <option value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tags</label>
                        <?php
                        while($row=mysqli_fetch_array($tag_result,MYSQLI_ASSOC)){
                            ?>
                            <input type="checkbox" name="tag_id[]" id="tag" value="<?= $row['id'] ?>"> <?= $row['location'] ?>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>


            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th>Body</th>
                        <th scope="col">Tag</th>
                        <th scope="col">Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($data=mysqli_fetch_array($post_result,MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            <td><?php echo $data['id'] ?></td>
                            <td><?php echo $data['title'] ?></td>
                            <td><?php echo $data['body'] ?></td>
                            <td><?php echo $data['tag_id'] ?></td>
                            <td><?php echo $data['name'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
}else{
    echo "No";
}
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>