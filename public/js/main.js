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

	// controllers

	function GetOpenDialog(event){
		event.preventDefault();
		$.get(this.href, function (data) {
			$.fancybox(data)
		});
	}

	var topElement = $('.main-slider');
	var bottomElement = $('.footer');
	var floatingShopingCart = $('.floating-shoping-cart')

	function PositionFloatingShopingCart(){
		var upperLimit = topElement.offset().top + topElement.outerHeight();
		var lowerLimit = bottomElement.offset().top;

		if (upperLimit >= $(window).scrollTop()) {
			floatingShopingCart.css({
				top: upperLimit,
				position: 'absolute'
			})
		}else{
			floatingShopingCart.css({
				top: 0,
				position: 'fixed'
			})
		}

		floatingShopingCart.css({
			height: lowerLimit - floatingShopingCart.offset().top,
		});
	}

	// listners

	$(".open-dialog-link").on("click", GetOpenDialog);
	$(window)
		.on("scroll resize", PositionFloatingShopingCart)
		.imagesLoaded(PositionFloatingShopingCart);
})($)