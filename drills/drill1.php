<?php
require_once("header.php");

$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = " SELECT users.*, provinces.name AS province_name
                FROM users 
                LEFT JOIN provinces
                ON users.province_id = provinces.id";
?>
<div class="container mt-5 pt-5">
  
    <h1><strong>SSP Drill 1</strong></h1>
    
<?php
if ($user_request = mysqli_query($conn, $user_query)) :
    while ($user_row = mysqli_fetch_array($user_request)) :
?>
        <ul>
            <li><u><?php echo $user_row["first_name"] . " " . $user_row["last_name"];?></u> lives in <u><?= $user_row["city"]?></u> and started on <u><?= date("l" , strtotime($user_row["date_created"]));?></u> of <u><?= date("F" , strtotime($user_row["date_created"]));?></u> in <u><?= date("Y" , strtotime($user_row["date_created"]));?></u></li>
        </ul>
<?php
    endwhile;
else :
    echo mysqli_error($conn);
endif;
 ?>

</div>