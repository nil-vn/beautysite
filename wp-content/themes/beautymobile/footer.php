
<footer class="globalFooter">
<dl class="viewSwitch">
<dt>表示方法</dt>
<dd><span>モバイル</span><?php  print  wpmp_switcher_link('desktop', 'PC') ;
 ?></dd>
</dl>

<ul class="siteNav">
<li><a href="/terms">利用規約</a></li>
<li><a href="/privacy">プライバシーポリシー</a></li>
<li><a href="/terms">利用規約</a></li>
</ul>

<div class="copyright"><small>Copyright &copy; Cosumehouse All Rights Reserved.</small></div>
</footer>

<?php 
	if (is_home()) { ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
	<script>
	jQuery(document).ready(function($){
		//top carousel *plugin*
		$('.mainBox').owlCarousel({
			slideSpeed  : 300,
			singleItem:true,
			autoHeight : true,
			navigation : true,
			navigationText : ['<img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_arrow_circle.png" width="45" height="45" alt="前へ">','<img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_arrow_circle.png" width="45" height="45" alt="次へ">'],
			pagination: false,
			rewindNav: false
		});
		//open-close of each category news
		$(".news dt").toggle(
			function () { 
				$(this).next().slideDown();
				$("a span",this).text('－');
			},
			function () { 
				$(this).next().slideUp();
				$("a span",this).text('＋');
			}
		);
		//ranking tab switch
		$(".ranking ul.tab li a").click(function() {
	        var num = $(".ranking ul.tab li a").index(this);
	        $(".ranking ol").addClass('disnon');
	        $(".ranking ol").eq(num).removeClass('disnon');
			return false;
	    });
	});
	</script>
<?php
	}
?>

<?php wp_footer(); ?>

</body>
</html>