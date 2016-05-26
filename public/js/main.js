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
		var minTop = topElement.offset().top + topElement.outerHeight();
		var maxTop = bottomElement.offset().top - floatingShopingCart.outerHeight();
		var top = Math.max(250, minTop - $(window).scrollTop());
			top = Math.min(top, maxTop - $(window).scrollTop());
		floatingShopingCart.css({
			top: top
		});
	}

	// listners

	$(".open-dialog-link").on("click", GetOpenDialog);
	$(window).on("scroll", PositionFloatingShopingCart);
	$(document).imagesLoaded(PositionFloatingShopingCart);
})($)