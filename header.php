<?php
require_once("conn.php");
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/css/styles.css">
  <script src="https://kit.fontawesome.com/f2e175deda.js" crossorigin="anonymous"></script>

  <title>SSP Major Project-Billie McKenzie</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/index.php"><img class="small-img" src="/images/1design_white@2x.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-0 ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>">Home</a>
          </li>
          <?php
          if (isset($_SESSION["user_id"])) : //check if user is logged in
            ?>
            <li class="nav-item">
              <a href="/members.php" class="nav-link">Browse Profiles</a>
            </li>
            <li class="nav-item">
              <a href="/articles.php" class="nav-link">Browse Designs</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Profile
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/profile.php">View Profile</a>
                <a class="dropdown-item" href="/add_post.php">Add to Portfolio</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/actions/login.php?action=logout">Log Out</a>
              </div>
            </li>
          <?php
          else : //if user is not logged in
            ?>
            <li class="nav-item">
              <a class="nav-link" href="/signup.php">Sign Up</a>
            </li>
          <?php
          endif;
          ?>
        </ul>
      </div>
    </div>
  </nav>