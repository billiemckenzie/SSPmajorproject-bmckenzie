<?php
require_once("header.php");
?>

<div class="container">
    <div class="row pt-5 mt-5">
        <h1>Browse New Designs</h1>
        <?php
        if (isset($_GET["id"])) {

            $article_query = "SELECT articles.*, 
                                     users.first_name, users.last_name, 
                                     images.url AS featured_image
                              FROM articles 
                              LEFT JOIN users
                              ON articles.author_id = users.id
                              LEFT JOIN images
                              ON articles.image_id = images.id
                              WHERE articles.id = " . $_GET["id"];
            if ($article_result = mysqli_query($conn, $article_query)) {
                while ($article_row = mysqli_fetch_array($article_result)) {
                    //print_r($article_row);
                    ?>
                    <div class="row">
                        <div class="col-6 pt-5 mt-5">
                            <h5><?= $article_row["title"] ?></h5>
                            <p class="text-muted pb-5">Published on <?= date("M jS Y", strtotime($article_row["date_created"])) ?> by <?= $article_row["first_name"] . " " . $article_row["last_name"] ?></p>
                            <?php
                                echo $article_row["content"];
                                ?>
                            <div>
                                <a class="btn sm-btn pt-5" href="/profile.php?user_id=<?=$article_row["author_id"];?>">View Full Profile</a> 
                            </div>
                        </div>
                        <div class="col-6">
                            <figure class="pt-5">
                                <img src="<?= $article_row["featured_image"] ?>" class="w-100 pb-5 pt-5">
                            </figure>
                        </div>
                    </div>
                    <div class="container pt-5 col m-auto">
                        <div class="row">
                            <button class="btn dark-btn "><a href="/articles.php">Back to Browse</a></button>
                        </div>
                    </div>
            <?php
                //If logged in and the post is yours or you are super admin
                // show edit menu
                if( isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article_row["author_id"]){
                    echo "<hr>";
                    echo "<div class='container pt-5 col m-auto'>";
                        echo "<a href='edit_post.php?article_id=".$article_row["id"]."' class='btn light-btn'>Edit Article</a>";
                    echo "</div>";
                }

                    }
                } else {
                    echo mysqli_error($conn);
                }
            } else {
                ?>
            <div class="col-12 pt-5 mt-5">
                <h5>All Portfolio Items</h5>
            </div>
            <?php

                $article_query = "SELECT articles.title, images.url AS featured_image, articles.author_id, 
                                     users.first_name, users.last_name, articles.date_created, articles.id
                              FROM articles
                              LEFT JOIN images
                              ON articles.image_id = images.id
                              LEFT JOIN users
                              ON articles.author_id = users.id
                              ORDER BY articles.date_created DESC";

                if ($article_result = mysqli_query($conn, $article_query)) {
                    while ($article_row = mysqli_fetch_array($article_result)) {
                        ?>
                    <div class="card mb-3 col-12">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <img class="card-img" src="<?= $article_row["featured_image"] ?>">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="/articles.php?id=<?= $article_row["id"] ?>"><?= $article_row["title"] ?></a>
                                    </h5>
                                    <small class="text-muted"><?= "By " . $article_row["first_name"] . " " . $article_row["last_name"] . " on " . date("M d, Y", strtotime($article_row["date_created"])) ?>
                                    </small>
                                    <p>
                                        <a href="/articles.php?id=<?= $article_row["id"] ?>">Read More</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

        <?php

                }
            } else {
                echo mysqli_error($conn);
            }
        }
        ?>
    </div>
</div>


<?php
require_once("footer.php");
?>