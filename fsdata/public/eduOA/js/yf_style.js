$(document).ready(function(){
	$(".input-text-1>input").focus(function(){
		var p = $(this).prev();
		console.log($(this).val());
		if(!p.hasClass("additional-s")){
			var arr = $(".input-text-1>input");
			arr.each(function(){
				if($(this).val()==""){
					$(this).prev().removeClass("additional-s");
				}
			});
			p.addClass("additional-s");
		}
	});
});