<div class="box_menu_f">
    <div class="box-menu-1">
        <div class="l-header">
            <div class="pagewrap">
                <div class="logo_top"><a href="<?= $full_url ?>"><img src="<?= full_src($thongtin, '') ?>"
                                                                      alt="<?= $thongtin['tenbaiviet_' . $lang] ?>"></a>
                </div>
                <div class="right_header">
                    <div class="r-a">
                        <?php
                        $cuahang = LAY_step(9, 1);
                        ?>
                        <a <?= full_href($cuahang) ?>><i
                                    class="fa fa-store"></i><?= SHOW_text($cuahang['tenbaiviet_' . $lang]) ?></a>
                        <span>|</span>
                        <?php if (!isset($_SESSION['id']) || $_SESSION['id'] == NULL){ ?>
                            <a href="<?= $full_url . "/dang-nhap" ?>"><i
                                        class="fa fa-user"></i><?= $glo_lang['dang_nhap_dang_ky'] ?></a>
                        <?php }else{ ?>
                        <a href="<?= $full_url . "/tai-khoan" ?>"><i
                                    class="fa fa-user-circle-o"></i><?= $glo_lang['tai_khoan'] ?></a>
                        <span>|</span>
                        <a href="<?= $full_url . "/thoat" ?>"><i class="fa fa-sign-out"></i><?= $glo_lang['thoat'] ?>
                            <?php } ?>
                            <span>|</span>
                            <a href="<?= $full_url . "/gio-hang" ?>"><i
                                        class="fa fa-shopping-cart"></i><?= $glo_lang['gio_hang'] ?> (<span
                                        class="is_num_cart"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>)</a>
                    </div>
                    <div class="left_header">
                        <?php include _source . "lang.php"; ?>

                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="header-search">

                        <!-- <form id="searchForm" name="search_form"> -->
                        <div class="timkiem_top no_box">
                            <div class="search">
                                <a onClick="SEARCH_timkiem('<?= $full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') "
                                   style="cursor:pointer" class="siteSearchSubmit btn-primary-action">
                                    <!-- <i class="fa fa-search" ></i> -->
                                    <div class="sprites-icons sprites-size-half sprites-search-black"></div>
                                </a>
                                <input class="siteSearchInput ui-autocomplete-input input_search input_search_enter"
                                       type="text" value="" data=".input_search_enter"
                                       data-href="<?= $full_url ?>/search/?key="
                                       placeholder="<?= $glo_lang['nhap_tu_khoa_tim_kiem'] ?>"/>
                            </div>
                        </div>
                        <!-- </form> -->
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="box_menu">
            <div>
                <?php include _source . "menu_top.php"; ?>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>
<?php $baiviet_gia = LAY_bv_gia(2); ?>
<div class="dv-popup-new no_box">
    <div class="dv-popup-new-child">
        <a class="popup-close"></a>
        <div class="dv-nd-popup"></div>
    </div>
</div>