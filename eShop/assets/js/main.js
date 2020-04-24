//slider on main page
if(document.getElementById('mainSlider')) {
	jQuery('#mainSlider').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  fade: false,
	  variableWidth: true
	});
}

//product sliders on shop product name page
if (document.getElementById('productFull__carousel')) {
	jQuery('#productFull__carousel').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  fade: true,
	  asNavFor: '#productFull__thumbnails'
	});
	jQuery('#productFull__thumbnails').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  asNavFor: '#productFull__carousel',
	  dots: false,
	  centerMode: false,
	  focusOnSelect: true,
	  variableWidth: true,
	  arrows: true
	});
}
if (document.getElementById('productRelated')) {
	jQuery('#productRelated').slick({
	  slidesToShow: 3,
	  slidesToScroll: 3,
	  arrows: true,
	  fade: false,
	  autoplay: false,
	  responsive: [
		  {
			  breakpoint: 992,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2,
			  }
		  },
		  {
			  breakpoint: 768,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			  }
		  }
	  ]
	});
}

//tabs on shop product name page
if(document.getElementById('tabNav1')) {
	var tabNav1 = document.getElementById('tabNav1');
	var tabNav2 = document.getElementById('tabNav2');
	var tabCont1 = document.getElementById('tabCont1');
	var tabCont2 = document.getElementById('tabCont2');

	tabNav1.addEventListener('click', function() {
		tabNav1.classList.add('tabNavActive');
		tabNav2.classList.remove('tabNavActive');
		tabCont1.classList.add('d-block');
		tabCont1.classList.remove('d-none');
		tabCont2.classList.add('d-none');
		tabCont2.classList.remove('d-block');
	});
	tabNav2.addEventListener('click', function() {
		tabNav2.classList.add('tabNavActive');
		tabNav1.classList.remove('tabNavActive');
		tabCont2.classList.add('d-block');
		tabCont2.classList.remove('d-none');
		tabCont1.classList.add('d-none');
		tabCont1.classList.remove('d-block');
	});
}

//quantity changer on shop product name page
if(document.getElementById('productOrdering__quantity')) {
	var productOrdering__minus = document.getElementById('productOrdering__minus');
	var productOrdering__plus = document.getElementById('productOrdering__plus');
	var productOrdering__quantity = document.getElementById('productOrdering__quantity');

	productOrdering__minus.addEventListener('click', changingQuantity);
	productOrdering__plus.addEventListener('click', changingQuantity);

	function changingQuantity(e) {
		e.preventDefault();
		let target = e.target.closest('button');
		if(!target) {
			return;
		};
		if ((target.id === 'productOrdering__minus')&& (productOrdering__quantity.value > 0)) {
			productOrdering__quantity.value = Number(productOrdering__quantity.value) - 1;
		} else if((target.id === 'productOrdering__plus')&& (productOrdering__quantity.value < 1000)) {
			productOrdering__quantity.value = Number(productOrdering__quantity.value) + 1;
		};
	};
}

//sidebar range slider
if(document.getElementById('costRangeSlider')) {
	var sRS = document.getElementById('costRangeSlider');

	noUiSlider.create(sRS, {
		start: [1000, 7000],
		connect: true,
		range: {
			'min': 100,
			'max': 10000
		}
	});



	var indicatorMinValue = document.getElementById('indicatorMinValue');
	var indicatorMaxValue = document.getElementById('indicatorMaxValue');

	costRangeSlider.noUiSlider.on('update', function (values, handle) {

		var value = values[handle];

		if (handle) {
			indicatorMaxValue.textContent = Math.round(value);
		} else {
			indicatorMinValue.textContent = Math.round(value);
		}
	});
}

