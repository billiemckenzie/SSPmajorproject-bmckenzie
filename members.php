<?php
require_once("header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="pt-5 mt-5 mb-2"><?php
                                        if (isset($_GET["search"])) {
                                            echo "Search Results for: " . $_GET["search"];
                                        } else {
                                            echo "Browse Designer Profiles";
                                        }
                                        ?></h1>
        </div>
        <hr>

        <?php
        $users_query = "SELECT users.*, images.url AS profile_pic
                        FROM users 
                        LEFT JOIN images
                        ON users.profile_pic_id = images.id";
        $search = (isset($_GET["search"])) ? $_GET["search"] : false;

        if ($search) {
            $search_words = explode(" ", $search);
            //explode will seperate a string into an array

            //loop through each word in our array
            for ($i = 0; $i < count($search_words); $i++) {
                //only append WHERE if $i is 0
                $users_query .= ($i > 0) ? " OR " : " WHERE ";
                $users_query .= "users.first_name LIKE '%" . $search_words[$i] . "%'";
                $users_query .= " OR users.last_name LIKE '%" . $search_words[$i] . "%'";
            }
        }
        ?>

        <!----SEARCH BAR----->
        <div class="col-12 mb-5">
            <form action="/members.php" class="form-inline my-2 my-lg-0 pt-5 mt-5">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ""; ?>">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <?php
        if ($users_result = mysqli_query($conn, $users_query)) {
            while ($user_row = mysqli_fetch_array($users_result)) {
                ?>

                <div class="col-md-3 pt-5">
                    <div class="card">
                        <div class="square-img">
                            <img src="<?php echo $user_row['profile_pic'] ?>" class="card-img-top">
                        </div>
                        <div class="card-header">
                            <h5 class="pt-5">
                                <a href="/profile.php?user_id=<?= $user_row["id"]; ?>">
                                    <?= $user_row["first_name"] . " " . $user_row["last_name"] ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>

        <?php
            }
        } else {
            echo mysqli_error($conn);
        }
        ?>
    </div>
</div>


<?php
require_once("footer.php");
?>