<div class="banner_detail" style="background-image: url('delete/banner/little-son.jpg');">
    <div class="link_page">
        <h2>Tiện ích</h2>
        <div class="pagewrap">
            <ul>
                <li><a href="index.php"><i class="fa fa-home"></i>Trang chủ</a> | <span class="active">Tiện ích</span></li></ul>
            <div class="clr"></div>
        </div>
    </div>
</div>
<div class="page_conten_page">
    <?php include _source."menu_right.php";?>
    <div class="pagewrap">
        <?php
            $dudoan_ngaysinh = DB_fet("`tenbaiviet_$lang`,`mota_$lang`,`seo_name`", "#_baiviet", "`showhi` = 1 and `p2` = 1 and step = 10", "", 1,1);
            if(!empty($dudoan_ngaysinh)){
                $dudoan_ngaysinh = reset($dudoan_ngaysinh);
        ?>
        <section class="dv-tienich">
            <ul>
                <li>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="title_home align_left wow flipInX">
                                <h2 class="tiltle" style="color: #e44b3a;"><?=$dudoan_ngaysinh['tenbaiviet_'.$lang]?></h2>
                            </div>
                            <p><?=$dudoan_ngaysinh['mota_'.$lang]?></p>
                            <p class="read-more">
                                <a <?=full_href($dudoan_ngaysinh)?>><?=$glo_lang['xem_them']?></a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="sp-pre">
                                <div class="sp-pre1">
                                    <div class="due-date-calc-section">
                                        <?php include _source."tinh_ngay_du_sinh.php";?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </li>
                <div class="clr"></div>
            </ul>
            <div class="clr"></div>
        </section>
        <?php } ?>
        <?php
        $datten_chobe = DB_fet("`tenbaiviet_$lang`,`p3_$lang`,`seo_name`", "#_step", "`showhi` = 1 and `id` = 11", "", 1,1);
        if(!empty($datten_chobe)){
        $datten_chobe = reset($datten_chobe);
        ?>
        <section class="dv-tienich dv-tienich1">
            <ul>
                <li>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="title_home align_left wow flipInX">
                                <h2 class="tiltle" style="color: #f57f20;"><?=$datten_chobe['tenbaiviet_'.$lang]?></h2>
                            </div>
                            <p><?=$datten_chobe['p3_'.$lang]?></p>
                            <p class="read-more">
                                <a <?=full_href($datten_chobe)?>><?=$glo_lang['xem_them']?></a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="sp-pre">
                                <div class="sp-pre1">
                                    <div class="due-date-calc-section">
                                        <?php include _source."dat_ten_cho_be.php";?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </li>
                <div class="clr"></div>
            </ul>
            <div class="clr"></div>
        </section>
        <?php } ?>
        <?php
        $do_cannang = DB_fet("`tenbaiviet_$lang`,`p3_$lang`,`seo_name`", "#_step", "`showhi` = 1 and `id` = 12", "", 1,1);
        if(!empty($do_cannang)){
        $do_cannang = reset($do_cannang);
        ?>
        <section class="dv-tienich dv-tienich2">
            <ul>
                <li>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="title_home align_left wow flipInX">
                                <h2 class="tiltle" style="color: #c80e00;"><?=$do_cannang['tenbaiviet_'.$lang]?></h2>
                            </div>
                            <p><?=$do_cannang['p3_'.$lang]?></p>
                            <p class="read-more">
                                <a <?=full_href($do_cannang)?>><?=$glo_lang['xem_them']?></a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <?php include _source."do_can_nang_va_chieu_cao.php";?>
                        </div>
                        <div class="clr"></div>
                    </div>
                </li>
                <div class="clr"></div>
            </ul>
            <div class="clr"></div>
        </section>
        <?php } ?>
    </div>
    <div class="clr"></div>
</div>