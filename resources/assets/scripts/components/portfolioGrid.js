export default () => {
    const portfolio = document.querySelector('.js-portfolio');

    if (!portfolio) {
        return;
    }

    const menuItems = document.querySelectorAll('.js-portfolio-selector');
    const items = document.querySelectorAll('.js-portfolio-item');

    portfolio.addEventListener('click', (e) => {
        const target = e.target.closest('.js-portfolio-selector');
        const gridSelector = target ? target.getAttribute('data-selector') : undefined;

        if (!gridSelector) {
            return;
        }

        e.preventDefault();

        menuItems.forEach((item) => item.classList.remove('is-active'));
        target.classList.add('is-active');

        items.forEach((item) => {
            if (item.classList.contains(`js-grid-${gridSelector}`)) {
                item.classList.add('is-active');
            } else {
                item.classList.remove('is-active');
            }
        });
    });
};
