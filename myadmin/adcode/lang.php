<ul class="nav nav-tabs">
    <?php
$count_lang = 1;
foreach ($arr_lang as $r_lang){
    ?>
    <li class="<?=$count_lang == 1 ? "active" : ""?>"><a href="#tab_<?=$count_lang?>" data-toggle="tab">
            <?= $r_lang['tenbaiviet'] ?></a></li>
    <?php $count_lang++;} ?>
</ul>