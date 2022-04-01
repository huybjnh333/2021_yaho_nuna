<div id="myOverlay" class="overlay" style="display:none;">
    <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
    <div class="overlay-content">
        <input onchange="SEARCH_timkiem('<?=$full_url.'/search/'?>', '.input_search')" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem']?>" class="input_search" type="text" value="">
        <button onclick="SEARCH_timkiem('<?=$full_url.'/search/'?>','.input_search')" type="submit"><i class="fa fa-search"></i></button>
    </div>
</div>
<script>
    function openSearch() {
        document.getElementById("myOverlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("myOverlay").style.display = "none";
    }

    $(document).mouseup(function(e)
    {
        var container = $("#myOverlay");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.hide();
        }
    });

    // $(".mn-mobile").click(function () {
    //     $("#nav-mobile").css('display', 'block');
    // });
    //
    // $('.mn-mobile-new').click(function () {
    //     var class_menu = $('.menu-mb').attr('class');
    //     if (class_menu == 'menu-mb hidden') {
    //         $('.menu-mb').removeClass('hidden');
    //     } else {
    //         $('.menu-mb').addClass('hidden');
    //     }
    // });
    //
    // $(document).on('click', 'li.child-li .fa.fa-angle-down', function (e) {
    //     var parent = $(this).parent();
    //     if ($(">ul", parent).hasClass('show-item')) {
    //         $(">ul", parent).removeClass('show-item');
    //     } else {
    //         $(">ul", parent).addClass('show-item');
    //     }
    // });
    //
    // $(document).on('click', 'li.child-li-1 .fa.fa-angle-down', function (e) {
    //     var parent = $(this).parent();
    //     if ($(">ul", parent).hasClass('show-item')) {
    //         $(">ul", parent).removeClass('show-item');
    //     } else {
    //         $(">ul", parent).addClass('show-item');
    //     }
    // });
    //
    // $(document).ready(function () {
    //     $('li.child-li-1').click(function () {
    //         if ($(">ul", this).hasClass('show-item')) {
    //             $(">ul", this).removeClass('show-item');
    //             $(">ul", this).attr("data-open", false);
    //         } else {
    //             $(">ul", this).addClass('show-item');
    //             $(">ul", this).attr("data-open", true);
    //         }
    //     });
    // })
</script>