$(window).load(function(){
	if(screen.width >= 1470)
	{
		$(".row").css({
			position: "relative",
			width: "1460px",
			left:"50%",
			"margin-left": "-730px"
		});
		$(".RowContainer12").css({
			position: "absolute",
			width: "100%",
			"min-width": "1460px",
			top:"0px",
			left: "0px",
		});
	}
	else
	{
		$(".row").css({
			position: "relative",
			width: "1024px",
			left:"50%",
			"margin-left": "-512px"
		});
		$(".RowContainer12").css({
			position: "absolute",
			width: "100%",
			"min-width": "1024px",
			top:"0px",
			left: "0px",
		});
	}
});