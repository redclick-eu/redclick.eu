import Isotope from 'isotope-layout';

const _portfolio = document.querySelector('.js-portfolio');
if (_portfolio !== null) {
    const _menuItems = _portfolio.querySelectorAll('.js-portfolio-menu li');
    const _grid = _portfolio.querySelector('.js-portfolio-grid');

    const isotope = new Isotope(_grid, {
        masonry: {
            isFitWidth: true,
            gutter: 20,
        },
    });

    _menuItems.forEach((el) => {
        el.addEventListener('click', function () {
            _menuItems.forEach((el) => el.classList.remove('is-active'));
            this.classList.add('is-active');

            const target = this.getAttribute('data-grid');
            console.log(`.js-isotope-${target}`);
            isotope.arrange({ filter: target === 'all' ? 'li' : `.js-isotope-${target}` });
        });
    });


    // $portMenu.find(' .menu-item[data-grid='' + classes[0] + '']').click();
}