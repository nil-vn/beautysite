/*
functions.js
c: 20131107
m: 20131108
*/

jQuery(document).ready(function($){
    	//index
	$(".rankingArea section a").tile();
	$(".newsList").tile();
	$(".recommendArea section a").tile();
	$(".contentsNav dl").tile();
	//共通
	$(".contentsNav dl").tile();
	//下層
	$(".recommendList ul li a").tile();
	$(".recommendList02 ul li a").tile(3);

	$(window).load(function(){
		$('input[type=text],input[type=password],input[type=tel],input[type=email],textarea').each(function(){
			var thisTitle = $(this).attr('title');
			if(!(thisTitle === '')){
				$(this).wrapAll('<span style="text-align:left;display:inline-block;position:relative;"></span>');
				$(this).parent('span').append('<span class="placeholder">' + thisTitle + '</span>');
				$('.placeholder').css({
					top:'5px',
					left:'5px',
					fontSize:'100%',
					lineHeight:'120%',
					textAlign:'left',
					color:'#999',
					overflow:'hidden',
					position:'absolute',
					zIndex:'99'
				}).click(function(){
					$(this).prev().focus();
				});

				$(this).focus(function(){
					$(this).next('span').css({display:'none'});
				});

				$(this).blur(function(){
					var thisVal = $(this).val();
					if(thisVal === ''){
						$(this).next('span').css({display:'inline-block'});
					} else {
						$(this).next('span').css({display:'none'});
					}
				});

				var thisVal = $(this).val();
				if(thisVal === ''){
					$(this).next('span').css({display:'inline-block'});
				} else {
					$(this).next('span').css({display:'none'});
				}
			}
		});
	});

	$('.toppageLink').hover(
		function(){$(this).fadeTo(0, 0.8).fadeTo('normal', 1.0);},
		function(){$(this).fadeTo('fast', 1.0);}
	);
	$(".toppageLink").click(function () {
		$('html,body').animate({ scrollTop: 0 }, 'fast');
		return false;
	});

	// ie 8
	$(".entryRanking ol li[class*='rank'] .rank").css("min-height","45px");
    $(".entryRanking ol li[class*='rank'] .txt").css("width","179px");
	//topic path
    $(".topicPath li:not(:last)").append("＞");


    $(".rankingArea header ul li").click(function() {
        var num = $(".rankingArea header ul li").index(this);
        $(".rankingArea .inner").addClass('disnon');
        $(".rankingArea .inner").eq(num).removeClass('disnon');
        $(".rankingArea header ul li").removeClass('active');
        $(this).addClass('active');
    });

	// $('.rankingArea li a').click(function(event) {
	// 	var id = $(this).parent().attr('class');
	// 	$('#' + id).show('400', function() {
	// 		$(this).siblings().hide();
	// 	});

	// });

});