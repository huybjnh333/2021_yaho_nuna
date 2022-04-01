<?php
$mangxahoi = SHOW_mxh();
foreach ($mangxahoi as $rows) {
    if ($thongtin['mxh_is_anh'] == 1) {
        ?>
        <a target="_blank" <?= full_href($rows) ?> class="button <?= $rows['fontawesome'] ?> "
           style="<?= $rows['background'] != '' ? 'background: ' . $rows['background'] : '' ?>">
            <span><?= $rows['tenbaiviet_' . $lang] ?></span>
            <img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin']) ?>" alt="">
        </a>
    <?php } else { ?>
        <li><a target="_blank" style="<?= $rows['background'] != '' ? 'background: ' . $rows['background'] : '' ?>"
                <?= full_href($rows) ?>><i class="<?= $rows['fontawesome'] ?>"></i></a></li>
    <?php }
} ?>
