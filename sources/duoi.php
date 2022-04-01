<div class="clr"></div>
</div>
<?php include _source . "footer.php"; ?>
</div>
</div>
</article>
</section>

<?php include _source."js.php"; ?>
<script type="text/javascript" src="js/owl.carousel.js"></script>
<script type="text/javascript" src="js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="js/me.js?v=<?= time() ?>"></script>
<script src='menu_mb/jquery.mmenu.min.js' type='text/javascript'></script>
<script>
    $(function () {
        $("#nav-mobile").mmenu();
        $("#nav-mobile").show();
        // $("#nav-mobile-new").mmenu();
        // $("#nav-mobile-new").show();
    });
    $(document).ready(function () {
        $("ul.menu > li").each(function () {
            var addchua = $("a", this).eq(0).attr('add');
            if ($("ul", this).length > 0 && addchua != 'ok') {
                $("a", this).eq(0).append('<i class="fa fa-angle-down"></i>');
                $("a", this).eq(0).attr('add', 'ok');
                // $(">a", this).removeAttr('href');
            }
        });
    });
</script>

<?php if (!empty($slug_step)) { ?>
    <script>$(".active_mn_<?=$slug_step ?>").addClass("acti")</script>
<?php } else { ?>
    <script>
        var url_new = "<?=$full_url . ($motty != "" ? "/" . $motty : "") ?>";
        $(".active_mn_01").each(function () {
            var href = $(this).attr("href");
            if (href == url_new) {
                $(this).addClass("acti");
                return false;
            }
        });
    </script>
<?php } ?>

</body>
</html>