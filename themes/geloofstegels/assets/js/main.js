/**
 * Algemene thema-interacties: zoek-overlay.
 */
(function () {
	'use strict';
	document.addEventListener('DOMContentLoaded', function () {
		var openBtn = document.querySelector('.gt-search-toggle');
		var overlay = document.getElementById('gt-search-overlay');
		if (!overlay) { return; }
		var closeBtn = overlay.querySelector('.gt-search-overlay__close');
		var field = overlay.querySelector('.search-field');

		function open() {
			overlay.classList.add('is-open');
			if (openBtn) { openBtn.setAttribute('aria-expanded', 'true'); }
			if (field) { setTimeout(function () { field.focus(); }, 50); }
		}
		function close() {
			overlay.classList.remove('is-open');
			if (openBtn) { openBtn.setAttribute('aria-expanded', 'false'); }
		}

		if (openBtn) { openBtn.addEventListener('click', open); }
		if (closeBtn) { closeBtn.addEventListener('click', close); }
		overlay.addEventListener('click', function (e) { if (e.target === overlay) { close(); } });
		document.addEventListener('keyup', function (e) { if (e.key === 'Escape') { close(); } });
	});
})();
