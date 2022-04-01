<div class="dv-ul-menu dv-ul-menu-child-on <?= $motty != "" ? "dv-ul-menu-child" : "" ?>">
    <ul class="sub-1">
        <?php
        $danhmuc = LAY_danhmuc(2);
        foreach ($danhmuc as $dm) {
            if ($dm['id_parent'] != 0) continue;
            ?>
            <li class="vertical-menu-item">
                <a <?= full_href($dm) ?>><i class="fa fa-th-large"></i>
                    <h2><?= SHOW_text($dm['tenbaiviet_' . $lang]) ?></h2></a>
            </li>
        <?php } ?>
    </ul>
</div>