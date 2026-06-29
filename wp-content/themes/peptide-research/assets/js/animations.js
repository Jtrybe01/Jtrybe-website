(function () {
	'use strict';

	var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	var revealEls = document.querySelectorAll('[data-reveal]');

	if (prefersReducedMotion || !('IntersectionObserver' in window)) {
		revealEls.forEach(function (el) {
			el.classList.add('is-visible');
		});
		return;
	}

	var observer = new IntersectionObserver(
		function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		},
		{ threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
	);

	revealEls.forEach(function (el) {
		observer.observe(el);
	});

	var cardObserver = new IntersectionObserver(
		function (entries) {
			entries.forEach(function (entry, index) {
				if (entry.isIntersecting) {
					var card = entry.target;
					setTimeout(function () {
						card.classList.add('is-visible');
					}, (index % 6) * 60);
					cardObserver.unobserve(card);
				}
			});
		},
		{ threshold: 0.1 }
	);

	document.querySelectorAll('li.product-card').forEach(function (card) {
		card.setAttribute('data-reveal', '');
		cardObserver.observe(card);
	});
})();
