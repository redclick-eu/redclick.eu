import Isotope from 'isotope-layout';

export default () => {
    const portfolio = document.querySelector('.js-portfolio');
    if (portfolio !== null) {
        const menuItems = portfolio.querySelectorAll('.js-portfolio-menu li');
        const grid = portfolio.querySelector('.js-portfolio-grid');

        const isotope = new Isotope(grid, {
            masonry: {
                isFitWidth: true,
                gutter: 20,
            },
        });

        menuItems.forEach((el) => {
            el.addEventListener('click', function callback() {
                menuItems.forEach((item) => item.classList.remove('is-active'));

                this.classList.add('is-active');

                const target = this.getAttribute('data-grid');
                isotope.arrange({ filter: target === 'all' ? 'li' : `.js-isotope-${target}` });
            });
        });
    }
};
