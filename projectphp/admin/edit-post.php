<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

/* GET POST DATA */
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM category1 WHERE id=$id");
    $post = mysqli_fetch_assoc($result);
}else{
    header("Location: manage-posts.php");
    exit();
}

/* UPDATE POST */
if(isset($_POST['update'])){
    
    $title = $_POST['title'];
    $category_id = $_POST['category'];
    $description = $_POST['description'];

    /* CHECK IF NEW IMAGE UPLOADED */
    if($_FILES['image']['name'] != ""){

        $image = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "uploads/".$image);

        // Delete old image
        unlink("uploads/".$post['image']);

        mysqli_query($conn, "UPDATE category1 SET 
            title='$title',
            category_id='$category_id',
            description='$description',
            image='$image'
            WHERE id=$id
        ");

    } else {

        mysqli_query($conn, "UPDATE category1 SET 
            title='$title',
            category_id='$category_id',
            description='$description'
            WHERE id=$id
        ");
    }

    header("Location: manage-posts.php");
    exit();
}

/* FETCH CATEGORIES */
$categories = mysqli_query($conn, "SELECT * FROM categories");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2>Edit Post</h2>

    <form method="POST" enctype="multipart/form-data" 
          class="shadow p-4 rounded bg-light">

        <div class="mb-3">
            <label class="form-label">Post Title</label>
            <input type="text" name="title" class="form-control"
                   value="<?php echo $post['title']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>

                <?php while($cat = mysqli_fetch_assoc($categories)) { ?>

                    <option value="<?php echo $cat['id']; ?>"
                        <?php if($cat['id'] == $post['category_id']) echo "selected"; ?>>
                        <?php echo $cat['category_name']; ?>
                    </option>

                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"
                      rows="5" required><?php echo $post['description']; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="uploads/<?php echo $post['image']; ?>"
                 width="120"
                 class="img-thumbnail mb-2">
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image (Optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-success">
            Update Post
        </button>

        <a href="manage-posts.php" class="btn btn-secondary">
            Cancel
        </a>

    </form>
</div>

</body>
</html>