//mobile menu
if(document.getElementById('menuExpander')) {
	var menuExpander = document.getElementById('menuExpander');
	var shortScreen = document.getElementById('shortScreen');
	var body = document.getElementById('body');
	var shortScreen__menu = document.getElementById('shortScreen__menu');
	
	menuExpander.addEventListener('click', expandMenu);
	menuExpander.addEventListener('touch', expandMenu);
	shortScreen.addEventListener('click', closeMenu);
	shortScreen.addEventListener('touch', closeMenu);
	
	function expandMenu(e) {
		e.preventDefault();
		e.stopPropagation();
		let target = e.target.closest('button');
		if(!target.id == 'menuExpander') {
			return;
		};
		body.style = "height: 100vh; width: 100vw; overflow: hidden;";
		shortScreen.classList.remove('d-none');
		shortScreen.classList.add('d-block');
		shortScreen__menu.classList.remove('d-none');
		shortScreen__menu.classList.add('d-block');
	};
	
	function closeMenu(e) {
		e.preventDefault();
		e.stopPropagation();
		let target = e.target;
		if(!target.id == 'shortScreen') {
			return;
		};
		body.style = "height: 100%; width: 100%; overflow: volatile;";
		shortScreen.classList.remove('d-block');
		shortScreen.classList.add('d-none');
		shortScreen__menu.classList.remove('d-block');
		shortScreen__menu.classList.add('d-none');
	};
}

//siteSearch
if(document.getElementById('siteSearchButton')) {
	var siteSearchButton = document.getElementById('siteSearchButton');
	var siteSearch = document.getElementById('siteSearch');
	var body = document.getElementById('body');
	var siteSearchInput = document.getElementById('siteSearchInput');
	var siteSearchSubmit = document.getElementById('siteSearchSubmit');
	
	siteSearchButton.addEventListener('click', showSearch);
	siteSearchButton.addEventListener('touch', showSearch);
	body.addEventListener('click', closeSearch);
	body.addEventListener('touch', closeSearch);
	
	function showSearch(e) {
		e.stopPropagation();
		let target = e.target;
		if(!target.id == 'siteSearchButton') {
			return;
		};
		siteSearch.classList.remove('d-none');
		siteSearch.classList.add('d-block');
	};
	
	function closeSearch(e) {
		let target = e.target;
		if(!target.closest('div').classList.contains('siteSearch__bg') || !target.closest('div').id == 'siteSearch') {
			siteSearch.classList.remove('d-block');
			siteSearch.classList.add('d-none');
		};
	};
}

//single product
if(document.querySelector('.productOrdering')){
	//showing selects if javascript is enables
	let productOrdering = document.querySelector('.productOrdering');
	let arr = productOrdering.querySelectorAll('select');
	for(elem of arr) {
		elem.classList.remove('d-none');
	};
	productOrdering.querySelector('.productOrdering__wrapper').classList.remove('d-none');
	
	
	/*
	 * Due to i use wishlist plugin and output wishlist buttons for every variantion separately
	 * this code jгst hide and show whislist buttons when attribute select changes
	 * comparing chosen attributes
	 */
	
	var productOrdering_selects = productOrdering.querySelectorAll('.productOrdering_select');
	var wishlist_buttons = productOrdering.querySelectorAll('.single_wishlist_button');
	
	//do it first time justin case
	show_right_wishlist_button(productOrdering_selects, wishlist_buttons);
	
	for(productOrdering_select of productOrdering_selects) {
		productOrdering_select.addEventListener('change', show_right_wishlist_button.bind(null, productOrdering_selects, wishlist_buttons));
	};
	
	function show_right_wishlist_button(productOrdering_selects, wishlist_buttons) {

		var eshop_select_ids = new Array();
		
		//compare names of data-attributes
		//then count coincidences of values
		//then add data-id as key to array with number of coincidences as value;
		for(wishlist_button of wishlist_buttons) {
			for(productOrdering_select of productOrdering_selects) {
				eshop_select_ids[wishlist_button.getAttribute('data-id')] = eshop_select_ids[wishlist_button.getAttribute('data-id')] || 0;
				if (wishlist_button.getAttribute('data-'+productOrdering_select.name) == productOrdering_select.value) {
					eshop_select_ids[wishlist_button.getAttribute('data-id')]++;
				};
			};
		};
		
		//sort resulting array
		var res = Object.keys(eshop_select_ids).sort(function(a, b) {
			return eshop_select_ids[b] - eshop_select_ids[a];
		});
		
		//get button by data-id with biggest coincidence number
		//then show it and hide others
		for(wishlist_button of wishlist_buttons) {
			if(wishlist_button.getAttribute('data-id') == res[0]) {
				wishlist_button.style = 'display: block;';
			} else {
				wishlist_button.style = 'display: none;';
			};
		};
	};
};