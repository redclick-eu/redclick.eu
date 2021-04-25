export default () => {
    document.querySelectorAll('.js-search-form').forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (form.querySelector('.js-search').value.length === 0) {
                e.preventDefault();
            }
        });
    });

    const form = document.getElementById('form_mobileSearch');

    window.addEventListener('toggle.opened', (e) => {
        if (e.detail.targets.includes(form)) {
            form.querySelector('.js-search').focus();
        }
    });

    window.addEventListener('toggle.closed', () => {
        form.querySelector('.js-search').blur();
    });
};
