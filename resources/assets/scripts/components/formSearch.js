export default () => {
    document.getElementsByClassName('js-search-form').forEach((_form) => {
        _form.addEventListener('submit', function (e) {
            if (this.querySelector('.js-search').value.length === 0) {
                e.preventDefault();
            }
        });
    });

    const _form = document.getElementById('form_mobileSearch');

    window.addEventListener('toggle.opened', (e) => {
        if (e.detail.targets.includes(_form)) {
            _form.querySelector('.js-search').focus();
        }
    });

    window.addEventListener('toggle.closed', () => {
        _form.querySelector('.js-search').blur();
    });
}
