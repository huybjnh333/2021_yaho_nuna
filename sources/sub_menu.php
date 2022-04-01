<div class="col-lg-3 col-md-4 subMenu subMenuDesktop">
    <!-- start submenu normal -->
    <div class="panel-group hidden-xs" id="accordion">
        <!-- one product subgroup / expandable -->
        <?php
        if($slug_table != "step"){
        if ($arr_running['id_parent'] == 0) {
            $dmsp = LAY_danhmuc($slug_step, "", "`id_parent` = $slug_id");
        } else {
            $dmsp = LAY_danhmuc($slug_step, "", "`id` = " . $arr_running['id_parent']);
        }
        foreach ($dmsp as $rows) {
            $id = $rows['id'];
            $id_parent = $rows['id_parent'];
            if ($arr_running['id_parent'] == 0) {
                $dmsp2 = LAY_danhmuc($slug_step, "", "`id` = " . $id, "`catasort` ASC,`id` DESC");
                foreach ($dmsp2 as $rows_2) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title" style="color: rgb(0, 0, 0);">
                                <?= $rows_2['tenbaiviet_' . $lang] ?>
                            </h4>
                        </div>
                        <div id="collapse0" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    <?php
                                    $dmsp3 = LAY_danhmuc($slug_step, "", "`id_parent` = " . $rows_2['id'], "`catasort` ASC,`id` DESC");
                                    foreach ($dmsp3 as $rows_3) {
                                        ?>
                                        <tr>
                                            <td class="<?= $slug_id == $rows_3['id'] ? "activeCell" : "" ?>">
                                                <a <?= full_href($rows_3) ?>><?= $rows_3['tenbaiviet_' . $lang] ?></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                if($id_parent != 0) {
                    $dmsp = LAY_danhmuc($slug_step, "", "`id` = $id_parent ", "`catasort` ASC,`id` DESC");
                }
                foreach ($dmsp as $rows) {
                    $dmsp2 = LAY_danhmuc($slug_step, "", "`id_parent` = " . $rows['id'], "`catasort` ASC,`id` DESC" );
                    foreach ($dmsp2 as $rows_2) {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title" style="color: rgb(0, 0, 0);">
                                    <?= $rows_2['tenbaiviet_' . $lang] ?>
                                </h4>
                            </div>
                            <div id="collapse0" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                        $dmsp3 = LAY_danhmuc($slug_step, "", "`id_parent` = " . $rows_2['id'], "`catasort` ASC,`id` DESC");
                                        foreach ($dmsp3 as $rows_3) {
                                            ?>
                                            <tr>
                                                <td class="<?= $slug_id == $rows_3['id'] ? "activeCell" : "" ?>">
                                                    <a <?= full_href($rows_3) ?>><?= $rows_3['tenbaiviet_' . $lang] ?></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            <?php }
        } ?>
        <?php } ?>
    </div>
    <!-- end submenu -->
</div>