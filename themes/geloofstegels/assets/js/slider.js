/**
 * Inspiratie-slider: horizontale carrousel met prev/next knoppen.
 */
(function () {
	'use strict';
	document.addEventListener('DOMContentLoaded', function () {
		var slider = document.getElementById('gt-inspiration-slider');
		if (!slider) { return; }

		var prev = document.querySelector('.gt-slider-prev');
		var next = document.querySelector('.gt-slider-next');
		var step = function () {
			var slide = slider.querySelector('.gt-slide');
			return slide ? slide.offsetWidth + 16 : 240;
		};

		if (next) {
			next.addEventListener('click', function () {
				slider.scrollBy({ left: step() * 2, behavior: 'smooth' });
			});
		}
		if (prev) {
			prev.addEventListener('click', function () {
				slider.scrollBy({ left: -step() * 2, behavior: 'smooth' });
			});
		}

		// Sleep-met-muis ondersteuning (desktop).
		var isDown = false, startX, scrollLeft;
		slider.addEventListener('mousedown', function (e) {
			isDown = true; slider.classList.add('is-dragging');
			startX = e.pageX - slider.offsetLeft;
			scrollLeft = slider.scrollLeft;
		});
		['mouseleave', 'mouseup'].forEach(function (ev) {
			slider.addEventListener(ev, function () { isDown = false; slider.classList.remove('is-dragging'); });
		});
		slider.addEventListener('mousemove', function (e) {
			if (!isDown) { return; }
			e.preventDefault();
			var x = e.pageX - slider.offsetLeft;
			slider.scrollLeft = scrollLeft - (x - startX) * 1.5;
		});
	});
})();
