(function(){
	$('.main-slider').flexslider({
		controlNav: false,
		directionNav: false
	});
	$('.visit-us__slider').flexslider({
		controlNav: false,
		animation: "slide",
	    prevText: "",
	    nextText: ""	
	})
	$('.articles-slider').flexslider({
		animation: "slide",
		directionNav: false
	});
	$('.reviews__slider').flexslider({
		animation: "slide",
		itemWidth: 575,
		directionNav: false
	});

	// listners

	$(".open-dialog-link").on("click", GetOpenDialog);

	// controllers

	function GetOpenDialog(event){
		event.preventDefault();
		$.get(this.href, function (data) {
			$.fancybox(data)
		});
	}

})($)