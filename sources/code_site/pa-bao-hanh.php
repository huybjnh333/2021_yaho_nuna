<?php
    if(isset($_GET['id'])){
        $nd = LAYTEXT_rieng($_GET['id']);
?>
<div class="pop-quotation">
    <div id="frmQuotation">
        <h3><?=$nd['p1_'.$lang]?></h3>
        <div class="showText">
            <?=SHOW_text($nd['noidung_'.$lang])?>
        </div>
    </div>
</div>
<?php } ?>