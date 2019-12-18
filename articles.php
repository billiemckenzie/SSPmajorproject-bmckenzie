<?php
require_once("header.php");
?>


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
            <div class="container main-container">
                <div class="row">
                    <div class="col-6 pt-5 mt-5">
                        <h5><?= $article_row["title"] ?></h5>
                        <p class="text-muted pb-5">Published on <?= date("M jS Y", strtotime($article_row["date_created"])) ?> by <?= $article_row["first_name"] . " " . $article_row["last_name"] ?></p>
                        <?php echo $article_row["content"];?>
                        <div>
                            <a class="btn sm-btn pt-5" href="/profile.php?user_id=<?= $article_row["author_id"]; ?>">View Designers Profile</a>
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
                        <button class="btn dark-btn mr-5"><a href="/articles.php">Back to Browse Designs</a></button>
                        <button class="btn light-btn ml-5"><a href="/members.php">Back to Browse Profiles</a></button>
                    </div>
                </div>
            </div>
    <?php
                //If logged in and the post is yours or you are super admin
                // show edit menu
                if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article_row["author_id"]) {
                    echo "<div class='container pt-5'>";
                    echo "<a href='edit_post.php?article_id=" . $article_row["id"] . "' class='btn light-btn'>Edit Article</a>";
                    echo "</div>";
                }
            }
        } else {
            echo mysqli_error($conn);
        }
    } else {

        ?>

    <div class="container">
        <div class="col-12 pt-5 mt-5">
            <h1>Browse New Designs</h1>

            <p class="pt-3">Check out the lastest designs, and articles posted by the designers from our site. <br> See something you like? Click the name of the poster to view their full profile, and get in touch!</p>
            <hr>
            <hr class="mt-5 mb-5 pb-5">

            <?php
                $current_page = (isset($_GET["page"])) ? $_GET["page"] : 1;
                $limit = 5;
                $offset = $limit * ($current_page - 1);

                $article_query = "SELECT articles.title, images.url AS featured_image, articles.author_id, 
                                     users.first_name, users.last_name, articles.date_created, articles.id
                              FROM articles
                              LEFT JOIN images
                              ON articles.image_id = images.id
                              LEFT JOIN users
                              ON articles.author_id = users.id
                              ORDER BY articles.date_created ASC
                              LIMIT $limit OFFSET $offset";

                if ($article_result = mysqli_query($conn, $article_query)) {
                    $num_posts = mysqli_num_rows($article_result);

                    //Get the total cound of articles
                    $pagi_query = "SELECT COUNT(*) AS total FROM articles";
                    $pagi_result = mysqli_query($conn, $pagi_query);
                    $pagi_row = mysqli_fetch_array($pagi_result);
                    $total_articles = $pagi_row["total"];

                    $page_count = ceil($total_articles / $limit);
                    // floor = round down
                    // ceil =  round up
                    // round = round down if below 5, round up if above 5
                    echo "<nav aria-label='Page navigation example'> <ul class='pagination'>";

                    if ($current_page > 1) {
                        echo "<li class='page-item'><a class='page-link' href='/articles.php?page=" . ($current_page - 1) . "'>&laquo;</a></li>";
                    }

                    for ($i = 1; $i <= $page_count; $i++) {
                        echo "<li class='page-item";
                        if ($current_page == $i) echo " active";
                        echo "'><a class='page-link' href='/articles.php?page=$i'>$i</a></li>";
                    }

                    if ($current_page < $page_count) {
                        echo "<li class='page-item'><a class='page-link' href='/articles.php?page=" . ($current_page + 1) . "'>&raquo;</a></li>";
                    }

                    echo "</ul> </nav>";


                    while ($article_row = mysqli_fetch_array($article_result)) {
                        ?>

                    <div class="card mb-3 col-10 m-auto">
                        <div class="row no-gutters p-5">
                            <div class="col-md-3">
                                <a href="/articles.php?id=<?= $article_row["id"] ?>">
                                    <img class="card-img" src="<?= $article_row["featured_image"] ?>">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body ml-5">
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
    <div class="container mb-5 mt-5">
        <div class="col text-center">
            <button class="btn dark-btn mt-5 mb-5"><a href="/members.php">Back to Browse Profiles</a></button>
        </div>
    </div>


    <?php
    require_once("footer.php");
    ?>