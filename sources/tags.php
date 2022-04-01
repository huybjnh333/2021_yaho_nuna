<?php
$lay_tag = DB_fet_rd("*", "`#_du_lieu_sn`", "", "`catasort` ASC, `id` DESC", "", "id", "`id` IN (" . $arr_running['id_tag_multi'] . ")");
if (!empty($lay_tag)) {
    ?>
    <div class="fl-post-meta fl-post-meta-bottom">
        <div class="fl-post-cats-tags">
            <i class="fa fa-tags"></i>
            <?php foreach ($lay_tag as $t) { ?>
                <a <?= full_href($t) ?> rel="tag"
                   target="<?= $t['blank'] ?>"><?= $t['tenbaiviet_' . $lang] ?></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>