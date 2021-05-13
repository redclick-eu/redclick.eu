export default () => {
    const forms = document.querySelectorAll('.js-search-form-mobile');

    forms.forEach((form) => {
        window.addEventListener('toggle.opened', (e) => {
            if (e.detail.targets.includes(form)) {
                form.querySelector('.js-search-input').focus();
            }
        });

        window.addEventListener('toggle.closed', () => {
            form.querySelector('.js-search-input').blur();
        });
    });
};
