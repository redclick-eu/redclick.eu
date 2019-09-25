import Siema from '../util/siema';

const _carousels = Array.from(document.querySelectorAll('.siema-carousel'));

_carousels.forEach((_carousel) => {
    let settings = _carousel.getAttribute('data-settings');

    settings = settings === null ? {} : JSON.parse(settings);
    settings = settings === null ? {} : settings;

    settings.selector = _carousel.querySelector('.siema-inner');

    Siema(settings);
});