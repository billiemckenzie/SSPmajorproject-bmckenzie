<?php
require_once("header.php");

$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = "SELECT users.*, images.url AS profile_pic
                FROM users 
                LEFT JOIN images 
                ON users.profile_pic_id = images.id
                WHERE users.id = " . $user_id;


if ($user_request = mysqli_query($conn, $user_query)) :
    while ($user_row = mysqli_fetch_array($user_request)) :
        //print_r($user_row);
        ?>


        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row pt-5 mt-5 mb-5 pb-5">
                        <div class="col-3 mb-5">
                            <img src="<?php echo $user_row['profile_pic'] ?>" class="w-100">
                        </div>
                        <div class="col-9 pl-5">
                            <h1 class="pt-5 mb-5">Editing <?php echo $user_row["first_name"] . " " . $user_row["last_name"]; ?>'s Profile</h1>
                            <hr class="col-4 ml-0 mb-5">
                            <p>Keep your information up to date, so it's easier for people to find, and connect with you!</p>
                        </div>
                    </div>
                    <form action="/actions/edit_user.php" method="post" enctype="multipart/form-data" class="center-form">
                        <?php
                                include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                                ?>
                        <input type="hidden" name="user_id" value="<?php echo $user_row["id"] ?>">

                        <div class="form-row mb-2">
                            <div class="col">
                                <div class="form-group">
                                    <label for="profile_pic">Profile Image</label>
                                    <input type="file" name="profile_pic" id="profile_pic" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr class="col-4 mb-4 mt-4 ml-0">
                        <div class="form-row pt-3">
                            <div class="col">
                                <label for="first_name">First Name</label>
                                <input type="text" tabindex="1" name="first_name" placeholder="First Name" value="<?php echo $user_row["first_name"]; ?>" class="form-control">
                            </div>
                            <div class="col">
                                <label for="last_name">Last Name</label>
                                <input type="text" tabindex="2" name="last_name" placeholder="Last Name" value="<?php echo $user_row["last_name"]; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-row pt-3 mb-2">
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="text" tabindex="7" name="email" placeholder="Email" value="<?php echo $user_row["email"]; ?>" class="form-control">
                            </div>
                        </div>
                        <hr class="col-4 mb-4 mt-5 ml-0">
                        <div class="form-row pt-3">
                            <div class="col">
                                <label for="address">Address</label>
                                <input type="text" tabindex="3" name="address" placeholder="Address" value="<?php echo $user_row["address"]; ?>" class="form-control">
                            </div>
                            <div class="col">
                                <label for="address2">Address Line 2</label>
                                <input type="text" tabindex="4" name="address2" placeholder="Address Line 2" value="<?php echo $user_row["address2"]; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-row pt-3">
                            <div class="col">
                                <label for="city">City</label>
                                <input type="text" tabindex="5" name="city" placeholder="City" value="<?php echo $user_row["city"]; ?>" class="form-control">
                            </div>
                            <div class="col">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" tabindex="6" name="postal_code" placeholder="Postal Code" value="<?php echo $user_row["postal_code"]; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-row pt-3">
                            <div class="col">
                                <label for="province_id">Province</label>
                                <select name="province_id" class="form-control">
                                    <?php
                                            $province_query = "SELECT * FROM provinces";
                                            if ($province_results = mysqli_query($conn, $province_query)) :
                                                echo "<option disabled ";
                                                if (!$user_row["province_id"]) echo "selected";
                                                echo ">Province</option>";
                                                while ($province = mysqli_fetch_array($province_results)) :
                                                    ?>
                                            <option value="<?= $province["id"]; ?>" <?php
                                                                                                    if ($province["id"] == $user_row["province_id"]) echo " selected";
                                                                                                    ?>><?= $province["name"]; ?></option>
                                    <?php
                                                endwhile;
                                            else :
                                                echo mysqli_error($conn);
                                            endif;
                                            ?>

                                </select>
                            </div>
                        </div>
                        <hr class="mt-5">
                        <div class="form-row">
                            <?php
                                    if ($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1) :
                                        ?>
                                <div class="col pt-3">
                                    <a href="/reset_password.php" class="btn sm-btn">Change Password</a>
                                </div>
                                <div class="col text-right pt-3 pb-5 mb-5">
                                    <button type="submit" name="action" value="delete" class="btn btn-text text-danger">Delete Account</button>
                                    <button type="submit" tabindex="8" name="action" value="update" class="btn btn-secondary">Update Account</button>
                                </div>
                            <?php
                                    endif;
                                    ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    endwhile;
else :
    echo mysqli_error($conn);
endif;

require_once("footer.php"); ?>