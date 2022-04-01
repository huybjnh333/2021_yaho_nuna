<script src="js/map/serial.js"></script>
<script src="js/map/export.min.js"></script>
<script src="js/map/light.js"></script>
<script src="js/map/ammap.js"></script>
<script src="js/map/worldLow.js"></script>
<!--<script src="js/map/core.js"></script>-->
<!--<script src="js/map/maps.js"></script>-->
<!--<script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>-->

<div class="our_market_home_box">
    <div class="pagewrap">
        <div class="titile_page wow pulse">
            <ul>
                <h3 class="titile_h titile_color_a"><?=$glo_lang['ban_do_vi_tri']?></h3>
                <p><?=$glo_lang['mota_ban_do_vi_tri']?></p>
                <div class="clr"></div>
            </ul>
        </div>
        <ul class="wow pulse">
            <div class="resizable">
                <div id="chartdiv"></div>
            </div>
            <div class="clr"></div>
        </ul>
    </div>
</div>

<?php
    $bando = LAY_baiviet(9);
?>
<script>
    var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
    var map = AmCharts.makeChart("chartdiv", {
        "type": "map",
        "projection": "winkel3",
        "theme": "light",
        "imagesSettings": {
            "rollOverColor": "#416d89",
            "rollOverScale": 3,
            "selectedScale": 3,
            "selectedColor": "#416d89",
            "color": "#416d89"
        },
        "areasSettings": {
            "unlistedAreasColor": "#1bbda5",
            "outlineThickness": 0.1
        },
        "dataProvider": {
            "map": "worldLow",
            "images": [
                <?php foreach ($bando as $val){
                        $vitri = explode(",",$val['p3']);
                    ?>
                {
                    // "type": "circle",
                    "svgPath": targetSVG,
                    "zoomLevel": 4,
                    "scale": 0.5,
                    "title": "<?=$val['tenbaiviet_'.$lang]?>",
                    // "flag": "images/icon-maps.png",
                    "latitude": <?=str_replace(" ","",$vitri[0])?>,
                    "longitude": <?=str_replace(" ","",$vitri[1])?>,
                    <?=($val['opt_km']) == 1 ? '"imageURL":"images/icon-maps.png"' : ''?>
                    // "imageURL":"images/icon-maps.png",
                    // "label": "<img src='images/icon-maps.png' width='25px'>",
                },
                <?php } ?>
            ],
        }
        // "export": {
        //      "enabled": true
        // }
    });

</script>

<!--<div class="premium">-->
<!--    <div class="premium-image" data-tooltip-content="#tooltip_content" style="top: 47%; left: 65%;">-->
<!--        <img src="--><?//=checkImage($fullpath,$thongtin['icon'],$thongtin['duongdantin'])?><!--" width="25px"-->
<!--             style="background: #fff;border-radius: 50%;margin-top: 3px;">-->
<!--    </div>-->
<!--</div>-->
<style>
    #chartdiv g image{
        height: 20px;
        width: 15px;
        /*height: 40px;*/
        /*width: 30px;*/
        transform: translate(-8px, -20px);
        /*transform: translate(-13px, -40px);*/
    }
    #chartdiv g image:hover{
        transform: translate(-8px, -20px);
        /*transform: translate(-13px, -40px);*/
    }
</style>



