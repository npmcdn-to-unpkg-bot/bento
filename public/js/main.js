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

	function AjaxFormSend (event) {
		event.preventDefault();
		form = this;
		$.ajax({
			url: form.action,
			method: form.method,
			data: $(form).serializeArray(),
			type: 'json',
			success: function (data) {
				if (data){
					if (data.redirect)
						window.location.href = data.redirect
					if (data.modal)
						$.fancybox(data.modal)

					reloadFloatingShoppingCart()
				}else{
					window.location.href = form.action
				}
			},
			error: function (data) {
				$(form).find('.error').remove()
				$.each(data.responseJSON, function (name, errors){
					$.each(errors, function(key, error){
						$(form)
							.find('[name="'+name+'"]')
							.after($('<div class="error" />').text(error))
					})
				})
			}
		});
	}

	function addOrRemoveCartItem (event) {
		event.preventDefault();
		$.ajax({
			url: this.href,
			method: "POST",
			data: {
				id: $(this).attr('data-id'),
				_token: $(this).attr('data-token')
			},
			success: function (data){
				reloadFloatingShoppingCart()
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}

	function updateCartItem (event) {
		event.preventDefault();
		$.ajax({
			url: $(this).attr('data-action'),
			method: "POST",
			data: {
				id: $(this).attr('data-id'),
				_token: $(this).attr('data-token'),
				value: $(this).val()
			},
			success: function (data){
				reloadFloatingShoppingCart()
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}


	var topElement = $('.main-slider');
	var bottomElement = $('.footer');
	var floatingShopingCart = $('.floating-shoping-cart')

	function reloadFloatingShoppingCart () {
		$.get('/cart/index',function(data){
			$('.shoping-cart').replaceWith(data);
		})
	}

	function positionFloatingShopingCart(){
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

	function dataToggle (event) {
		event.preventDefault()
		$($(this).attr('href')).slideToggle();

	}

	// listners
	$(document).on('submit','.ajax-form',AjaxFormSend);
	$(document).on('click','.ajax-send-id', addOrRemoveCartItem);
	$(document).on('change','.ajax-send-input',updateCartItem);
	if (floatingShopingCart.length)
		$(window)
			.on("scroll resize", positionFloatingShopingCart)
			.imagesLoaded(positionFloatingShopingCart);

	function initListeners(){
		$('.fancybox').fancybox();
		$('[data-toggle]').click(dataToggle);
	}

	$(document).ready(initListeners);

})($)