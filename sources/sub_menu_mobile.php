<div class="visible-xs subMenuMobile" id="dropdown2">
    <div class="btn-group bootstrap-select 2">
        <select class="selectpicker2" data-style="btn-info" onchange="window.location = this.value;" tabindex="-98">
            <?php
                foreach ($danhmuc as $val){
                    $layidkx = LAYDANHSACH_idkietxuat($val['id'],$slug_step);
                    $layidkx = explode(",",$layidkx);
            ?>
            <option <?=in_array($slug_id,$layidkx) ? "selected" : ""?> value="<?= fullSeoName($val) ?>"><?= $val['tenbaiviet_' . $lang] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="title_news">
        <h5><?=$glo_lang['nhom_san_pham']?></h5>
    </div>
    <div class="btn-group bootstrap-select 2">
        <select class="selectpicker2" data-style="btn-info" onchange="window.location = this.value;" tabindex="-98">
            <?php
            if ($slug_table != "step") {
                if ($arr_running['id_parent'] == 0) {
                    $dmsp = LAY_danhmuc($slug_step, "", "`id_parent` = $slug_id");
                } else {
                    $dmsp = LAY_danhmuc($slug_step, "", "`id` = " . $arr_running['id_parent']);
                }
                foreach ($dmsp as $rows) {
                    $id = $rows['id'];
                    $id_parent = $rows['id_parent'];
                    if ($arr_running['id_parent'] == 0) {
                        ?>
                        <?php
                        $dmsp2 = LAY_danhmuc($slug_step, "", "`id` = " . $id, "`catasort` ASC,`id` DESC");
                        foreach ($dmsp2 as $rows_2) {
                            ?>
                            <optgroup label="<?= $rows_2['tenbaiviet_' . $lang] ?>">
                                <?php
                                $dmsp3 = LAY_danhmuc($slug_step, "", "`id_parent` = " . $rows_2['id'], "`catasort` ASC,`id` DESC");
                                foreach ($dmsp3 as $rows_3) {
                                    ?>
                                    <option <?=$slug_id == $rows_3['id'] ? "selected" : ""?> value="<?= fullSeoName($rows_3) ?>"><?= $rows_3['tenbaiviet_' . $lang] ?></option>
                                <?php } ?>
                            </optgroup>
                        <?php } ?>
                    <?php } else {
                        if ($id_parent != 0) {
                            $dmsp = LAY_danhmuc($slug_step, "", "`id` = $id_parent ", "`catasort` ASC,`id` DESC");
                        }
                        foreach ($dmsp as $rows) {
                            ?>
                            <?php
                            $dmsp2 = LAY_danhmuc($slug_step, "", "`id_parent` = " . $rows['id'], "`catasort` ASC,`id` DESC");
                            foreach ($dmsp2 as $rows_2) {
                                ?>
                                <optgroup label="<?= $rows_2['tenbaiviet_' . $lang] ?>">
                                    <?php
                                    $dmsp3 = LAY_danhmuc($slug_step, "", "`id_parent` = " . $rows_2['id'], "`catasort` ASC,`id` DESC");
                                    foreach ($dmsp3 as $rows_3) {
                                        ?>
                                        <option <?=$slug_id == $rows_3['id'] ? "selected" : ""?> value="<?= fullSeoName($rows_3) ?>"><?= $rows_3['tenbaiviet_' . $lang] ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        <?php } ?>
                    <?php }
                } ?>
            <?php } ?>
        </select>
    </div>
</div>
