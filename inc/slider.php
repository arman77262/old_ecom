<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">

            <?php
            $iphone = $pd->getIphone();
            if ($iphone) {
                while ($irow = mysqli_fetch_assoc($iphone)) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="preview.php?proid=<?= $irow['productId'] ?>"> <img src="admin/<?= $irow['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Iphone</h2>
                            <p><?= $irow['productName'] ?></p>
                            <div class="button"><span><a href="preview.php?proid=<?= $irow['productId'] ?>"">Add to cart</a></span></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $samsung = $pd->getSamsung();
            if ($samsung) {
                while ($srow = mysqli_fetch_assoc($samsung)) {
            ?>
                <div class=" listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                        <a href="preview.php?proid=<?= $srow['productId'] ?>"><img src="admin/<?=$srow['image']?>" alt="" /></a>
                    </div>
                    <div class="text list_2_of_1">
                        <h2>Samsung</h2>
                        <p><?=$srow['productName']?></p>
                        <div class="button"><span><a href="preview.php?proid=<?= $srow['productId'] ?>">Add to cart</a></span>
                    </div>
                </div>
                    <?php
                }
            }
                    ?>


            </div>
        </div>

         <div class="section group">

        <?php 
            $acer = $pd->getAcer();
            if ($acer) {
                while ($arow = mysqli_fetch_assoc($acer)) {
                    ?>
                   
                        <div class="listview_1_of_2 images_1_of_2">
                            <div class="listimg listimg_2_of_1">
                                <a href="href="preview.php?proid=<?= $arow['productId'] ?>"> <img src="admin/<?=$arow['image']?>" alt="" /></a>
                            </div>
                            <div class="text list_2_of_1">
                                <h2>Acer</h2>
                                <p><?=$arow['productName']?></p>
                                <div class="button"><span><a href="preview.php?proid=<?= $arow['productId'] ?>">Add to cart</a></span></div>
                            </div>
                    </div>
                    <?php
                }
            }
        ?>
        
        <?php 
            $canon = $pd->getCanon();
            if ($canon) {
                while ($crow = mysqli_fetch_assoc($canon)) {
                    ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="preview.php?proid=<?= $crow['productId'] ?>"><img src="admin/<?=$crow['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Canon</h2>
                    <p><?=$crow['productName']?></p>
                    <div class="button"><span><a href="preview.php?proid=<?= $crow['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
                    <?php
                }
            }
        ?>
            


        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="header_bottom_right_images">
                        <!-- FlexSlider -->

                        <section class="slider">
                            <div class="flexslider">
                                <ul class="slides">
                                    <li><img src="images/1.jpg" alt="" /></li>
                                    <li><img src="images/2.jpg" alt="" /></li>
                                    <li><img src="images/3.jpg" alt="" /></li>
                                    <li><img src="images/4.jpg" alt="" /></li>
                                </ul>
                            </div>
                        </section>
                        <!-- FlexSlider -->
                    </div>
                    <div class="clear"></div>
        </div>