<?php
require_once("header.php");

$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = " SELECT users.*, provinces.name AS province_name, images.url AS profile_pic
                FROM users 
                LEFT JOIN provinces
                ON users.province_id = provinces.id
                LEFT JOIN images
                ON users.profile_pic_id = images.id
                WHERE users.id = " . $user_id;

if ($user_request = mysqli_query($conn, $user_query)) :
    while ($user_row = mysqli_fetch_array($user_request)) :
        //print_r($user_row);
        ?>


        <div class="container main-container">
            <div class="row">
                <div class="col-4 pt-5 mt-5">
                    <img src="<?php echo $user_row['profile_pic'] ?>" class="w-100">
                </div>
                <div class="col-7 pt-5 mt-5 ml-5 mb-5 pb-5">
                    <?php
                            include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                            ?>
                    <h1 class="mb-5"><?php echo $user_row["first_name"] . " " . $user_row["last_name"]; ?>'s Profile</h1>
                    <hr>
                    <p>
                        <?= $user_row["address"]; ?><br>
                        <?= ($user_row["address2"] != "") ? $user_row["address2"] . '<br>' : ''; ?>
                        <?= $user_row["city"] . ", " . $user_row["province_name"]; ?><br>
                        <?= $user_row["postal_code"]; ?>
                    </p>
                    <p>
                        <?= $user_row["email"]; ?>
                    </p>
                    <p>
                        Date user joined: <br>
                        <?php
                                echo date("F jS, Y", strtotime($user_row["date_created"]));
                                ?>
                    </p>
                    <hr>
                    <?php
                            if ($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1) :
                                ?>
                        <div class="btn-group">
                            <a href="/edit_profile.php?user_id=<?= $user_row["id"]; ?>" class="btn light-btn"> Edit Profile</a>
                        </div>
                    <?php

                            endif;
                            ?>
                </div>
            </div>
            <hr>
            <div class="col-12 pt-5 mt-5">
                <h1 class="mb-5 text-center">Browse Designs posted by <?php echo $user_row["first_name"]; ?></h1>
            </div>
            <?php
                    if (isset($user_id)) {

                        $article_query = "SELECT articles.*,
                                    images.url AS featured_image
                                    FROM articles 
                                    LEFT JOIN images
                                    ON articles.image_id = images.id
                                    WHERE articles.author_id = " . $user_id;
                        if ($article_result = mysqli_query($conn, $article_query)) {
                            while ($article_row = mysqli_fetch_array($article_result)) {
                                ?>
                                
                        <div class="card mb-5 col-10 m-auto">
                            <div class="row no-gutters pt-5 pb-0 pl-5">
                                <div class="col-md-2">
                                    <img class="card-img" src="<?= $article_row["featured_image"] ?>">
                                </div>
                                <div class="col-md-9 mb-5">
                                    <div class="card-body ml-5">
                                        <h5 class="card-title">
                                            <a href="/articles.php?id=<?= $article_row["id"] ?>"><?= $article_row["title"] ?></a>
                                        </h5>
                                        <p>
                                            <a href="/articles.php?id=<?= $article_row["id"] ?>">Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

            <?php
                            }
                        }
                    }

                    ?>
        </div> <?php
                    endwhile;
                endif;
                require_once("footer.php");

                ?>