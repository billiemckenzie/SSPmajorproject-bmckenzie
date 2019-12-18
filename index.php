<?php
require_once("header.php");
?>
<?php

if (isset($_SESSION["user_id"])) :
  $user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : $_SESSION["user_id"];
  $user_query = "SELECT * FROM users WHERE id = " . $user_id;

  if ($user_request = mysqli_query($conn, $user_query)) :
    while ($user_row = mysqli_fetch_array($user_request)) :
      echo "<div class='col-12 m-auto text-left med-container pt-5'>";
      echo "<h2 class='pt-5 text-center'>Welcome Back ";
      echo $user_row["first_name"];
      echo "!</h2>";
?>

      <div class="main-container">
      <div class="text-center">
        <p class="mb-5">What would you like to do today?</p>
        <hr class="sm-line">

        <div class="row m-5">
          <div class="col-md-3 m-4 text-center">
            <h1><a href="/profile.php" class="big-icons"><i class="fas fa-desktop"></i></a></h1>
            <p class="pt-3">View your profile</p>
          </div>
          <div class="col-md-3 m-4 text-center">
            <h1><a href="/edit_profile.php" class="big-icons"><i class="fas fa-pencil-alt"></i></a></h1>
            <p class="pt-3">Edit profile</p>
          </div>
          <div class="col-md-3 m-4 text-center">
            <h1><a href="/add_post.php" class="big-icons"><i class="fas fa-paint-brush"></i></a></h1>
            <p class="pt-3">Add new Design</p>
          </div>
        </div>
        <hr>
        <div class="row m-5">
          <div class="col-md-3 m-4 text-center">
            <h1><a href="/members.php" class="big-icons"><i class="fas fa-users"></i></a></h1>
            <p>Browse Designer Profiles</p>
          </div>
          <div class="col-md-3 m-4 text-center">
            <h1><a href="/articles.php" class="big-icons"><i class="fas fa-palette"></i></a></h1>
            <p>Browse Designs</p>
          </div>
        </div>
      </div>
      <div class="pt-5 mt-5 text-right">
        <form action="/actions/login.php" method="post">
          <button type="submit" name="action" value="logout" class="btn btn-outline-secondary dark-btn mb-5">Log Out</button>
        </form>
      </div>
      </div>
  <?php
      echo "</div>";
    endwhile;
  endif;
else :
  ?>

  <div class="hero-banner">
    <div class="col sm-container m-auto pt-5">
      <h1 class="text-center text-white header-text">Get a <strong>custom design</strong> you’ll love with our global creative network</h1>
    </div>
    <div class="col pt-5 text-center">
      <button class="btn btn-secondary dark-btn"> <a href="/signup.php">Create an account to get started</a></button>
    </div>
    <hr class="white-line">
    <div class="sm-container m-auto">
      <div class="row">
        <form action="/actions/login.php" method="post" class="col">
          <h4 class="pt-5 pb-3">Or, log in if you already have an account:</h4>
          <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); ?>
          <div class="form-group">
            <input type="email" name="email" placeholder="Email Address" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control">
          </div>
          <div class="form-group">
            <p>
              <button type="submit" name="action" value="login" class="btn btn-secondary dark-btn">Login</button>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container mb-5 pb-5">
    <div class="container pt-5 mt-5 mb-5">
      <h5 class="text-center mb-5 pb-5">HOW IT WORKS</h5>
    </div>
    <div class="container" id="tabs">
      <nav class="tabNavigation text-center mb-5">
        <a href="#tab1" class="tabClicker btn btn-text active">1. Browse</a>
        <a href="#tab2" class="tabClicker btn btn-text">2. Collaborate</a>
        <a href="#tab3" class="tabClicker btn btn-text">3. Choose Design!</a>
      </nav>
      <div class="tabContainer p-5 m-auto">
        <div id="tab1" class="tab active">
          <div class="row ml-5">
            <div>
              <img src="/images/ideas.jpg" class="med-img">
            </div>
            <div class="col-md-6 ml-5">
              <h3 class="text-left">Browse Designer Profiles</h3>
              <hr class="dark-line">
              <p class="text-left">Browse through graphic designer profiles and start to refine your ideas, and see what inspires you.</p>
            </div>
          </div>
        </div>
        <div id="tab2" class="tab">
          <div class="row ml-5">
            <div class="ml-5">
              <img src="/images/logosketch.jpg" class="med-img">
            </div>
            <div class="col-md-6 ml-5">
              <h3 class="text-left">Collaborate</h3>
              <hr class="dark-line">
              <p class="text-left">Start by creating a simple brief to help designers understand your project and ideas. This can help you find the right designer that matches you style.</p>
            </div>
          </div>
        </div>
        <div id="tab3" class="tab">
          <div class="row ml-5">
            <div class="ml-5">
              <img src="/images/success.jpeg" class="med-img">
            </div>
            <div class="col-md-5 ml-1">
              <h3 class="text-left">Choose a Designer!</h3>
              <hr class="dark-line">
              <p class="text-left">Once you find the right designer for your project, choose your artist and have them bring your ideas to life!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr class="line">
  <div class="container pt-5 mt-5 mb-5 pb-5 text-center">
    <h5 class="text-center mb-5">SIGN UP NOW TO START BROWSING</h5>
    <button class="btn btn-secondary dark-btn mb-5"> <a href="signup.php">SIGN UP</a></button>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function() {

      $('.tabClicker').click(function() {
        var tab = $(this).attr("href");

        $(this).addClass("active").siblings().removeClass('active');

        $(tab)
          .show(500)
          .addClass("active")
          .siblings()
          .hide(500)
          .removeClass('active');

      });
    });
  </script>

<?php
endif;
?>

<?php

require_once("footer.php");
echo mysqli_error($conn);

?>