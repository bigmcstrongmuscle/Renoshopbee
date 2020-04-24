//here a parameters of chosen product are handling and sending to server
if(document.querySelector('.productOrdering')){
	var productOrdering = document.querySelector('.productOrdering');
	productOrdering.addEventListener('submit', (e)=>{
		e.preventDefault();
		//getting values and elements
		var cart_button = productOrdering.querySelector('.card__button');
		var prodid = cart_button.dataset.prodid;
		var attributes = {};
		var arr = productOrdering.querySelectorAll('select');
		var quantity = productOrdering.querySelector('#productOrdering__quantity').value;
		var cart_content = document.getElementById('eShop_cart_content');
		
		for(singleAttr of arr) {
			//dynamic object properties
			attributes[singleAttr.name] = singleAttr.value;
		};
		
		var eShop_data = {
				s: 'query',
				action : 'eshop_addtocart',
				prodid : prodid,
				attributes : attributes,
				quantity : quantity,
				nonce: eshop_ajax_localize.nonce
			};
		//sending
		//i still don't know how to do it using fetch or vanilla xhr
		jQuery.ajax({
			url: eshop_ajax_localize.url,
			data: eShop_data,
			type: 'post',
			dataType: 'json',
			beforeSend: function(){
				cart_button.querySelector('span').textContent = 'Добавляю . . .';
			},
			success: function(a) {
				if(a.message != '') {
					if(a.message != 'Что-то пошло не так.'){
						var start = a.message.search('<li>')+8;
						var fin = a.message.search('</li>');
						var mess = a.message.substring(start, fin);
					} else {
						var mess = a.message;
					};
						
					var elem = document.createElement('p');
					elem.textContent = mess;
					elem.classList.add('add-to-cart-notification');
					elem.style = 'margin: .5rem 0 0 0; padding:6px 12px; font-size: 14px; text-transform: uppercase; background-color: gold; border: 0; border-radius: 5px;';
					cart_button.querySelector('span').textContent ='Добавить в корзину';
					productOrdering.appendChild(elem);
					setTimeout(() => {
						elem.remove();
					}, 3000);
				} else {
					cart_content.classList.remove('d-none');
					cart_content.textContent = a.count;
					cart_button.querySelector('span').textContent ='Добавлено';
				};
			}
		});
	});
};