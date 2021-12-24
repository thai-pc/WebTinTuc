<nav class="slides">
    <?php
        $sql = "SELECT `image_adv`,`url` FROM adv WHERE id_page = 1 AND id_position = 10 LIMIT 3";
        $sildes = executeResult($sql);
        $l = count($sildes);
    ?>
    <?php for($i = 0; $i < $l ; $i++ ) { ?>
        <div class="slide fade"> 
            <a href="<?php echo ''.$sildes[$i]['url'].''?>" target="_blank">
                <img src="<?php echo ''.$sildes[$i]['image_adv'].''?>" alt="" class="fisrt" />
            </a>
        </div>
    <?php }?>
    <div class="lr-main">
        <i class="fas fa-chevron-left pre" onclick="plusSlides(-1)"></i>
        <i class="fas fa-chevron-right next" onclick="plusSlides(1)"></i>
    </div>
    <div class="dotsbox" style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</nav>