<div class="page_conten page_conten_cart">
    <div class="pagewrap">
        <div class="title_page_home">
            <h3><?= $glo_lang['danh_sach_so_sanh'] ?></h3>

            <div class="clr"></div>
        </div>
        <div class="dv-danhsach-ss">
            <?php
            if (empty($_COOKIE['sp_sosanh']) || $_COOKIE['sp_sosanh'] == '') {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                $sp_baiviet = LAY_baiviet(2, 0, "`id` IN (" . $_COOKIE['sp_sosanh'] . ")");
                ?>
                <div class="dv-table-rps dv-class-sosanh">
                    <div class="dv-class-sosanh-cont">
                        <table>
                            <tr class="tr_img">
                                <?php foreach ($sp_baiviet as $rows) { ?>
                                    <td class="td_js_load_<?= $rows['id'] ?>">
                                        <?= full_img($rows) ?>
                                        <a class="a_xoa_sp_ss cur"
                                           onclick="load_sosanh(<?= $rows['id'] ?>); $('.td_js_load_<?= $rows['id'] ?>').remove()">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr class="tr_name">
                                <?php foreach ($sp_baiviet as $rows) { ?>
                                    <td class="td_js_load_<?= $rows['id'] ?>">
                                        <a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a>
                                        <?php if ($rows['p1'] != "") { ?>
                                            <p><?= $glo_lang['cart_ma_sp'] ?>: <?= $rows['p1'] ?></p>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr class="tr_price">
                                <?php
                                foreach ($sp_baiviet as $rows) {
                                    $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '', '');
                                    ?>
                                    <td class="td_js_load_<?= $rows['id'] ?>">
                                        <h4><?= $gia['text_gia'] . $gia['text_km'] ?></h4>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr class="tr_mta">
                                <?php foreach ($sp_baiviet as $rows) { ?>
                                    <td class="td_js_load_<?= $rows['id'] ?>">
                                        <div class="showText">
                                            <?= SHOW_text($rows['mota_' . $lang]); ?>
                                            <div class="clr"></div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr class="tr_ndung">
                                <?php foreach ($sp_baiviet as $rows) { ?>
                                    <td class="td_js_load_<?= $rows['id'] ?>">
                                        <div class="showText">
                                            <?= SHOW_text($rows['noidung_' . $lang]); ?>
                                            <div class="clr"></div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>