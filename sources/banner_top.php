<?php $banner_top = LAY_banner_new("`id_parent` = 16"); ?>
<div class="bannerMain">
    <div class="banner owl-carousel owl-theme owl-custome" id="owl-banner">
        <?php
        foreach ($banner_top as $rows) {
            ?>
            <li>
                <a target="<?= $rows['blank'] ?>" <?= full_href($rows) ?>><img src="<?= full_src($rows, "") ?>"
                                                                               alt="<?= $rows['tenbaiviet_' . $lang] ?>"></a>
            </li>
        <?php } ?>
    </div>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#owl-banner").owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            nav: true,
            // animateIn: 'fadeInRight',
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
        });
    });
</script>
<!--<?php $banner_top_mobile = LAY_banner_new("`id_parent` = 41"); ?>
<div class="bannerMobile">
    <div class="banner owl-carousel owl-theme owl-custome owl-banner">
        <?php
        foreach ($banner_top_mobile as $rows) {
            ?>
            <li>
                <a target="<?= $rows['blank'] ?>" <?= full_href($rows) ?>><img src="<?= full_src($rows, "") ?>"
                                                                               alt="<?= $rows['tenbaiviet_' . $lang] ?>"></a>
            </li>
        <?php } ?>
    </div>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".owl-banner").owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            nav: true,
            // animateIn: 'fadeInRight',
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
        });
    });
</script>-->



