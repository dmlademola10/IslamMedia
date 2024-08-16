<?php
    require_once("session.php");
    require_once("user_img.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
           <?php echo ($title); ?>
        </title>
        <meta charset="UTF-8"/>
        <meta name="description" content="IslamMedia is an social media platform created just for YOU to connect and communicate with family and friends with ease."/>
        <meta name="keywords" content="IslamMedia, social, media, communicate, islam, signup"/>
        <meta name="author" content="TechWise LLC."/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" href="images/islammedia_500.png" type="image/png"/>
        <link rel="stylesheet" href="css/eidfbenvnejvnervnrej1.css"/>
    </head>
    <body onkeypress="focus_search(event)">
        <div class="header_all">
            <div class="main1">
                <img src="images/islammedia_500.png" alt="#" class="img_rounded_40">
                <h2 class="islammedia">IslamMedia</h2>
            </div>
            <div class="main2">
                <a href="home.php" <?php if(isset($active) && $active == "h") { echo("class=\"active\""); } ?>><span class="icon3 icon icon_blue"></span></a>
                <a href="islam.php" <?php if(isset($active) && $active == "i") { echo("class=\"active\""); } ?>><span class="icon4 icon icon_blue"></span></a>
                <a href="videos.php" <?php if(isset($active) && $active == "v") { echo("class=\"active\""); } ?>><span class="icon5 icon icon_blue"></span></a>
                <a href="games.php" <?php if(isset($active) && $active == "g") { echo("class=\"active\""); } ?>><span class="icon6 icon icon_blue"></span></a>
            </div>
            <div class="main3">
                <span class="icon icon7 icon_blue search_btn" onclick="show_search()"></span>
                <a href="view_user_info.php"><img src="<?php echo($user_img); ?>" alt="#" class="img_rounded_40 user_img"/></a>
                <input type="text" name="search" placeholder="Press '/' or '\' to focus." class="input2 top_search" id="top_search" oninput="search(this.value);"/>
                <div class="search_res" id="search_res"></div>
            </div>
        </div>
