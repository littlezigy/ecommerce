slide_carousel = function(e) {
	let carousel = e.currentTarget.parentElement;
}

loadcarouselEvents = function() {
	let carousel_buttons = document.getElementsByClassName('carousel-button');

	Array.prototype.forEach.call(carousel_buttons, function(button) {
		button.addEventListener('click', function(e) {
			let parentdiv = e.currentTarget.parentElement;
			let carouselelement = e.currentTarget.parentElement.getElementsByClassName('carousel')[0];
			let bounding = carouselelement.getBoundingClientRect();
			let card = carouselelement.getElementsByTagName('div')[0];
			let cardswidth = card.offsetWidth + (parseInt(window.getComputedStyle(card).margin) * 2);
			if(bounding.right / document.documentElement.clientWidth >= 2) {//proceed as usual
				console.log("------------1--------------");
				let pos = (carouselelement.style.right) ? carouselelement.style.right : 0;
				carouselelement.style.left = null;
				carouselelement.style.right = `${(cardswidth * Math.floor(parentdiv.clientWidth / cardswidth)) + parseFloat(pos)}px`;
			} else if(bounding.right === document.documentElement.clientWidth) {//set carouel pos to zero
				console.log("------------2--------------");
				let pos = (carouselelement.style.right) ? carouselelement.style.right : 0;
				carouselelement.style.right = null;
				carouselelement.style.left = 0;
			} else {
				console.log("------------3--------------");
				let pos = (carouselelement.style.right) ? carouselelement.style.right : 0;
				carouselelement.style.left = null;
				carouselelement.style.right = `${bounding.width - document.documentElement.clientWidth}px`;
			}
		});
	});
}

loadcarouselEvents();
