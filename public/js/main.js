(function(){
	$.datetimepicker.setLocale('ru')
	$('#delivery_time').datetimepicker({
		format: 'd.m.Y H:i'
	})
	$('#birthday').datetimepicker({
		format: 'd.m.Y',
		timepicker: false
	})

	$('[name=phone]').mask('+380999999999')
	initMask()
	
	$('.main-slider').flexslider({
		controlNav: false,
		directionNav: false,
		init: function(){
			$('.main-slider .flex-active-slide [data-effect]').each(function(key,item){
				setTimeout(function ( ) {
					$(item)
						.addClass($(item).attr('data-effect'))
						.addClass('animated')
				}, $(item).attr('data-time') )
			})
		},
		after: function (){
			$('.main-slider .flex-active-slide [data-effect]').each(function(key,item){
				setTimeout(function ( ) {
					$(item)
						.addClass($(item).attr('data-effect'))
						.addClass('animated')
				}, $(item).attr('data-time') )
			})
		},
		before: function (){
			$('.main-slider :not(.flex-active-slide) [data-effect]').each(function(key,item){
				$(item)
					.removeClass( $(item).attr('data-effect') )
					.removeClass('animated')
			})
		},
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
				reloadFloatingShoppingCart()

				if (data.redirect)
					window.location.href = data.redirect
				else if (data.modal)
					$.fancybox(data.modal)
				else
					window.location.href = form.action
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

	function addCartItem (event) {
		event.preventDefault();
		link = this;
		$.ajax({
			url: link.href,
			success: function (data){
				reloadFloatingShoppingCart()
				$('.button.button_cart_add[data-id="'+$(link).attr('data-id')+'"]').addClass('button_cart_add_active')
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}

	function removeCartItem (event) {
		event.preventDefault();
		var id = $(this).attr('data-id')
		$.ajax({
			url: this.href,
			success: function (data){
				reloadFloatingShoppingCart()
				$('.button.button_cart_add[data-id="'+id+'"]').removeClass('button_cart_add_active')
				$('.ajax-update-cart-item [name=id][value='+id+']').siblings('[name=quantity]').val(1)
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}

	function addOrRemoveWishlistItem (event) {
		event.preventDefault()
		var id = $(this).attr('data-id')
		$.ajax({
			url: this.href,
			success: function (data){
				reloadWishlistModal()
				$('.button.button_wishlist[data-id="'+id+'"]').toggleClass('button_red')
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}

	function addOrRemoveComparelistItem (event) {
		event.preventDefault()
		var id = $(this).attr('data-id')
		$.ajax({
			url: this.href,
			success: function (data){
				reloadComparelistModal()
				$('.button.button_comparelist[data-id="'+id+'"]').toggleClass('button_red')
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}

	function updateCartItem (event) {
		var id = $(this).find('[name=id]').val()
		var quantity = $(this).find('[name=quantity]').val()
		$.ajax({
			url: this.action,
			method: "POST",
			data: $(this).serializeArray(),
			success: function (data){
				reloadFloatingShoppingCart()
				$('.ajax-update-cart-item [name=id][value='+id+']').siblings('[name=quantity]').val(quantity)
			},
			error: function (data){
				$.fancybox(data.responseText)
			}
		})
	}

	function reloadFloatingShoppingCart () {
		if (cart = $('.shoping-cart'))
			$.get('/cart',function(data){
				cart.replaceWith(data)
				FSCart.init()
				FSCart.position()
			})


		if (cart_table = $('.shoping-cart-table'))
			$.get('/cart/table',function(data){
				cart_table.replaceWith(data)
			})
	}

	function reloadComparelistModal(){
		$.get('/comparelist',function(data){
			$('#comparelist').replaceWith(data)
		})
	}

	function reloadWishlistModal(){
		$.get('/wishlist',function(data){
			$('#wishlist').replaceWith(data)
		})
	}


	var FSCart = {
		init: function () {
			this.topElement =  $('.main-slider')
			this.bottomElement = $('.footer')
			this.container = $('.floating-shoping-cart')
			this.top = this.container.find('.floating-shoping-cart__top')
			this.middle = this.container.find('.floating-shoping-cart__middle')
			this.bottom = this.container.find('.floating-shoping-cart__bottom')
		},
		fixedTop: 45,
		position: function () {
			if (!this.container.length)
				return false;

			var upperLimit = this.topElement.offset().top + this.topElement.outerHeight() - this.fixedTop;
			var lowerLimit = this.bottomElement.offset().top;

			if (upperLimit >= $(window).scrollTop() && this.container.hasClass('floating-shoping-cart_fixed'))
				this.container.removeClass('floating-shoping-cart_fixed')
			if (upperLimit < $(window).scrollTop() && !this.container.hasClass('floating-shoping-cart_fixed'))
				this.container.addClass('floating-shoping-cart_fixed')

			this.container.css({
				height: Math.min( lowerLimit - this.container.offset().top, $(window).height() - this.fixedTop )
			});

			this.middle.css({
				"max-height": this.container.height() - this.top.height() - this.bottom.height()
			})
		}
	}
	FSCart.init()

	var MMenu = {
		before: $('.main-menu__before'),
		container: $('.main-menu'),
		position: function(){
			if (!this.container.length)
				return false
			var top = this.before.offset().top + this.before.outerHeight()

			if (top >= $(window).scrollTop() && this.container.hasClass('main-menu__fixed'))
				this.container.removeClass('main-menu__fixed')

			if (top < $(window).scrollTop() && !this.container.hasClass('main-menu__fixed'))
				this.container.addClass('main-menu__fixed')
		}
	}


	function dataToggle (event) {
		event.preventDefault()
		$($(this).attr('href')).slideToggle();
	}

	function multipleFieldDelete(event){
		event.preventDefault()
		$(this).parents('.multiple-field').remove()
	}

	function multipleFieldAdd(event){
		event.preventDefault()
		var template = $( $(this).attr('href') ).clone().attr('id','')
		$(this).parents('.row').before(template)
		initMask()
	}

	function initMask(){
		$('[data-mask]').each(function(key,item){
			$(this).mask( $(this).attr('data-mask') )
		})
	}

	// listners
	$(document).on('click', '.multiple-field__add', multipleFieldAdd)
	$(document).on('click', '.multiple-field__delete', multipleFieldDelete)
	$(document).on('submit','.ajax-form',AjaxFormSend);
	$(document).on('click','.button_cart_add', addCartItem);
	$(document).on('click','.button_cart_delete', removeCartItem);
	$(document).on('click','.button_wishlist', addOrRemoveWishlistItem);
	$(document).on('click','.button_comparelist', addOrRemoveComparelistItem);
	$(document).on('change','.ajax-update-cart-item',updateCartItem);
	$(window)
		.imagesLoaded( function(){ 
			FSCart.position()
			MMenu.position()
		} )
		.on("scroll resize", function(){
			FSCart.position()
			MMenu.position()
		});

	function initListeners(){
		$('.fancybox').fancybox();
		$('[data-toggle="slide"]').click(dataToggle);
		$('product__compare').click(reloadComparelistModal);
	}

	$(document).ready(initListeners);

})($)