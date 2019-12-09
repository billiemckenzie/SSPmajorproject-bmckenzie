<?php
require_once("header.php");
?>


<div class="container pt-5 mt-5">
    <h1><strong>Drill 3</strong></h1>
    <hr class="pt-5 pb-3">
<?php
    //super simple plain method:
    //for ($i = 1; $i <= 100; $i++){
        //echo $i;
        
        //if ($i % 3 == 0) {
        //echo "PING";
        //} if ($i % 7 ==0) {
        //    echo "PONG";
        //}
        //echo " <br>";
    //}
?>

    <!-- or for colour coding and styling : -->
        <p style="line-height-1:1; font-size:12px; columns:4;">
    <?php
    for($i=0; $i <= 100; $i++) {
        $color = 0;
        $output = $i . ": ";
        if($i % 3 == 0){
            $color += 1;
            $output .= "Ping";
        } if ($i % 7 == 0) {
            $color += 2;
            $output .= "Pong";
        }
        $output .= "<br>";

        $append = "";
        switch($color) {
            case 1:
                $append = "<span class='text-danger'>";
            break;
            case 2:
                $append = "<span class='text-warning'>";
            break;
            case 3:
                $append = "<span class='text-success'>";
            break;
            default:
                $append = "<span>";
            break;
        }

        echo $append . $output . "</span>";
    }
    ?> 
    </p>

    <hr class="mt-5 mb-5">

    <?php
    
    $cars = ["Ford", "Toyota", "Tesla", "Audi"];
    
    foreach( $cars as $car){
        echo $car . "<br>";
        
        switch ($car) {
            case "Ford":
                echo "Acc: 0-60 8s";
            break;
            case "Tesla":
                echo "Acc: 0-60 1.4s";
            break;
            case "Audi":
                echo "Acc: 0-60 4.4s";
            break;
            default:
                echo "unknown";
            break;
        }
        echo "<hr>";
    }

    ?>

</div>
