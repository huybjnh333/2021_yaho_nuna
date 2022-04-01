<!--<div class="form-group" style="display: none;">
    <label>Tags</label>
    <?= LAY_tag_multi(@$id_tag_multi, $step, 'id_tag_multi[]', ' form-control SlectBoxNew', 0, 0, 'false', "multiple='multiple'") ?>
</div>

<?php
function LAY_tag_multi($val, $step = 0, $name = '', $class = '', $kieu = 0,  $id_ht = 0, $chude = 'true', $muti = ''){
    if($kieu == 0)
    {
        $val 		= @explode(",", $val);
        $chude_arr  = DB_fet("*","#_du_lieu_sn", "", "`catasort` ASC","", "arr");
        $select 	= '<select name="'.$name.'" class="'.$class.'" '.$muti.'>
	            						';
        foreach ($chude_arr as $row_1)
        {
//            if($row_1['id_parent'] != 0) continue;
            $check_dis 			= "";
            $check_dis_trung 	= "";
            if($id_ht == $row_1['id'] && $chude == 'true') $check_dis_trung = 'disabled="disabled"';
            $select 		   .= '<option '.$check_dis.$check_dis_trung.' '.(in_array($row_1['id'], $val) ? 'selected="selected"':'').'  value="'.$row_1['id'].'">'.$row_1['tenbaiviet_vi'].'</option> ';
        }
        $select .= '</select>';
        return $select;
    }
    else
    {
        $sql_cap 	= DB_que("SELECT `tenbaiviet_vi` FROM `#_du_lieu_sn` WHERE `id` = ".$val." LIMIT 1");
        $sql_cap 	= DB_arr($sql_cap, 1);
        return $sql_cap['tenbaiviet_vi'];
    }
}
?>-->