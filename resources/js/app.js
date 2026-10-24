import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './main';
import './gsap';
import { initHeroSlider } from './swiper';

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('.alert-fade').forEach((alert) => {
		window.setTimeout(() => {
			window.closeAlert(alert.querySelector('.close-btn'));
		}, 5000);
	});
});

window.closeAlert = (button) => {
	const alert = button?.closest('.alert');

	if (!alert) {
		return;
	}

	alert.classList.add('hide');
	window.setTimeout(() => alert.remove(), 150);
};
