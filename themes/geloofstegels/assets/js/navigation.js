/**
 * Navigatie: mobiel menu, submenu-toggles en toetsenbordtoegankelijkheid.
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var nav = document.getElementById('site-navigation');
		var toggle = document.querySelector('.menu-toggle');

		if (toggle && nav) {
			toggle.addEventListener('click', function () {
				var open = nav.classList.toggle('is-open');
				toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
				toggle.classList.toggle('is-active', open);
				document.body.classList.toggle('gt-menu-open', open);
			});
		}

		// Voeg submenu-toggle knoppen toe op mobiel.
		var parents = nav ? nav.querySelectorAll('.menu-item-has-children') : [];
		parents.forEach(function (li) {
			var link = li.querySelector(':scope > a');
			var submenu = li.querySelector(':scope > .sub-menu');
			if (!submenu || !link) {
				return;
			}
			var btn = document.createElement('button');
			btn.className = 'gt-submenu-toggle';
			btn.setAttribute('aria-expanded', 'false');
			btn.setAttribute('aria-label', 'Submenu openen');
			btn.innerHTML = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>';
			link.insertAdjacentElement('afterend', btn);

			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var open = submenu.classList.toggle('is-open');
				btn.setAttribute('aria-expanded', open ? 'true' : 'false');
				btn.classList.toggle('is-active', open);
			});
		});

		// Toetsenbordtoegankelijkheid voor desktop dropdowns.
		var topLinks = nav ? nav.querySelectorAll('.menu > li > a') : [];
		topLinks.forEach(function (link) {
			link.addEventListener('focus', function () {
				var current = this.parentNode;
				var siblings = current.parentNode.children;
				Array.prototype.forEach.call(siblings, function (s) {
					s.classList.remove('focus');
				});
				current.classList.add('focus');
			});
		});
	});
})();
