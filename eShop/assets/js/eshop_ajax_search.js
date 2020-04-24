/*
 * auto completion for search form
 */
var siteSearch = document.getElementById('siteSearch');
var input = document.getElementById('siteSearchInput');
input.addEventListener('input', eShop_ReturnResults);
var eShop_SearchQuery = input.value;
var eShop_IsThrottled = false;
var eShop_AjaxForm = document.querySelector('.siteSearch__form');

function eShop_ReturnResults() {
	
	if(eShop_IsThrottled) {
		eShop_SearchQuery = input.value;
		return;
	};
	
	if(eShop_SearchQuery !== '') {
		eShop_search(eShop_SearchQuery);
	};
	eShop_IsThrottled = true;
	
	setTimeout(function(){
		eShop_IsThrottled = false;
		if(eShop_SearchQuery !== ''){
			eShop_ReturnResults();
			eShop_SearchQuery = '';
		};
	}, 2000);
	
};

function eShop_search(query) {
	let eShop_data = {
		s: query,
		action: 'eShop_search',
		nonce: eshop_ajax_localize.nonce
	};
//i can't udnerstand how to use fetch to connect WP properly
//and there is nothing about it in the internet
	jQuery.ajax({
		url: eshop_ajax_localize.url,
		data: eShop_data,
		type: 'post',
		dataType: 'json',
		beforeSend: remove_elements(),
		success: function(a) {
			render_elements(a);
		}
	});
};

function render_elements(arg) {
	for(let i = 0; i < arg.length; i++) {
		let div = document.createElement('div');
		let a = document.createElement('a');
		a.setAttribute('href', arg[i][0]);
		a.textContent = arg[i][1];
		div.classList.add('quicksearch');
		a.classList.add('quicksearch__link');
		div.appendChild(a);
		siteSearch.appendChild(div);
	};
};

function remove_elements() {
	let arr = siteSearch.querySelectorAll('.quicksearch');
	for(let i = 0; i < arr.length; i++) {
		arr[i].remove();
	};
};