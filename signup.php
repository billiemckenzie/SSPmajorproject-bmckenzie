<?php
require_once("header.php");
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12 mb-5 pb-5">
            <h2 class="pt-5 mt-5">Sign up for your free account!</h2>
            <hr class="col-8 ml-0 mt-5 mb-5">
            <p class="col-6">Whether you are a designer, or are in need of designs - oneDesign will help connect you to a global graphic design network. Get started today to get inspired, and inspire others.</p>
        </div>
        <form action="/actions/login.php" class="col-12" method="post">
            <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                </div>
                <div class="form-group col-md-4">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-8">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com">
                </div>
            </div>
            <div class="form-row mb-5">
                <div class="form-group col-md-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group col-md-4">
                    <label for="password2">Confirm Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                </div>
            </div>
            <hr class="col-8 ml-0">
            <p>Additional Information (optional):</p>
            <div class="form-group col-md-8 pl-0">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
            </div>
            <div class="form-group col-md-8 pl-0">
                <label for="address2">Address 2</label>
                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="inputCity">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Province</label>
                    <select id="province" name="province" class="form-control">
                        <option selected disabled>[ Choose 1 ]</option>
                        <?php
                        $provinces = [
                            "British Columbia",
                            "Alberta",
                            "Saskatchewan",
                            "Manitoba",
                            "Ontario",
                            "Quebec",
                            "New Brunswick",
                            "Nova Scotia",
                            "Prince Edward Island",
                            "Nunavit",
                            "Labrador",
                            "Yukon",
                            "North West Territories"
                        ];
                        for ($i = 0; $i < count($provinces); $i++) {
                            echo "<option value='" . ($i + 1) . "'>$provinces[$i]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-2 mb-5 pl-0">
                <label for="postal_code">Postal Code</label>
                <input type="text" class="form-control" id="postal_code">
            </div>
            <div class="form-group mt-3 mb-4">
                <div class="form-check">
                    <input class="form-check-input" name="human_check" type="checkbox" id="human_check">
                    <label class="form-check-label" for="human_check">
                        Are you a human?
                    </label>
                </div>
            </div>
            <div class="form-group">
                Are you a designer, or do you need to hire a designer?
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rolecheck" id="rolecheck2" value="2" checked>
                    <label class="form-check-label" for="rolecheck2">
                        I am a Designer!
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rolecheck" id="rolecheck3" value="3">
                    <label class="form-check-label" for="rolecheck3">
                        I Need Designs!
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary dark-btn mb-5 mt-3" name="action" value="signup">Sign Up</button>
        </form>
        <hr class="line">
    </div>
    <div>
        <p>Already have an account?</p>
    </div>
    <div class="mb-5">
        <button class="btn btn-secondary dark-btn mb-5"> <a href="/index.php">Log in</a></button>
    </div>
</div>



<?php
require_once("footer.php");
?>