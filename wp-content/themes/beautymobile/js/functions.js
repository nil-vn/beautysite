/*
functions.js
c: 20131114
m: 20131115
*/


//globalNav 
jQuery(document).ready(function($){
	$(".globalHeader .menuBtn a").toggle(
		function () { 
			$(".globalNav").slideDown();
			$(".arrow img",this).css({"transform":"rotate(-90deg)"});
		},
		
		function () { 
			$(".globalNav").slideUp();
			$(".arrow img",this).css({"transform":"rotate(90deg)"});
		}
	);
			
	$(".globalNav > ul > li > a").click(function(){
		if($(this).parent().children("ul").css("display")=="none"){
			$(".globalNav > ul > li > ul").slideUp();
			$(".globalNav > ul > li > a span").text('＋');
			$(this).parent().children("ul").slideDown();
			$("span",this).text('－');
			return false;
		}else{
			$(this).parent().children("ul").slideUp();
			$("span",this).text('＋');
			return false;
		}
	});
});


//カテゴリページ サブカテナビ 開閉
jQuery(document).ready(function($){
	$(".pageTypeCategory .categoryHeader h1 > a").toggle(
		function () { 
			$(".subCateNav").slideDown();
			$(this).text('－');
		},
		function () { 
			$(".subCateNav").slideUp();
			$(this).text('＋');
		}
	);
});
