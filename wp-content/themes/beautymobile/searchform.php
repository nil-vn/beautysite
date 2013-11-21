<form role="search" method="get" class="search-form" action="<?php echo home_url( '/search' ); ?>">
	<label>
		<input type="text" class="search-field" value="" name="s" title="キーワードを入力（例：ニキビ、美白）" />
	</label>
	<a href="#" class="searchBtn">検索</a>
	<input id="q" name="q" type="hidden" id="search" />

</form>
<div style="display:none">
<?php
// display_search_box(DISPLAY_RESULTS_CUSTOM);
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('.search-form').submit(function(event) {
		$('#q').val($('.search-field').val());
		$('.search-field').val('');
		// do_custom_search();
		// return false;
	});

	$('.searchBtn').click(function(event) {
		// do_custom_search();
		$('.search-form').submit();
		// return false;
	});

	// function do_custom_search()
	// {
	// 	// alert($('.search-field').val());
	// 	$('.gsc-input input').val($('.search-field').val());
	// 	$('.gsc-search-button input[type=button]').click();
	// }

});

</script>
</div>