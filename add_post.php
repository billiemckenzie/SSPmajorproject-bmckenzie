<?php
//is user logged in, and do they have rights
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("Location: http://".$_SERVER["SERVER_NAME"]);
}

require_once("header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12 pt-5 mt-5">
            <h1 class="pb-5">Add to Your Portfolio</h1>
            <p>Add to your portfolio, to help people discover your profile. These posts will all go into the feed where users can browse articles - make something eye catching to ensure your posts stand out from the crowd!</p>
            <hr class="mt-5 mb-5">
            <?php include($_SERVER["DOCUMENT_ROOT"]."/includes/error_check.php"); ?>
            <form action="/actions/create_post_action.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Post Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea name="content" id="content" class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                </div>
                <div class="pb-5 mb-5 pt-5">
                    <button class="btn dark-btn" name="action" value="publish">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
require_once("footer.php");
?>