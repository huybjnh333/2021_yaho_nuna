<div class="tin_left">
    <div class="title_news">
        <h2><?= $title_khac ?></h2>
    </div>
    <?php
    if ($nd_total == 0) {
        echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
    } else {
    ?>
    <div class="resultTable babynameFav">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="20%"><?= $glo_lang['ten'] ?></th>
                <th width="20%"><?= $glo_lang['gioi_tinh'] ?></th>
                <th width="60%"><?= $glo_lang['y_nghia'] ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($nd_kietxuat as $rows) {
                $icon_gt = '<img src="delete/tienich/icon1.png">';
                if ($rows['gioitinh'] == 1) $icon_gt = '<img src="delete/tienich/icon2.png">';
                else if ($rows['gioitinh'] == 2) $icon_gt = '<img src="delete/tienich/icon3.png">';
                else if ($rows['gioitinh'] == 3) $icon_gt = '<img src="delete/tienich/icon1.png"><img src="delete/tienich/icon2.png">';
                ?>
                <tr>
                    <td class="<?= $class_gt ?>"><?= $rows['tenbaiviet_' . $lang] ?></td>
                    <td><?= $icon_gt ?></td>
                    <td><?= strip_tags($rows['mota_' . $lang]) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="clr"></div>
    </div>
    <div class="nums no_box">
        <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <?php } ?>
</div>