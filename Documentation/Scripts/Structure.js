$(document).ready(function(e) {
	
	function stageScale()
	{
		var innerHeight = window.innerHeight - $("#header").height() - $("#footer").height();
		
		if($("#right").height() < innerHeight) 
		{
			$("#left").height(innerHeight);
			$("iframe").height(innerHeight-142);
		}
		else
		{
			$("#left").height(innerHeight + $("#right").height() + 40 - innerHeight);
		}
		
		$(window).scroll(function(e){
		
			$("#right").attr("style","margin-top:" + $(window).scrollTop() + "px;")
			if($(window).scrollTop() == 0)$("#right").removeAttr("style");
			$("#right").width(window.innerWidth - $("#left").width() - 60);
			$("#left").height(innerHeight +  $(window).scrollTop());
			
		});
		
		$("#right").width(window.innerWidth - $("#left").width() - 60);
	}
	stageScale();

	$(window).resize(function(e){
		stageScale();
	})
	
	$("#home-menu ul").hide();

	$("#home-menu > li > a").click(function(e){	
		$("#home-menu ul").slideUp();
		$(this).parent().find('ul').slideDown();	
		$("#home-menu li a").attr("style","");
		$(this).attr("style","background-color:white; color:#000; border-bottom:solid 2px #333;");
		$("#sub-menu a").attr("style","");
	});
	
	$("#sub-menu a").click(function(e){	
		$("#sub-menu a").attr("style","");
		$(this).attr("style","background-color:#0E778D; color:#fff;");
		
	});
	
	$("#search-text").focusin(function(e){ $(this).val('').attr('style', 'color:#0E778D;'); });
	
	$("div[type='prev-next'] a").click(function(e){	
		$("#sub-menu a").attr("style","");
		var element = "Pages/" + $(this).attr('href');
		//alert($("a[href='"+element+"']").attr('href'));
		$("a[href='"+element+"']").attr("style","background-color:#0E778D; color:#fff;");
	});
	
});