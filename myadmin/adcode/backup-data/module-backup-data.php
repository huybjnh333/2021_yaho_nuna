<?php
    $table = '#_backup';

    $table_bk    = "*"; //"tb1, tb2"
    $duongdantin = "../datafiles/backup";
    $zip_file    = 1;
    if(!is_dir($duongdantin)){
        @mkdir($duongdantin,'0777');
    }
    @chmod($duongdantin, 0777);

    function lh_backupTables($tables = '*', $duongdantin, $name_bk, $zip_file) {
        global $glo_db;
        try {

            if($tables == '*') {
                $tables = array();
                $result = mysqli_query($glo_db, 'SHOW TABLES');
                while($row = mysqli_fetch_row($result)) {
                    $tables[] = $row[0];
                }
            } else {
                $tables = is_array($tables) ? $tables : explode(',', str_replace(' ', '', $tables));
            }


            $sql="SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
            $sql.="SET time_zone = '+00:00';\n";
            $sql.="/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n";
            $sql.="/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n";
            $sql.="/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n";
            $sql.="/*!40101 SET NAMES utf8 */;\n";

            foreach($tables as $table) {

                $row = mysqli_fetch_row(mysqli_query($glo_db, 'SHOW CREATE TABLE `'.$table.'`'));
                $sql .= "\n\n".$row[1].";\n\n";


                $row = mysqli_fetch_row(mysqli_query($glo_db, 'SELECT COUNT(*) FROM `'.$table.'`'));
                $numRows = $row[0];


                $batchSize = 1000; 
                $numBatches = intval($numRows / $batchSize) + 1; 
                for ($b = 1; $b <= $numBatches; $b++) {
                    
                    $query = 'SELECT * FROM `'.$table.'` LIMIT '.($b*$batchSize-$batchSize).','.$batchSize;
                    $result = mysqli_query($glo_db, $query);
                    $numFields = mysqli_num_fields($result);

                    for ($i = 0; $i < $numFields; $i++) {
                        $rowCount = 0;
                        while($row = mysqli_fetch_row($result)) {
                            $sql .= 'INSERT INTO `'.$table.'` VALUES(';
                            for($j=0; $j<$numFields; $j++) {
                                if (isset($row[$j])) {
                                    $row[$j] = addslashes($row[$j]);
                                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                                    $sql .= '"'.$row[$j].'"' ;
                                } else {
                                    $sql.= 'NULL';
                                }

                                if ($j < ($numFields-1)) {
                                    $sql .= ',';
                                }
                            }

                            $sql.= ");\n";
                        }
                    }

                    lh_saveFile($sql, $duongdantin, $name_bk);
                    $sql = '';
                }

                $sql.="\n\n\n";
            }

            if ($zip_file) {
                lh_gzipBackupFile(9, $duongdantin, $name_bk, $zip_file);
            } 
            else {

            }
        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }

        return true;
    }

    function lh_saveFile(&$sql, $duongdantin, $name_bk) {
        if (!$sql) return false;

        try {
            file_put_contents($duongdantin.'/'.$name_bk , $sql, FILE_APPEND | LOCK_EX);

        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }

        return true;
    }

    function lh_gzipBackupFile($level = 9, $duongdantin, $name_bk, $zip_file) {
        
        if (!$zip_file) {
            return true;
        }

        $source = $duongdantin . '/' . $name_bk ;
        $dest =  $source . '.gz';

        $mode = 'wb' . $level;
        if ($fpOut = gzopen($dest, $mode)) {
            if ($fpIn = fopen($source,'rb')) {
                while (!feof($fpIn)) {
                    gzwrite($fpOut, fread($fpIn, 1024 * 256));
                }
                fclose($fpIn);
            } else {
                return false;
            }
            gzclose($fpOut);
            if(!unlink($source)) {
                return false;
            }
        } else {
            return false;
        }

        return $dest;
    }

    if(isset($_POST['add_bakup'])){
        $name_bk = "backup_".date('d-m-Y_H-i-s').".sql";

        $check = lh_backupTables($table_bk, $duongdantin, $name_bk, $zip_file);
        if($check){
            $data                = array();
            $data['file']        = $name_bk.".gz";
            $data['duongdantin'] = "datafiles/backup";
            $data['ngay_backup'] = time();
            ACTION_db($data, $table, 'add', NULL, NULL);
            $_SESSION['show_message_on'] = 'Backup dữ liệu thành công!';
        }
        else {
            $_SESSION['show_message_off'] = 'Lỗi backup dữ liệu!';
        }
        LOCATION_js($url_page);
        exit();
    }

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
    {
        for($i=0;$i<$_REQUEST['maxvalu'];$i++)
        {
            $idofme     = $_POST["idme$i"];

            $showhi     = isset($_POST["showhi_$i"]) ? "1": "0";
            if(isset($_POST["xoa_gr_arr_$i"])){
                $sql_se     = DB_que("SELECT * FROM `$table` WHERE `id`='".$idofme."' LIMIT 1");
                $sql_se     = DB_arr($sql_se, 1);
                @unlink("../".$sql_se['duongdantin']."/".$sql_se['file']);
                DB_que("DELETE FROM $table WHERE id='".$idofme."' LIMIT 1");
            }
            
        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
        LOCATION_js($url_page);
        exit();
    }
?>
<section class="content-header">
    <h1>Backup dữ liệu</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Backup dữ liệu</li>
    </ol>
</section>

<form action="" method="post">
    <input type="hidden" name="token" value="<?=GET_token() ?>">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Danh sách
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" name="addgiatri" class="btn btn-primary"  onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                            <button type="submit" class="btn btn-primary" name="add_bakup" ><i class="fa fa-plus"></i> Backup dữ liệu</button>
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                        <table class="table table-hover table-danhsach">
                            <tbody>
                                <tr>
                                    <th class="w80 text-center">STT</th>
                                    <th>File</th>
                                    <th class="w150 text-center">Ngày backup</th>
                                    <th class="w100 text-center">Tải file</th>
                                    <th class="w50 text-center">
                                      <label>
                                        <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                      </label>
                                    </th>
                                </tr>
                                <?php
                                    $sql        = DB_que("SELECT * FROM `$table` ORDER BY `id` DESC");
                                    $sql        = DB_arr($sql);
                                    $cl         = 0;
                                    foreach ($sql as $rows) {
                                        $ida              = $rows['id'];
                                        foreach ($rows as $key => $value) {
                                            ${$key} = SHOW_text($value);
                                        }
                                ?>
                                <tr>
                                    
                                    <td class="text-center">
                                        <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                                        <?=$cl+1?>
                                    </td>
                                    <td>
                                        <?=$file ?>
                                    </td>
                                    <td class="text-center">
                                        <?=date("d-m-Y H:i:s", $ngay_backup) ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="../<?=$duongdantin ?>/<?=$file ?>" download>[Tải file]</a>
                                    </td>
                                    <td class="text-center">
                                      <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                                      <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                                    </td>
                                </tr>
                                <?php
                                        $cl++;
                                    }
                                ?> 
                            </tbody>
                        </table>
                        <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                </div>
            </section>
        </div>
    </section>
</form>