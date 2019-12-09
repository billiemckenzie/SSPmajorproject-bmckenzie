<?php
//is user logged in, and do they have rights
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("Location: http://".$_SERVER["SERVER_NAME"]);
}

require_once("header.php");

if(isset($_GET["article_id"])){
    $article_id = $_GET["article_id"];
    $article_query = "SELECT * FROM articles WHERE id = $article_id";
    if($results = mysqli_query($conn, $article_query) ){
        while($article_row = mysqli_fetch_array($results)){
?>

<div class="container">
    <div class="row">
        <div class="col-12 pt-5 mt-5">
            <h1 class="pb-5">Edit Portfolio Item</h1>
            <p>Edit your portfolio item</p>
            <hr class="mt-5 mb-5">
            <?php include($_SERVER["DOCUMENT_ROOT"]."/includes/error_check.php"); ?>
            <form action="/actions/update_post_action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="article_id" value="<?=$article_row["id"];?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="<?=$article_row["title"];?>" id="title" placeholder="Post Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea name="content" id="content" class="form-control" rows="10"><?=$article_row["content"];?></textarea>
                </div>
                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                </div>
                <div class="pb-5 mb-5 pt-5">
                    <button class="btn btn-text text-danger" name="action" value="delete">Delete Item</button>
                    <button class="btn dark-btn" name="action" value="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
        }
    }
}
require_once("footer.php");
?>