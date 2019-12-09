<?php
require_once("header.php");

//print_r($_SESSION);

?>

<div class="hero-banner">
  <div class="col sm-container m-auto pt-5">
    <h1 class="text-center text-white header-text">Get a <strong>custom design</strong> you’ll love with our global creative network</h1>
  </div>
  <div class="col pt-5 text-center">
    <button class="btn btn-secondary dark-btn"> <a href="signup.php">Create an account to get started</a></button>
  </div>
  <hr class="white-line">
  <div class="container">
    <div class="row">
      <?php
      echo "<div class='col-12 m-auto
         text-left sm-container pt-5'>";
      if (isset($_SESSION["user_id"])) :
        $user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : $_SESSION["user_id"];
        $user_query = "SELECT * FROM users WHERE id = " . $user_id;

        if ($user_request = mysqli_query($conn, $user_query)) :
          while ($user_row = mysqli_fetch_array($user_request)) :
            echo "<h2 class='pt-5'>Welcome Back ";
            echo $user_row["first_name"];
            echo "!</h2>";
            ?>
            <form action="/actions/login.php" method="post">
              <button type="submit" name="action" value="logout" class="btn btn-outline-secondary dark-btn">Log Out</button>
            </form>
        <?php
            endwhile;
          endif;
        else :
          ?>
        <form action="/actions/login.php" method="post" class="col">
          <h4 class="pt-5 pb-3">Or, log in if you already have an account:</h4>
          <?php include($_SERVER["DOCUMENT_ROOT" . "/includes/error_check.php"]); ?>
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
      <?php
      endif;
      echo "</div>";
      ?>
    </div>
  </div>
</div>

<div class="container mb-5 pb-5">
  <div class="container pt-5 mt-5 mb-5">
    <h2 class="text-center mb-5 pb-5">HOW IT WORKS</h2>
  </div>
  <div class="container" id="tabs">
    <nav class="tabNavigation text-center">
      <a href="#tab1" class="tabClicker btn btn-text active">1. Brief</a>
      <a href="#tab2" class="tabClicker btn btn-text">2. Collaborate</a>
      <a href="#tab3" class="tabClicker btn btn-text">3. Choose Design!</a>
    </nav>
    <div class="tabContainer row p-5">
      <div id="tab1" class="row tab active">
        <div class="col-md-3">
          <img src="/images/logosketch.jpg" class="med-img">
        </div>
        <div class="col-md-6">
          <h3 class="text-left">Tell us your logo idea</h3>
          <hr class="dark-line">
          <p class="text-left">start by creating a simple brief to help designers understand your designs. This can help us connect you with the right designer that matches you style.</p>
        </div>
      </div>
      <div id="tab2" class="tab">
        <h3 class="col-6 text-left">Phone</h3>
        <p class="col-6 text-left">(250)555-7748</p>
      </div>
      <div id="tab3" class="tab">
        <h3 class="col-6 text-left">Location</h3>
        <p class="col-6 text-right">555 Coronation Avenue - Kelowna, BC - V1V 2Y3</p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    $('.tabClicker').click(function(){
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

require_once("footer.php");
echo mysqli_error($conn);

?>