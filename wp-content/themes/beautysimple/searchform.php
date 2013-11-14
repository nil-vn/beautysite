<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<input type="text" class="search-field" value="" name="s" title="キーワードを入力（例：ニキビ、美白）" />
	</label>
	<a href="#" class="searchBtn">検索</a>
</form>
<div style="display:none">
<?php
display_search_box(DISPLAY_RESULTS_AS_POP_UP);
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('.search-form').submit(function(event) {
		do_custom_search();
		return false;
	});

	$('.searchBtn').click(function(event) {
		do_custom_search();
		return false;
	});

	function do_custom_search()
	{
		// alert($('.search-field').val());
		$('.gsc-input input').val($('.search-field').val());
		$('.gsc-search-button input[type=button]').click();
	}

});

</script>
</div>