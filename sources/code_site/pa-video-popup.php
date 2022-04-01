<?php
$step = @$_GET['step'];
$id = @$_GET['id'];
$link = @$_GET['link'];
if(!empty($step) && !empty($id)){
    $video = LAY_baiviet("$step","","`id` = $id");
    $video = reset($video);
    $video = GET_ID_youtube($video['p1']);
}else if (!empty($link)){
    $video = GET_ID_youtube($link);
}

?>
<div class="poup_page">
    <div class="bangdo_poup">
        <iframe width="800" height="450" src="https://www.youtube.com/embed/<?=@$video?>?enablejsapi=1&autoplay=1&disablekb=1&enablejsapi=1&loop=1&mute=0"
                frameborder="0" enablejsapi="1"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
</div>